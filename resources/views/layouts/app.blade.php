<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="google-site-verification" content="RXESWnTAaakiQHhk0h-xx_bjjkzpb_aBw3GecDdtpA8" />
    @yield("meta-description")
    <meta Content-Language="es">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title") - Multas de Tránsito de Culiacán</title>

    <!-- Styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
}
.modal-default-button {
  float: right;
}
/*
 * the following styles are auto-applied to elements with
 * v-transition="modal" when their visiblity is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */
/*.modal-enter, .modal-leave {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}*/
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark fixed-top">      
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="navbar-toggler-icon"></span>
          </button> <a class="navbar-brand pl-5" href="#"><img src="{{ asset("storage/MultasCuliacan.svg")  }}" width="150" alt="Multas Culiacán"></a>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav">
              <li class="nav-item active">
                 <a class="nav-link" href="{{ url('/') }}">INICIO <span class="sr-only">(actual)</span></a>
              </li>
              <li class="nav-item">
                 <a class="nav-link" href="{{ url('/multas') }}">MULTAS</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link" href="{{ url('/acercade') }}">ACERCA DE</a>
              </li>


            </ul>

              <div class="collapse navbar-collapse" id="app-navbar-collapse">
                  <!-- Left Side Of Navbar -->
                  <ul class="nav navbar-nav">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="nav navbar-nav navbar-right">
                      <!-- Authentication Links -->
                      @if (Auth::guest())
                          {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
                          {{--<li><a href="{{ url('/register') }}">Registro</a></li>--}}
                      @else
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ url('/logout') }}"
                                          onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                          Logout
                                      </a>

                                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                      </form>
                                  </li>
                              </ul>
                          </li>
                      @endif
                  </ul>
              </div> <!-- Right Menu -->

          </div>
      </nav>

      <section class="jumbotron bienvenida text-center">
        <div class="container collapse mt-3" id="bienvenida">
          <h2>Bienvenido</h2>
            <div class="lead text-muted" style="font-size:0.9em;">
              <p>
              Multas Culiacán es una herramienta de recopilación automatica de datos sobre las multas emitidas por Vialidad y transito en la ciudad de Culiacán, Sinaloa, Mex.<br>
              Esta herramienta es sin fin de lucro, sientete libre de compartirla es solamente informativa.
              Agradecemos tu apoyo..</p>
              <p>
                <a class="btn btn-primary btn-large" href="#donacion">Apoyar</a>
                <a class="btn btn-secondary btn-large" href="/acercade">Acerca de</a>
              </p>
            </div>
        </div>

          <a class="ocultar" data-toggle="collapse" href="#bienvenida" role="button" aria-expanded="false" aria-controls="bienvenida" style="font-size: 2em;color: #b9b9b9;">
            <i class="fas fa-angle-down"></i>
            <i class="fas fa-angle-up" style="display:none;"></i>
          </a>

      </section>

    <script src="{{ asset('js/app.js')}}"></script>

  <div class="content">
      @yield('content')
  </div>

<!-- Colaboradores -->
<div class="modal" id="colaboradores" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Colaboradores:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul compact>
            <li style="font-size: 1.2em;">Programación: <a href="https://github.com/punksolid/" target="_blank">Punksolid</a></li>
            <li class="text-muted">Diseño: <a href="https://twitter.com/josepablogr" target="_blank">josepablogr</a></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin / Colaboradores -->
<footer class="text-muted" style="font-size:0.8em">
      <div class="container">
        <p class="float-right">
          <a href="#"><i class="fas fa-angle-up"></i></a>
        </p>
        <p>Multas Culiacán © 2018 / Todos los derechos reservados. - <a href="#colaboradores" role="button" data-toggle="modal" data-target="#colaboradores">Colaboradores</a></p>
      </div>
</footer>


<script>
$( "a.ocultar" ).click(function() {
  $( "a.ocultar > i" ).toggle();
});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Scripts -->

</body>
</html>
