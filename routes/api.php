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

Route::get('top10', function(Request $request) {
    return DB::table("multas")
        ->select(DB::raw('count(*) as total, placa'))
        ->orderBy("total", "desc")
        ->groupBy("placa")
        ->take(10)
        ->get()
        ->values();

});

Route::get('not_found', function(Request $request) {
    return DB::table("failed_attempts")
        ->count();

});
