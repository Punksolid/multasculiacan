<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class LeerMulta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multas:leer {folio}';

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
        $client = new Client();

      $response =  $this->ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/".$this->argument('folio'),["verify" => false]);
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
          'multas_html' =>  $multas_html,
          'html' =>  $html
        ];

        $multa = \App\Multa::create($multa);

        $this->info($multa->placa);
        $this->info($multa->folio);
        $this->info($multa->importe);
        $this->info($multa->redondeo);
        $this->info($multa->multas_html);
//        $this->info($multa->html);
        return true;

      } catch (\Exception $e) {
        $this->output = false;
        //$this->error($this->argument('folio'));
      }

    }
}
