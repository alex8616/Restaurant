@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->name =='Administrador')
                <h5>Bienvenid@ al sistema: <strong
                        style="color: rgb(20, 179, 241)">{{ ucwords(auth()->user()->name) }}</strong> </h5>
            @else
                <h5>Bienvenid@ al sistema: <strong
                        style="color: rgb(20, 179, 241)">{{ ucwords(auth()->user()->name) }}</strong> </h5>
                <hr>
            @endif
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
