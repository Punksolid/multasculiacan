@extends('layouts.app')
@section('title', 'Resumen')
@section("content-title","Resumen de las Multas de Tránsito de Culiacán")

@section('content')
    <div class="container">

        <div class="row">
            <div id="messages">

            <div class="panel panel-default">

                <h2>Multas Indexadas</h2> <h3>@{{ someData }}</h3>
            </div>
            <div class="panel panel-default">
                <h2>Folios no encontrados</h2> <h3>@{{ notFound }}</h3>
            </div>


            </div>
            <div class="panel">
                <div class="panel-title"><h2>TOP 10 DE PLACAS CON MAS MULTAS</h2></div>
                <div id="cards">
                    <div v-for="(item, index) in items">
                        <div class="panel-danger">
                            <div class="panel-title">
                                Placa <a href="{{ url('multas/search?placa=')}}@{{ index.placa }}" >@{{ index.placa }}</a>
                            </div>
                            <div class="panel">
                                Numero de multas: @{{ index.total }}
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="panel">
                <div class="panel-title"><h2>DONA</h2></div>
                <div class="panel-body">
                    <img style="width: 15%; height: auto;" src="{{ asset("storage/qrcode.jpg")  }}" alt="dona en litecoin">

                    Litecoin:LR9DFUSsfK678XerFeQcChs74GuBDGyUpM
                </div>
                <div class="panel-body">
                    <img style="width: 15%; height: auto;" src="{{ asset("storage/chart.png")  }}" alt="dona en ether">

                    Ether:0xb1e261206ef295d072a257ec9f5fa9d1267797af
                </div>
            </div>


        </div>
    </div>

    <script src="{{ asset('js/multas.js') }}" ></script>
    <script src="{{ asset('js/top10_one_card.js') }}" ></script>

@endsection
