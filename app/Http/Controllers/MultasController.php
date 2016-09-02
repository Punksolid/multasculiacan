<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Multa;

class MultasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $multas = Multa::orderBy('folio','DESC')->paginate(50);


        return view('multas.index')->with(compact('multas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
    public function show($id)
    {
      $ayuntamiento = new \Goutte\Client();

      $responsex=  $ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/$id");

        $folio = $responsex->filter('body > div.datos-boleta > div > dl > dd')->eq(0)->html();

        $placa = $responsex->filter('body > div.datos-boleta > div > dl > dd')->eq(1)->html();
        $importe = $responsex->filter('body > div.datos-boleta > div > dl > dd')->eq(2)->html();
        $redondeo = $responsex->filter('body > div.datos-boleta > div > dl > dd')->eq(3)->html();

        $multas_html = $responsex->filter('tbody')->html();
        $html = $responsex->html();
        $multa = [
          'folio' => $folio,
          'placa' => $placa,
          'importe' => $importe,
          'redondeo' => $redondeo,
          'multas_html' =>  $multas_html,
          'html' =>  $html
        ];
        //dd($multa);
        return $html;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function search(Request $request)
    {

      $multa = new Multa();

      if($request->folio != ''){
        $multa =   $multa->where('folio', $request->folio);
      } else {
        $multa = $multa->where('placa', $request->placa);
      }

      $multas = $multa->paginate(50);

      return view('multas.index')->with('multas', $multas);
    }
}
