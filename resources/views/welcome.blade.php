@extends('layouts.app')
@section('title', 'Resumen')
@section("content-title","Resumen de las Multas de Tránsito de Culiacán")

@section('content')
    <div class="container">

        <div class="row" id="folios">
            <div class="column col-sm-6 mb-2">
                <div class="card text-white bg-info">
                    <h5 class="card-header">
                        <i class="fas fa-clipboard-check"></i> Multas Indexadas
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <h3>@{{ someData }}</h3>
                        </p>
                    </div>
                    <div class="card-footer">
                        * Las multas se indexan constantemente.
                    </div>
                </div>
            </div>
            <div class="column col-sm-6 mb-2">
                <div class="card text-white bg-danger">
                    <h5 class="card-header">
                        <i class="fas fa-times-circle"></i> Folios no encontrados
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            <h3>@{{ notFound }}</h3>
                        </p>
                    </div>
                    <div class="card-footer">
                        * Se desconoce motivo por perdida del folio.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="column col-md-12 mt-3 mb-3">

                <table class="table table-striped">
                    
                    <h2 class="titulo_lat mt-4">TOP 10 DE PLACAS CON MAS MULTAS</h2>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PLACA</th>
                            <th scope="col">Numero de Multas:</th>
                        </tr>
                    </thead>

                    <tbody id="cards">
                        <tr v-for="(item, index) in items">
                            <th scope="row" class="top10"></th>
                            <td><a href="{{ url('multas/search?placa=')}}@{{ index.placa }}" >@{{ index.placa }}</a></td>
                            <td>@{{ index.total }}</td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div> <!-- row -->

        <div class="row mb-3" id="donacion">
            <div class="column col-12">
                <h3 class="mb-2 bg-secundary titulo_lat">DONA</h3>
            </div>
            
            <div class="column col-md-6 mb-2">
                <div class="card flex-row">
                    <div class="card-header border-0">
                       <img src="{{ asset("storage/qrcode.jpg")  }}" width="100" alt="dona en litecoin">
                    </div>
                    <div class="card-body">
                        <div class="card-title">Donar: Litecoin</div>
                        <div class="card-text text-muted">
                        Litecoin:LR9DFUSsfK678XerFeQcChs74GuBDGyUpM </div> <!-- Litecoin -->
                    </div>
                </div>
            </div>

            <div class="column col-md-6">
                <div class="card flex-row">
                    <div class="card-header">
                        <img src="{{ asset("storage/chart.png")  }}" width="100" alt="dona en ether">
                    </div>
                    <div class="card-body">
                        <div class="card-title">Donar: Ether</div>
                        <div class="card-text text-muted">
                        Ether:0xb1e261206ef295d072a257ec9f5fa9d1267797af<!-- Ether -->

                    </div>
                </div>
            </div>
        </div>


    </div> <!-- row -->
<script type="text/javascript">
    $( "#bienvenida" ).addClass('show');
    $( "a.ocultar > i" ).toggle();
</script>
    <script src="{{ asset('js/multas.js') }}" ></script>
    <script src="{{ asset('js/top10_one_card.js') }}" ></script>

@endsection