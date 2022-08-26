@extends('adminlte::page')

@section('title', 'Artículo')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>EDITAR INFORMACION DE PLATO</h1>
</div>
@stop

@section('content')
            
    <div class="card">
        <div class="card-body">
        <form action="{{ url('/plato/'.$plato->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ @method_field('PATCH') }}
            <div class="form-group">
                <label for="nombre">Nombre Plato: </label>
                <input type="text" name="Nombre_plato" id="Nombre_plato" value="{{ old('Nombre_plato', $plato->Nombre_plato) }}"
                    class="form-control" tabindex="1" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
            </div>
            <div class="mb-3">
                <label for="stock">Precio: </label>
                <input type="number" name="Precio_plato" id="Precio_plato" min="0" max="100"
                    value="{{ old('Precio_plato', $plato->Precio_plato) }}" class="form-control" tabindex="2" step="1"
                    oninput="validity.valid||(value='')">
            </div>
            <div class="form-group">
                <label for="nombre">Caracteristicas Del Plato</label>
                <textarea class="form-control" name="Caracteristicas_plato" id="Caracteristicas_plato" cols="30" rows="5">{{ old('Caracteristicas_plato', $plato->Caracteristicas_plato) }}</textarea>
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría: </label>
                <select class="form-control" name="categoria_id" id="categoria_id" tabindex="5">
                    @foreach ($categorias as $categoria)
                        @if ($categoria->id == $plato->categoria_id)
                            <option value="{{ $categoria->id }}" selected>{{ $categoria->Nombre_categoria }}</option>
                        @else
                            <option value="{{ $categoria->id }}">{{ $categoria->Nombre_categoria }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <img src="{{ asset('storage') . '/' . $plato->imagen }}" width="60" alt="">
                <input type="file" name="imagen" id="imagen" class="form-control" tabindex="3">
                @if ($errors->has('imagen'))
                    <div class="alert alert-danger">
                        <span class="error text-danger">{{ $errors->first('imagen') }}</span>
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success" tabindex="7">Actualizar </button>
            <a href="{{ route('plato.index') }}" class="btn btn-secondary  ml-2 " tabindex="8">Cancelar</a>
        </form>
        </div>
    </div>
</form>
@stop

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script>
        $("#precio_venta").blur(function() {
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
@stop
