@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO MENUS</h1>
</div>
@stop

@section('content')

<form action="{{ url('/menu') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row" style="width:100%;">
  <div class="col-sm-6">
    <div class="card" style="width:65%;">
      <div class="card-body">
      <div>
            <div class="form-group">
                <label for="id_plato">Plato</label>
                <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                    id="id_plato" lang="es" autofocus>
                    <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                    @foreach ($platos as $plato)
                        <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                            {{ $plato->Nombre_plato }} {{ $plato->Precio_plato }}
                         </option>
                      @endforeach
                   </select>
            </div>
        </div>
        <div>
            <div class="form-group mt-2">
                <button type="button" id="agregar" class="btn btn-info float-right"> <i class="fas fa-check"></i> Agregar Artículo</button>
            </div>
        </div>
      </div>
    </div>
  </div>
<div class="col-sm-6">
    <div class="card" style="width:100%; height: 100%; margin: 0px  -220px ;">
      <div class="card-body">
        <div class="table-responsive col-md-12  table-bordered shadow-lg">
                    <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Eliminar</th>
                                <th>Plato</th>
                            </tr>
                        </thead>
                    </table>
        </div>
      </div>
      <div class="card-footer text-muted" style="width:100%; ">
            <button type="submit" id="guardar" class="btn btn-success float-right">Registrar</button>
            <a href="{{ route('menu.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
    </div>
   
  </div>
</div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <style>
        .card{
        
            position: relativa;
            top: 5%;
            left: 25%;
        }
    </style>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
     $(document).ready(function() {
         $("#agregar").click(function() {
             agregar();
          });
       });

        var cont = 1;
        total = 0;
        subtotal = [];
        $("#guardar").hide();
        $("#id_plato").change(mostrarValores);

        function mostrarValores() {
            datosProducto = document.getElementById('id_plato').value.split('_');
        }

        function agregar() {
            datosProducto = document.getElementById('id_plato').value.split('_');
            id_plato = datosProducto[0];

            articulo = $("#id_plato option:selected").text();
            if (id_plato != "") {
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i> Quitar De La Lista</button></td> <td><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + articulo + '</td></tr>';
                    cont++;
                    limpiar();
                    evaluar();
                    $('#detalles').append(fila);
                }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'NO seleccionaste Nada ...',
                })
            }
        }
    
        function limpiar() {
            $("#cantidad").val("");
            $("#descuento").val("0");
        }

        function evaluar() {
            $("#guardar").show();   
        }

        function eliminar(index) {
            total = total - subtotal[index];
            total_pagar_html = total;
            $("#total").html("Bs" + total);
            $("#total_pagar_html").html("Bs" + total_pagar_html.toFixed(2));
            $("#total_pagar").val(total_pagar_html.toFixed(2));
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
    <script>
        $(document).ready(function() {
            $("form").keypress(function(e) {
                if (e.which == 13) {
                    return true;
                }
            });
        });
    </script>
@stop
