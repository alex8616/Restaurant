@extends('adminlte::page')

@section('title', 'Detalles de Venta')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>DETALLE DE MENU</h1>
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-12 text-center">
                    <p>Menu del Dia <strong>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</strong>
                                - ({{ \Carbon\Carbon::parse($menu->fecha_registro)->format('d-m-Y H:i a') }})</p>
                </div>
                
            </div>
            <div class="form-group">
                <h4 class="card-title text-bold">Detalle del Menu</h4>
                <div class="table-responsive col-md-12 table-bordered shadow-lg">
                    <table id="saleDetails" class="table table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Plato</th>
                                <th>Descripcion</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detallemenus as $detallemenu)
                            <tr>
                                <td>{{ucwords($detallemenu->plato->Nombre_plato)}}</td>
                                <td>{{$detallemenu->plato->Caracteristicas_plato}}</td>
                                <td style="width:300px">
                                    <center>
                                        @if (isset($detallemenu->plato->imagen))
                                            <img class="img-thumbnail" src="{{ asset('storage' . '/' . $detallemenu->plato->imagen) }}" style="width: 180px; height: 180px;"/>
                                        @else
                                            <img class="img-thumbnail" src="{{ asset('storage/uploads/nofound.jpg') }}" style="width: 180px; height: 180px;"/>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{route('menu.index')}}" class="btn btn-primary float-right">Regresar</a>
        </div>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.8/css/responsive.bootstrap4.min.css">
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

@stop

@section('js')
  
@stop