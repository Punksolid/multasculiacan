<?php

namespace Tests\Unit;

use App\Concepto;
use App\Multa;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestMultaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_simple_request()
    {
        $client = new \GuzzleHttp\Client(["verify" => false]);
        $ayuntamiento = new \Goutte\Client();
        $ayuntamiento->setClient($client);

        $response = $ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/" . "J1235802");

        $folio = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(0)->html();

            $placa = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(1)->html();
            $importe = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(2)->html();
            $redondeo = $response->filter('body > div.datos-boleta > div > dl > dd')->eq(3)->html();

            $multas_html = $response->filter('tbody')->html();
            $multa = [
                'folio' => $folio,
                'placa' => $placa,
                'importe' => $importe,
                'redondeo' => $redondeo,
                'multas_html' => $multas_html,
                'html' =>  ""
            ];

            $re_process = new Crawler();
            $re_process->addHtmlContent($multas_html);
            $conceptos = $re_process->filter("div.detalle-boleta > tr")->each(function ($tr){
                $concepto = $tr->filter("td")->eq(0)->html();
                $descripcion = $tr->filter("td")->eq(1)->html();
                $monto = $tr->filter("td")->eq(2)->html();

                return compact("concepto","descripcion","monto");
            });

            dd($response->filter('tbody > div.detalle-boleta > tr')->count());
            dump($response->filter('tbody > div.detalle-boleta > tr > td')->eq(0)->html());
            dump($response->filter('tbody > div.detalle-boleta > tr > td')->eq(1)->html());
            dd($response->filter('tbody > div.detalle-boleta > tr > td')->eq(2)->html());
            $multa = Multa::create($multa);


            return true;


    }

    public function test_migration()
    {
        ini_set('memory_limit', '2048M');
        $multas = Multa::all();

        foreach ($multas as $multa){
            dump($multa->id);
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
    }
}
