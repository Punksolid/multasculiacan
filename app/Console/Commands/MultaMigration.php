<?php

namespace App\Console\Commands;

use App\Concepto;
use App\Multa;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Revisa dentro de las multas ya guardadas
 * Class MultaMigration
 * @package App\Console\Commands
 */
class MultaMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multas:migration {inicio} {fin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migracion rellena la tabla conceptos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $inicio = $this->argument('inicio');
        $fin = $this->argument('fin');
        $bar = $this->output->createProgressBar(($fin-$inicio));
        ini_set('memory_limit', '1000');
        $this->info($inicio);
        $this->info($fin);
        $multas = Multa::whereBetween("id",[$inicio,$fin])->get();
        
        foreach ($multas as $multa){
            $bar->advance();
            $re_process = new Crawler();
            $re_process->addHtmlContent($multa->multas_html);
            $conceptos = $re_process->filter("div.detalle-boleta > tr")->each(function ($tr){
                $concepto = $tr->filter("td")->eq(0)->html();
                $descripcion = $tr->filter("td")->eq(1)->html();
                $monto = str_replace(",","", $tr->filter("td")->eq(2)->html());
                $monto = str_replace(".","", $monto);


                return compact("concepto","descripcion","monto");
            });

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
        }

        $bar->finish();
    }
}
