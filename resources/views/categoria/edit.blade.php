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
            <form action="{{ url('/categoria/'.$categorium->id) }}" method="post">
            @csrf
            {{ @method_field('PATCH') }}
            <div class="form-group">
                <label for="nombre" >Nombre Categoría: </label>
                <input type="text" name="Nombre_categoria" id="Nombre_categoria" value="{{ old('Nombre_categoria', $categorium->Nombre_categoria) }}"
                    class="form-control" tabindex="1" autofocus>
                @if ($errors->has('Nombre_categoria'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('Nombre_categoria') }}</span>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success mr-2 " tabindex="3">Actualizar </button>
            <a href="{{ route('categoria.index') }}" class="btn btn-secondary" tabindex="4">Cancelar</a>

            </form>
        </div>
    </div>
@stop

    
@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
@stop