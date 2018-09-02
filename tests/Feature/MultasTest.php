<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MultasTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_mostar_multas_de_placa_detallada()
    {
        $placa = "VSE4474";
        $call = $this->json("GET", "api/v1/placas/$placa");
        $call->assertStatus(200);
        $call->assertJson([
            "data" => [
                "placa" => "VSE4474",
                "multas" => [
                    "id" => null,
                    "folio" => "J1235828",
                    "importe" => 386.88,
                    "redondeo" => 0,
                    "conceptos" => [
                        "concepto" => 104,
                        "descripcion" => "CONDUCIR LLEVANDO PERSONAS O BULTOS ENTRE LAS MANOS, PERMITIR EL CONTROL DE DIRECCION DEL VEHICULO A",
                        "importe" => 386.88
                    ]
                ]
            ]
        ]);

        $call->assertJsonStructure([
            "data" => [
                "placa",
                "multas" => [
                    "*" => [
                        "id",
                        "folio",
                        "importe",
                        "redondeo",
                        "conceptos" => [
                            "*" => [
                                "concepto",
                                "descripcion",
                                "importe"
                            ]
                        ]

                    ]
                ]
            ]
        ]);
    }

    public function test_mostrar_multas_de_placa_simple()
    {
        $placa = "VSE4474";
        $call = $this->json("GET", "api/v1/placas/$placa");
        $call->assertJson([
            "data" => [
                "placa" => "VSE4474",
                "multas" => [
                    [
                        "id" => null,
                        "folio" => "J1235828",
                        "importe" => 386.88,
                        "redondeo" => "0.12",
                    ]
                ]
            ]
        ]);
        $call->assertStatus(200);
    }


    public function test_top10_conceptos_mas_populares()
    {
        $conceptos = \DB::table("conceptos")
            ->select(\DB::raw('count(*) as total, concepto, descripcion'))
            ->orderBy("total", "desc")
            ->groupBy("concepto", "descripcion")
            ->take(10)
            ->get()
            ->values();

        dd($conceptos);
    }
}
