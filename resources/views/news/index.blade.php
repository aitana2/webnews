
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My News</div>
<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Image</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($news as $report) { ?>
                            <tr>
<td><a href="{{ route('news.show', $report->id) }}"><?php echo $report->id; ?></a></td>
                              <td><?php echo $report->title; ?></td>
                              <td><?php echo $report->categorydescription; ?></td>
                              <td><img src="{{url('/images/'.$report->image)}}" style="width:200px; heigth:200px;"></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
</div>
            </div>
        </div>
    </div>
</div>
@endsection

Agregar el siguiente código al archivo show.blade.php

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalle noticia</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form>
                      @csrf
                      <div class="form-group">
                        <label for="titulo"><b>Título</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="titulo" name="titulo" value="{{ $noticia->titulo }}">
                      </div>
                      <div class="form-group">
                        <label for="descripcion"><b>Descripción</b></label>
                        <textarea  readonly class="form-control-plaintext"  id="descripcion" name="descripcion" rows="4" cols="80" required>{{ $noticia->descripcion }}</textarea>
                      </div>
<div class="form-group">
                        <label for="categoria"><b>Categoría</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="categoria" name="categoria" value="{{ $noticia->categoriadescripcion }}">
                      </div>
<div class="form-group">
                        <label for="estatus"><b>Estatus</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="estatus" name="estatus" value="<?php if($noticia->estatus==1){ echo "Activo";} else { echo "Inactivo";}  ?>">
                      </div>
<div class="form-group">
                        <label for="estatus"><b>Imagen</b></label>
                        <br>
                        <img src="{{url('/imagenes/'.$noticia->imagen)}}" style="width:200px; heigth:200px;">
                      </div>
<div class="form-group">
                        <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-primary">Editar</a>
                      </div>
</form>
</div>
            </div>
        </div>
    </div>
</div>
@endsection

5. Crear la navegación
Agregar el siguiente código al archivo app/Http/Controllers/Auth/LoginController.php

protected $redirectTo = '/noticias';

Agregar el siguiente código al archivo /resources/views/layouts/app.blade.php

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                          <a class="nav-link"  href="/">Listar</a>
                      </li>
                      @if (Auth::check())
                      <li class="nav-item">
                          <a class="nav-link {{{ (Request::is('noticias') ? 'active' : '') }}}"  href="{{ route('noticias.index') }}">Listar</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{{ (Request::is('noticias/create') ? 'active' : '') }}}" href="{{ route('noticias.create') }}">Crear</a>
                      </li>
                      @endif
                    </ul>
<!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
<main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

6. Crear la pagina principal
Agregar el siguiente código al archivo /routes/web.php

Route::get('/', function () {
$noticias = DB::table('noticias')
      ->join('categorias', 'noticias.categorias_id', '=', 'categorias.id')
      ->where('noticias.estatus',1)
      ->select('noticias.*', 'categorias.descripcion as categoriadescripcion')
      ->get();
return view('welcome',['noticias' =>$noticias]);
});
Route::get('/show/{id}', function ($id) {
$noticia = DB::table('noticias')
      ->join('categorias', 'noticias.categorias_id', '=', 'categorias.id')
      ->where('noticias.id',$id)
      ->select('noticias.*', 'categorias.descripcion as categoriadescripcion')
      ->first();
return view('show',['noticia' =>$noticia]);
});

Agregar el siguiente código al archivo /resources/views/welcome.blade.php

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Noticias</div>
<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Id</th>
                          <th>Título</th>
                          <th>Categoría</th>
                          <th>Imagen</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($noticias as $noticia) { ?>
                            <tr>
<td><a href="show/<?php echo $noticia->id; ?>"><?php echo $noticia->id; ?></a></td>
                              <td><?php echo $noticia->titulo; ?></td>
                              <td><?php echo $noticia->categoriadescripcion; ?></td>
                              <td><img src="{{url('/imagenes/'.$noticia->imagen)}}" style="width:200px; heigth:200px;"></td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
</div>
            </div>
        </div>
    </div>
</div>
@endsection

Crear el archivo show.blade.php dentro de resources/views/ y agregar el siguiente código

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalle noticia</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form>
                      @csrf
                      <div class="form-group">
                        <label for="titulo"><b>Título</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="titulo" name="titulo" value="{{ $noticia->titulo }}">
                      </div>
                      <div class="form-group">
                        <label for="descripcion"><b>Descripción</b></label>
                        <textarea  readonly class="form-control-plaintext"  id="descripcion" name="descripcion" rows="4" cols="80" required>{{ $noticia->descripcion }}</textarea>
                      </div>
<div class="form-group">
                        <label for="categoria"><b>Categoría</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="categoria" name="categoria" value="{{ $noticia->categoriadescripcion }}">
                      </div>
<div class="form-group">
                        <label for="estatus"><b>Estatus</b></label>
                        <input type="text" readonly class="form-control-plaintext"  id="estatus" name="estatus" value="<?php if($noticia->estatus==1){ echo "Activo";} else { echo "Inactivo";}  ?>">
                      </div>
<div class="form-group">
                        <label for="estatus"><b>Imagen</b></label>
                        <br>
                        <img src="{{url('/imagenes/'.$noticia->imagen)}}" style="width:200px; heigth:200px;">
                      </div>
<div class="form-group">
                        <a href="{{ route('noticias.edit', $noticia->id) }}" class="btn btn-primary">Editar</a>
                      </div>
</form>
</div>
            </div>
        </div>
    </div>
</div>
@endsection

