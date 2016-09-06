@extends('layouts.app')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">


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
                    <th>Descripcion</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                {!! $multa->multas_html !!}
            </tbody>
        </table>
      
      </div>
    </div>
  </div>
</div>
@endsection
