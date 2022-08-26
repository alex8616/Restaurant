@extends('adminlte::page')

@section('title', 'Información de los Artículos')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>DETALLE DEL PLATO</h1>
</div>
@stop

@section('content')
<div class="recipe-container">
    @if (isset($plato->imagen))
        <img class="recipe-image" src="{{ asset('storage' . '/' . $plato->imagen) }}" style="width: 50%; height: 100%;"/>
    @else
	    <img class="recipe-image" src="{{ asset('storage/uploads/nofound.jpg') }}" style="width: 50%; height: 100%;"/>
    @endif
 <div class="recipe-content">
    <h2 class="heading-2">Nombre Del Plato</h2>
    <h1 class="heading-1">
	{{$plato->Nombre_plato}}<br>
    </h1>
    <p class="paragraph">
	{{ $plato->Caracteristicas_plato }}
    </p>
    <ul class="recipe-list meta">
      <li class="recipe-item">
        <div class="recipe-value">{{ $plato->Precio_plato }} Bs</div>
        <div class="recipe-text">Precio</div>        
      </li>
      <li class="recipe-item">
        <div class="recipe-value">{{date('d/m/Y');}}</div>        
        <div class="recipe-text">Registro</div>        
      </li>
    </ul>
    <div class="recipe-stars">
      <span class="recipe-star"></span>
      <span class="recipe-star"></span>
      <span class="recipe-star"></span>
      <span class="recipe-star"></span>
      <span class="recipe-star inactive"></span>
      <span class="recipe-ratings">29</span>
    </div>
    <center>
	   <a id="btnatras" class="btn btn-primary" href="{{ route('plato.index') }}">Atras</a>
	</center>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.8/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{asset('css/show.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('js')
@stop
    