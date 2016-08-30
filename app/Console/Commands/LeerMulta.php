<?php

namespace App\Console\Commands;

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

        //$this->ayuntamiento = new \GuzzleHttp\Client(['base_uri' => 'https://pagos.culiacan.gob.mx/multas-transito/']);
        $this->ayuntamiento = new \Goutte\Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    $response =  $this->ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/".$this->argument('folio'));
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

      //$this->info($multa->placa);
      return true;
      
    } catch (\Exception $e) {
      $this->output = false;
      //$this->error($this->argument('folio'));
    }

    }
}
