<?php

use App\Multa;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;

use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
});

Artisan::command('multas:backup {inicio} {fin}', function ($inicio, $fin) {
  $bar = $this->output->createProgressBar(($fin-$inicio));
//  $folios = collect();
//  for ($folio = $inicio; $folio <= $fin; $folio++){
//      $folios->push("J$folio");
//  }
//  $x = Multa::whereIn("folio",$folios->toArray())->count();
    $carbon = Carbon::now();
      for ($folio = $inicio; $folio <= $fin ; $folio++) {
        $output = $this->getOutput(
          $this->call('multas:leer', [
            'folio' => $folio
            ])

        );

    $bar->advance();
  }
  $bar->finish();

    $this->comment('fin');
    $this->comment($carbon->diffForHumans());

});

Artisan::command('multas:asincrono {inicio} {fin}', function ($inicio, $fin) {
  // $bar = $this->output->createProgressBar(($fin-$inicio));
  // $fails = [];
  // for ($folio = $inicio; $folio <= $fin ; $folio++) {
  //
  //
  //   $bar->advance();
  // }
  // $bar->finish();
  // $this->comment('fin');
  // $ayuntamiento = new \Goutte\Client(['base_uri' => 'https://pagos.culiacan.gob.mx/multas-transito/']);
    // $response =  $ayuntamiento->sendA($this->argument('folio'));
    // $client = new GuzzleHttp\Client();
    // $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
    //
    //   $promise = $client->request('GET', 'http://httpbin.org/get?q=foo')->then(function ($response) {
    //       echo 'I completed! ' . $response->getBody();
    //   });
    //   $promise->wait();
    //   dd($promise);
    // try {
    //   $folio = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(0)->html();
    //
    //   $placa = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(1)->html();
    //   $importe = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(2)->html();
    //   $redondeo = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(3)->html();
    //
    //   $multas_html = $response->filter('tbody')->html();
    //   $html = $response->html();
    //   $multa = [
    //     'folio' => $folio,
    //     'placa' => $placa,
    //     'importe' => $importe,
    //     'redondeo' => $redondeo,
    //     'multas_html' =>  $multas_html,
    //     'html' =>  $html
    //   ];
    //   dd($multa);
    //   $multa = \App\Multa::create($multa);
    //
    //   //$this->info($multa->placa);
    //   return true;
    //
    // } catch (\Exception $e) {
    //   $this->output = false;
    //   $this->error($this->argument('folio'));
    // }
    //



});
