<?php
/**
 * Created by PhpStorm.
 * User: ps
 * Date: 1/09/18
 * Time: 03:26 PM
 */

Route::resource("placas", "Api\PlacasController")->only("show");

Route::get("top10_conceptos", "MultasController@top10conceptos");

Route::get('numero_demultas', function (\App\Multa $multa) {
    Cache::add("numero_demultas", $multa->count(), 5);

    return Response::json(Cache::get("numero_demultas"));
});