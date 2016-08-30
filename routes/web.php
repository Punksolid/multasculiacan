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

Auth::routes();

Route::get('/home', 'HomeController@index');
