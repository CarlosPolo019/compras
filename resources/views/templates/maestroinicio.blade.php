<!DOCTYPE html>
<html>
<head>
  <title></title>
      @section("tible")
      @show 

  <link rel="stylesheet" type="text/css" href="{{asset(
  'css/bootstrap.css')}}">
  <script type="text/javascript" src="{{asset(
  'js/jquery-3.2.1.min.js')}}"></script>
      @section("head")
      @show 
</head>
<body>
    
  <header>
  <section style="background: #3299f9" class="container">
    <div class="row">
      <div class="col-sm-6">
        <img src="{{asset(
  'img/logo.png')}}" style=" width: 80px; padding-top: 7px; float: left;">
        <h1 style="float: left;"></h1>
      </div>
      <div class="col-sm-3">
        <h3>TIENDA ONLINE</h3>
      </div>
      <div class="col-sm-3" class="pull-right">
      <?php
          if(!Session::has('cliente'))
          {
      ?>
      <a href="{{route('login')}}">Iniciar Session </a>
      <?php
        }
        else
        {
          $usuario = json_decode(Session::get("cliente"));
      ?>
      
      <label>{{$usuario->nombres}}</label><br>
      <a href="{{route('Miscompras')}}" title="">Mis compras</a><br>
      <a href="{{route('Cerrarsession')}}">Cerrar Sesion</a>
      


      


      <?php
        }
      ?>
      </div>
    </div>

    <nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
      <li><a href="{{route('index')}}" title="">Productos</a></li>
    </ul>


    

  </nav>
  </section>


  
    <!--! => si exite negacion si la session no exite -->

  </header>

  <div class="container">
      @section("body")
      @show 
</div>

<footer>
  
</footer>


</body>
</html>  