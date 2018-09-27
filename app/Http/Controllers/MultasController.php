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
        $multas = Multa::orderBy('id', 'DESC')->paginate(50);


        return view('multas.index')->with(compact('multas'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showAndDownload($id)
    {
        $ayuntamiento = new \Goutte\Client();

        $responsex = $ayuntamiento->request("GET", "https://pagos.culiacan.gob.mx/multas-transito/$id");

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
            'multas_html' => $multas_html,
            'html' => $html
        ];
        //dd($multa);
        return $html;

    }

    public function show($id)
    {
        $multa = Multa::find($id);

        $otras_multas = Multa::where('placa', $multa->placa)->where('folio', '<>', $multa->folio)->get();
        return view('multas.show')->with('multa', $multa)->with('otras_multas', $otras_multas);
    }

    public function extraer_vehiculo($placa, $ciudad = 'Culiacan')
    {
        $gobierno_estatal = new \Goutte\Client();

        $responsex = $gobierno_estatal->request("GET", "https://tramites1.sinaloa.gob.mx/vehicular/pe_01_clave.asp");
        //$gobierno_estatal->click($responsex->selectButton("images/ImapRecibo."))->link();
        dd($responsex);
        $form = $responsex->selectButton('submit2')->form();
        dd($form->html());
        $crawler = $client->click($crawler->selectLink('Sign in')->link());
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('login' => 'fabpot', 'password' => 'xxxxxx'));
        $crawler->filter('.flash-error')->each(function ($node) {
            print $node->text() . "\n";
        });

        //dd($multa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {

        $multa = new Multa();

        if ($request->folio != '') {
            $multa = $multa->where('folio', $request->folio);
        } else {
            $multa = $multa->where('placa', $request->placa);
        }

        $multas = $multa->paginate(50);

        return view('multas.index')->with('multas', $multas);
    }

    public function top10conceptos()
    {

        $conceptos = \Cache::remember("top10", 5, function () {

            $conceptos = \DB::table("conceptos")
                ->select(\DB::raw('count(*) as total, concepto, descripcion'))
                ->orderBy("total", "desc")
                ->groupBy("concepto", "descripcion")
                ->take(10)
                ->get()
                ->values();
            return $conceptos;

        });


        return response()->json($conceptos);
    }
}
