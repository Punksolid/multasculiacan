@extends('layouts.app')
@section('title', 'Acerca De')
@section('meta-description')
    <meta name="description" content="Acerca del proyecto Multas Culiacán">
@endsection
@section("content-title","Acerca de")

@section('content')
  <div class="row my-3">
    <div class="column col-12 text-center">
      <h1 class="mb-3">Acerca de</h1>
    </div>

    <div class="column col-10 col-md-7 mx-auto">
        <div class="text-justify">
          <p>Microproyecto pasatiempo desarrollado por <a href="https://twitter.com/punksolid/" target="_blank">@punksolid</a> y <a href="https://twitter.com/josepablogr" target="_blank">@josepablogr</a>.</p>
          <p>En la ciudad de México se pueden buscar multas colocando las placas del carro, en Culiacán por algún extraño motivo no era posible, entonces vimos que posibilidad había y encontramos la forma.</p>
          <p class="mb-5">El proyecto requiere dinero para el hosting así que está de forma experimental, si te fue útil considera donar via criptomonedas.</p>
        </div>
        <div class="text-justify">  
          <h6 class="text-center mb-4 text-muted">También puedes apoyar el proyecto de otras formas:</h6>
          <p style="font-size: 0.8em;">Si eres developer Digital Ocean ofrece beneficios por los registros referenciados, este sitio está actualmente en este proveedor <a href="https://m.do.co/c/51aaafd3434b" target="_blank">https://m.do.co/c/51aaafd3434b</a>
          O también Vultr tiene servidores dedicados muy baratos, registrate usando nuestro referal <a href="https://www.vultr.com/?ref=7508847" target="_blank">https://www.vultr.com/?ref=7508847</a></p>
          <p style="font-size: 0.8em;">El codigo del proyecto es OpenSource y aceptamos Pull Request: <a href="https://github.com/Punksolid/multasculiacan" target="_blank">https://github.com/Punksolid/multasculiacan</a>
          <br/><br/>
          O si te interesan las criptomonedas y no te haz iniciado en el mundo de ellas create una cuenta en Bitso <a href="https://bitso.com/?ref=vhlh" target="_blank">https://bitso.com/?ref=vhlh</a>
          <br/><br/>
          O ya de plano puedes respaldar tus archivos en la nube con Dropbox haznos el paro <a href="https://db.tt/Van6mRb1" target="_blank">https://db.tt/Van6mRb1</a></p>
        </div>
    </div>

    </div>
@endsection
