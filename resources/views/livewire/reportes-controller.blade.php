<div>
@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')

@stop

@section('content')
    
    <h1>hola mundo ale como estas :(</h1>

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

@stop

@section('js')

@stop
</div>
