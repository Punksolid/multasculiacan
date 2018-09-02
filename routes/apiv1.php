<?php
/**
 * Created by PhpStorm.
 * User: ps
 * Date: 1/09/18
 * Time: 03:26 PM
 */

Route::resource("placas", "Api\PlacasController")->only("show");

Route::get("top10_conceptos", "MultasController@top10conceptos");