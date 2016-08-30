@extends('layouts.app')
@section('content')

  <div id="messages">
      Contador  @{{ someData }}
  </div>

    <script src="{{ asset('js/multas.js') }}" ></script>

@endsection
