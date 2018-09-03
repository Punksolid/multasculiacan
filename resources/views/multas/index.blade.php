@extends('layouts.app')
@section('title', 'Todas Las')
@section('meta-description')
    <meta name="description" content="Ver todas las multas de la placa {{ $multas->pluck("placa")  }}
            multas con los folios {{ $multas->pluck("folio")}}  culiacán, sinaloa, ayuntamiento, carro, camion, moto,
vehiculo">
@endsection
@section("content-title","Listado de las Últimas Multas")

@section('content')
<div class="container">
  <div class="row my-3">
    <div class="col-md-10 mx-auto">
      
      <div class="row">
        
        <div class="col-6">
          
              {!! Form::open(['method' => 'GET', 'url' => 'multas/search']) !!}
              <div class="form-group{{ $errors->has('placa') ? ' has-error' : '' }}">
                  {!! Form::label('placa', 'Buscar Por Placa') !!}
                  {!! Form::text('placa', null, ['class' => 'form-control']) !!}
                  <small class="text-danger">{{ $errors->first('placa') }}</small>
              </div>
          
        </div>
          
        <div class="col-6">

          <div class="form-group{{ $errors->has('folio') ? ' has-error' : '' }}">
                {!! Form::label('folio', 'Buscar Por Folio') !!}
                {!! Form::text('folio', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('folio') }}</small>
          </div>

        </div>

      </div>
        
      <div class="row">
        <div class="col-12 float-right">
          <div class="btn-group float-right">
              {!! Form::reset("Reset", ['class' => 'btn btn-secondary']) !!}
              {!! Form::submit("Buscar", ['class' => 'btn btn-primary']) !!}
              {!! Form::close() !!}
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="row mb-5">
    <div class="col-md-10 mx-auto">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="thead-dark">
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
              <th class="text-center">
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($multas as $multa)
              <tr>
                <td class="align-middle">
                  {{ $multa->folio }}
                </td>
                <td class="align-middle">
                  {{ $multa->placa }}
                </td>
                <td class="align-middle">
                  {{ $multa->importe }}
                </td>

                  <td class="align-middle text-center">
                      <a class="btn btn-sm btn-outline-secondary" href="{{ route('multas.show',[$multa->id]) }}" role="button">Ver</a>
                  </td>
              </tr>
            @empty
                <tr>
                    No hay multas
                </tr>
            @endforelse
          </tbody>
        </table>
      </div> <!-- Tabla Responsive -->
        <nav aria-label="Navegador de Multas">
                {{ $multas->links() }}
        </nav>

    </div>
  </div>
  
</div>
@endsection
