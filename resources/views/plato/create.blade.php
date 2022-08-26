@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO PLATOS</h1>
</div>
@stop

@section('content')

<div class="card" style="width: 50%">
    <div class="card-body">
        <form action="{{ url('/plato') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="inputNombre">Nombre</label>
                <input type="text" class="form-control" id="Nombre_plato" name="Nombre_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Nombre_plato') }}">
                @if ($errors->has('Nombre_plato'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Nombre_plato') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputApellidop">Precio del plato</label>
                <input type="Number" class="form-control" id="Precio_plato" name="Precio_plato"  onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{ old('Precio_plato') }}">
                @if ($errors->has('Precio_plato'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Precio_plato') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputApellidom">Caracteristicas Del Plato</label>
                <textarea class="form-control" placeholder="Breve Resumen Del Plato" id="Caracteristicas_plato" name="Caracteristicas_plato" rows="5" cols="51  " onkeyup="javascript:this.value=this.value.toUpperCase();" ></textarea>
                @if ($errors->has('Caracteristicas_plato'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('Caracteristicas_plato') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="inputApellidom">Categoria Del Plato</label>
                <select id="categoria_id" name="categoria_id" class="form-control">
                <option value="" >Seleccione Una De las Opciones</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id}}" {{ old('Nombre_categoria') == $categoria->id ? "selected" :""}} >{{ $categoria->Nombre_categoria}}</option>
                    @endforeach
                </select>
                @if ($errors->has('$categoria->Nombre_categoria'))
                         <span class="error text-danger" style="color:#fff";>{{ $errors->first('$categoria->Nombre_categoria') }}</span><br>
                @endif
            </div>
            <div class="form-group">
                <label for="imagen">Imagen: </label>
                <input type="file" name="imagen" id="imagen" value="{{ old('imagen') }}" class="form-control" tabindex="3">
                @if ($errors->has('imagen'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('imagen') }}</span>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <center>
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </center> 
            </div>
        </div>
    </form>
    </div>
</div>

@stop

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
    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop