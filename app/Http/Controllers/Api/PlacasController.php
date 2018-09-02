<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\PlacaResource;
use App\Placa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacasController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($placa_id)
    {
        $placa = new Placa;
        $placa->setPrimaryKey($placa_id);
        $placa->id = $placa_id;
        $placa->multas = $placa->multas();

        return PlacaResource::make($placa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
