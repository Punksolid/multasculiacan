@extends('layouts.app')
@section('title', "Detalles de la placa $multa->placa")
@section('meta-description')
    <meta name="description" content="Ver detalles de la placa {{$multa->placa or "Sin placa"}}, contiene {{ $otras_multas->count()+1 }}
            multas con los folios {{ $otras_multas->pluck("folio")}} {{ $multa->folio }} culiacán, sinaloa, ayuntamiento">
@endsection
@section("content-title","Ver multas de la placa $multa->placa")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="panel panel-default panel-body">
      <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
          <th>
            Placa
          </th>
          <th>
            Folio
          </th>
          <th>
            Id local
          </th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $multa->placa or "Sin placa" }}</td>
            <td>{{ $multa->folio or "Error" }}</td>
            <td>{{ $multa->id or "Error" }}</td>
          </tr>
        </tbody>
      </table>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Concepto</th>
                    <th>Descripción</th>
                    <th width="120px" class="text-center">Importe</th>
                </tr>
            </thead>
            <tbody>
                {!! $multa->multas_html !!}
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th class="text-right">Total</th>
                    <th class="text-center">
                        {{ $multa->importe }}
                    </th>
                </tr>
            </tfoot>
        </table>

      </div>

      <div class="card mb-5">
        <div class="card-header">
          <h5 class="mb-0">Otras multas de la misma placa</h5>
        </div>
        <div class="card-body">
          <table class="table table-sm"">
            <thead>
              <tr>
                <th>
                  Folio
                </th>
                <th>
                  Placa
                </th>
                <th>
                  Importe
                </th>
                <th>
                  Acciones
                </th>
              </tr>
            </thead>
            <tbody>
            @forelse($otras_multas as $multa)
              <tr>
                <td>
                  {{ $multa->folio }}
                </td>
                <td>
                  {{ $multa->placa }}
                </td>
                <td>
                  {{ $multa->importe }}
                </td>
                <td>
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('multas.show',[$multa->id]) }}" role="button">Ver</a>
                </td>
              </tr>
            @empty
              <tr>
                <p class="text-muted">Nuestra base de datos no tiene registro de todas las multas, de momento no tiene otras registradas.</p>
              </tr>
            @endforelse
            </tbody>
          </table>
          
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
