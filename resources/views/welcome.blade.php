@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div id="messages">

            <div class="panel panel-default">

                    Multas Indexadas  @{{ someData }}
            </div>
            <div class="panel panel-default">
                    Folios no encontrados @{{ notFound }}
            </div>


            </div>
            <div class="panel">
                <div class="panel-title">TOP 10 DE PLACAS CON MAS MULTAS</div>
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
                <div class="panel-title">DONA</div>
                <div class="panel-body">
                    <img style="width: 15%; height: auto;" src="{{ asset("storage/qrcode.jpg")  }}">

                    Litecoin:LR9DFUSsfK678XerFeQcChs74GuBDGyUpM
                </div>
                <div class="panel-body">
                    <img style="width: 15%; height: auto;" src="{{ asset("storage/chart.png")  }}">

                    Ether:0xb1e261206ef295d072a257ec9f5fa9d1267797af
                </div>
            </div>


        </div>
    </div>

    <script src="{{ asset('js/multas.js') }}" ></script>
    <script src="{{ asset('js/top10_one_card.js') }}" ></script>

@endsection
