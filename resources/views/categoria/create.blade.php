@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO CATEGORIAS</h1>
</div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categoria.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre Categoría: </label>
                    <input type="text" name="Nombre_categoria" id="Nombre_categoria" value="{{ old('Nombre_categoria') }}" class="form-control"
                        tabindex="1" autofocus>
                    @if ($errors->has('Nombre_categoria'))
                        <div class="alert alert-danger">
                            <span class="error text-danger">{{ $errors->first('Nombre_categoria') }}</span>
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-success  " tabindex="3">Guardar </button>
                <a href="{{ route('categoria.index') }}" class="btn btn-secondary ml-2" tabindex="4">Cancelar</a>

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
        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Mark all as read</a>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>   
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
@stop