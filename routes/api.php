<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('top10', function (Request $request) {


    $top10placas_con_mas_multas = Cache::remember("top10multas", 5, function () {
        return DB::table("multas")
            ->select(DB::raw('count(*) as total, placa'))
            ->orderBy("total", "desc")
            ->where("placa", "<>","")
            ->groupBy("placa")
            ->take(10)
            ->get()
            ->values();
    });

    return $top10placas_con_mas_multas;


});

Route::get('not_found', function (Request $request) {
    if (!Cache::has("failed_attempts")) {
        Cache::put("failed_attempts", DB::table("failed_attempts")
            ->count(), 5);
    }

    return Cache::get("failed_attempts");

});
