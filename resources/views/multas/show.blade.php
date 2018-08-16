@extends('layouts.app')
@section('title', "Detalles de la placa $multa->placa")
@section('meta-description')
    <meta name="description" content="Ver detalles de la placa {{$multa->placa or "Sin placa"}}, contiene {{ $otras_multas->count()+1 }}
            multas con los folios {{ $otras_multas->pluck("folio")}} {{ $multa->folio }} culiacán, sinaloa, ayuntamiento">
@endsection
@section("content-title","Ver multas de la placa $multa->placa")
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-body">
      <table class="table table-hover">
        <thead>
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
            <thead>
                <tr>
                    <th>Concepto</th>
                    <th>Descripción</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                {!! $multa->multas_html !!}
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th class="text-right">Total</th>
                    <th>
                        {{ $multa->importe }}
                    </th>
                </tr>
            </tfoot>
        </table>

      </div>
      <div class="panel panel-default">
        <div class="panel-title">
          <strong>Otras multas de la misma placa</strong>
        </div>
        <div class="panel-body">
          <table class="table">
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
                  <a class="btn btn-sm btn-default" href="{{ route('multas.show',[$multa->id]) }}" role="button">Ver</a>
                </td>
              </tr>
            @empty
              <tr>
                Nuestra base de datos no tiene registro de todas las multas, de momento no tiene otras registradas.
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
