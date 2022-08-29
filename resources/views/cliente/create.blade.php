@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO CLIENTES</h1>
</div>
@stop

@section('content')
<div class="card" style="width: 50%">
    <div class="card-body">
        <form action="{{ url('/cliente') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="inputNombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre_cliente" name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_cliente') }}">
                @if ($errors->has('Nombre_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Nombre_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputApellidop">Apellido Paterno</label>
                <input type="text" class="form-control" id="Apellidop_cliente" name="Apellidop_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidop_cliente') }}">
                @if ($errors->has('Apellidop_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Apellidop_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputApellidom">Apellido Materno</label>
                <input type="text" class="form-control" id="Apellidom_cliente" name="Apellidom_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Apellidom_cliente') }}">
                @if ($errors->has('Apellidom_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Apellidom_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputEmail4">Fecha De Nacimiento</label>
                <input type="date" class="form-control" id="FechaNacimiento_cliente" name="FechaNacimiento_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('FechaNacimiento_cliente') }}">
                @if ($errors->has('FechaNacimiento_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('FechaNacimiento_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputEmail4">Correo Electronico</label>
                <input type="email" class="form-control" id="Correo_cliente" name="Correo_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Correo_cliente') }}">
                @if ($errors->has('Correo_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Correo_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputAddress">Direccion</label>
                <input type="text" class="form-control" id="Direccion_cliente" name="Direccion_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Direccion_cliente') }}">
                @if ($errors->has('Direccion_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Direccion_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputEmail4">Numero De Celular</label>
                <input type="text" class="form-control" id="Celular_cliente" name="Celular_cliente" value="{{ old('Celular_cliente') }}">
                @if ($errors->has('Celular_cliente'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Celular_cliente') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputEmail4">Latitud</label>
                <input type="number" name="latidud" id="latidud" class="form-control" value="-19,588591400088237" readonly>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Longitud</label>
                <input type="number" name="longitud" id="longitud" class="form-control" value="-65,75048982678497" readonly>
            </div>
            <div class="form-group">
            <label for="">SELECCIONE LA UBICACION EXACTA</label><br>
            <div class="flex-center position-ref full-height">
                <div class="content">
                    <div id="mapa" style="width: 100%; height:200px"></div>
                </div>
            </div>
            <script>
            function iniciarMapa(){
                var latitud = -19.58341986454926;
                var longitud = -65.75655027805412;
                
                coordenadas = {
                    lng: longitud,
                    lat: latitud
                }

                generarMapa(coordenadas);
            } 

            function generarMapa(coordenadas){
                var mapa = new google.maps.Map(document.getElementById('mapa'),{
                    zoom: 18,
                    center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                });

                marcador = new google.maps.Marker({
                    map: mapa,
                    draggable: true,
                    position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
                });

                    marcador.addListener('dragend',function(event){
                    document.getElementById("latidud").value = this.getPosition().lat();
                    document.getElementById("longitud").value = this.getPosition().lng();
                })
            }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZfZFrJxVmMfX7uxTrFDkEF6WncPIAvUY&callback=iniciarMapa" ></script>
        </div>
        <center>
                <button type="submit" class="btn btn-danger">Cancelar</button>
                <button type="submit" class="btn btn-success">Registrar</button>
            </center>
        </form>
    </div>
</div>
@stop
@section('content_top_nav_right')
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-bell"></i>
        @if (count(auth()->user()->unreadNotifications))
        <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
            
        @endif
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifi">
    <span class="dropdown-header" >Notificaciones Sin Leer</span>
        @forelse (auth()->user()->unreadNotifications as $notification)
        <a href="{{ route('cliente.listcumple') }}" class="dropdown-item">
        <i class="fa-solid fa-cake-candles"></i> Se acerca el cumpleaños de <strong>{{ $notification->data['Nombre_cliente']}}</strong>
        <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
        </a>
        @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones por leer </span><br> 
        @endforelse
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Marcar Todos LEIDO</a>
        <div class="dropdown-divider"></div>
            <span class="dropdown-header">Notificaciones Leidas</span>
            @forelse (auth()->user()->readNotifications as $notification)
            <a href="{{ route('cliente.listcumple') }}" class="dropdown-item">
            <i class="fa-solid fa-check-double"></i> {{ $notification->data['Nombre_cliente'] }}
            <span class="ml-3 float-right text-muted text-sm">{{ $notification->data['Nombre_cliente'], $notification->created_at->diffForHumans() }}</span>
            </a>
            @empty
            <span class="ml-3 float-right text-muted text-sm">Sin notificaciones leidas</span>
        @endforelse
    </div>
    </li>
@endsection
@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .card{
        
            position: relativa;
            top: 50%;
            left: 25%;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop