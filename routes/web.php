<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::any('multas/search', 'MultasController@search');
Route::resource('multas','MultasController');

Route::get('/', function () {
    return view('welcome');
});

Route::get('local', function(\App\Multa $multa){
    dump($multa->get()->toArray());
});
Route::get('numero_demultas', function(\App\Multa $multa){
    return Response::json($multa->count());
});
Route::get('count/{placa?}', function(\App\Multa $multa,$placa = null){

  $query = $multa
    ->select('placa','folio', DB::raw('COUNT(*)') )
    // ->where('placa','=')
    ->from('multas')
    ->groupBy('placa')
    ->havingRaw('count(*) > 1');

  $query = $query->take(10)->get();
  dd($query->toArray());
    return Response::json($multa->count());
});



Auth::routes();

Route::get('/home', 'HomeController@index');
