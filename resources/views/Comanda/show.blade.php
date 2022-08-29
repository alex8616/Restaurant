@extends('adminlte::page')

@section('title', 'Detalles de Venta')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>DETALLE COMPLETO DE LA VENTA</h1>
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-4 text-center">
                    <label class="form-control-label "><strong>Cliente</strong></label>
                    <p>{{ucwords($comanda->cliente->Nombre_cliente)}} {{ucwords($comanda->cliente->Apellidop_cliente)}}</p>
                    
                </div>
                <div class="col-md-4 text-center">
                    <label class="form-control-label"><strong>Número Venta</strong></label>
                    <p>{{$comanda->id}}</p>
                </div>
                <div class="col-md-4 text-center">
                    <label class="form-control-label"><strong>Vendedor</strong></label>
                    <p>{{Str::ucfirst($comanda->user->name)}}</p>
                </div>
            </div>
            <div class="form-group">
                <h4 class="card-title text-bold">Detalles de venta</h4>
                <div class="table-responsive col-md-12 table-bordered shadow-lg">
                    <table id="saleDetails" class="table table-striped">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Plato</th>
                                <th>Comentario</th>
                                <th>Precio Venta (Bs)</th>
                                <th>Descuento(Bs)</th>
                                <th>Cantidad</th>
                                <th>SubTotal(Bs)</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5">
                                    <p align="right">TOTAL:</p>
                                </th>
                                <th>
                                    <p align="left">Bs. {{number_format($comanda->total,2)}}</p>
                                </th>
                            </tr>

                        </tfoot>
                        <tbody>
                            @foreach($detallecomandas as $detallecomanda)
                            <tr>
                                <td>{{ucwords($detallecomanda->plato->Nombre_plato)}}</td>
                                <td>{{$detallecomanda->comentario}}</td>
                                <td>Bs. {{$detallecomanda->precio_venta}}</td>
                                <td>{{$detallecomanda->descuento}} %</td>
                                <td>{{$detallecomanda->cantidad}}</td>
                                <td align="left">Bs. {{number_format($detallecomanda->cantidad*$detallecomanda->precio_venta - $detallecomanda->cantidad*$detallecomanda->precio_venta*$detallecomanda->descuento/100,2)}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{route('comanda.index')}}" class="btn btn-primary float-right">Regresar</a>
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
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

@stop

@section('js')
  
@stop