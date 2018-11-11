<?php

namespace App\Console\Commands;

use App\Concepto;
use App\Multa;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Mul;
use Symfony\Component\DomCrawler\Crawler;

class LeerMulta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multas:leer {folio} 
                            {--force} : Se salta si fue folio fallido o con resultado';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imprime el html de una multa';
    protected $ayuntamiento;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $client = new \GuzzleHttp\Client(["verify" => false]);
        $this->ayuntamiento = new \Goutte\Client();
        $this->ayuntamiento->setClient($client);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $folio_number = $this->argument('folio');
        if ($this->option('force')){
            if (!Multa::whereFolio("J" . $folio_number)->exists()){
                return $this->requestMultaInfo();

            }
        } else {
            if (Multa::whereFolio("J" . $folio_number)->exists()
                OR
                DB::table("failed_attempts")->whereFolio($folio_number)->exists()
            ) {
//            info("El folio ". $this->argument('folio'). "ya existe");
            } else {
                return $this->requestMultaInfo();
            }
        }

    }

    /**
     * @return bool
     */
    public function requestMultaInfo()
    {
        $response = $this->ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/" . $this->argument('folio'), ["verify" => false]);
        try {
            $folio = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(0)->html();

            $placa = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(1)->html();
            $importe = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(2)->html();
            $redondeo = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(3)->html();

            $multas_html = $response->filter('tbody')->html();
            $html = $response->html();
            $multa = [
                'folio' => $folio,
                'placa' => $placa,
                'importe' => $importe,
                'redondeo' => $redondeo,
                'multas_html' => $multas_html,
                'html' => ""
            ];

            $re_process = new Crawler();
            $re_process->addHtmlContent($multas_html);
            $conceptos = $re_process->filter("div.detalle-boleta > tr")->each(function ($tr){
                $concepto = $tr->filter("td")->eq(0)->html();
                $descripcion = $tr->filter("td")->eq(1)->html();
                $monto = str_replace(",","", $tr->filter("td")->eq(2)->html());
                $monto = str_replace(".","", $monto);


                return compact("concepto","descripcion","monto");
            });
            $multa = Multa::create($multa);
            info("Multa Creada Folio $multa->folio");
            foreach ($conceptos as $concepto){

                Concepto::forceCreate([
                    "concepto" => $concepto["concepto"],
                    "descripcion" => $concepto["descripcion"],
                    "monto" => $concepto["monto"],

                    "multa_id" => $multa->id,
                    "folio" => $multa->folio,
                    "created_at" => $multa->created_at,
                    "updated_at" => $multa->updated_at
                ]);
            }




            return true;

        } catch (\Exception $e) {
            DB::table("failed_attempts")->updateOrInsert(
                ['folio' => $this->argument('folio')],
                ["folio" => $this->argument('folio'),
                    "created_at" => Carbon::now()]
            );
//            $this->output = false;
        }
    }
}
