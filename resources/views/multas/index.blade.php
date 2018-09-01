@extends('layouts.app')
@section('title', 'Todas Las')
@section('meta-description')
    <meta name="description" content="Ver todas las multas de la placa {{ $multas->pluck("placa")  }}
            multas con los folios {{ $multas->pluck("folio")}}  culiacán, sinaloa, ayuntamiento, carro, camion, moto,
vehiculo">
@endsection
@section("content-title","Listado de las Últimas Multas")

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['method' => 'GET', 'url' => 'multas/search']) !!}
                    <div class="form-group{{ $errors->has('placa') ? ' has-error' : '' }}">
                        {!! Form::label('placa', 'Buscar Por Placa') !!}
                        {!! Form::text('placa', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('placa') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('folio') ? ' has-error' : '' }}">
                        {!! Form::label('folio', 'Buscar Por Folio') !!}
                        {!! Form::text('folio', null, ['class' => 'form-control']) !!}
                        <small class="text-danger">{{ $errors->first('folio') }}</small>
                    </div>
                    <div class="btn-group pull-right">
                        {!! Form::reset("Reset", ['class' => 'btn btn-warning']) !!}
                        {!! Form::submit("Buscar", ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="row">
    <div class="col-md-8 col-md-offset-2">

        <div class="panel">
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
            @forelse($multas as $multa)
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
                    No hay multas
                </tr>
            @endforelse
          </tbody>
        </table>
        {{ $multas->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
