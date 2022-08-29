@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REGISTRO DE VENTA - PLATOS</h1>
</div>
@stop

@section('content')
<br>
<form action="{{ url('/comanda') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row" style="width:100%; height: 100%;">
  <div class="col-sm-6">
    <div class="card" style="width:65%; height: 100%;">
      <div class="card-body">
      <div>
            <div class="form-group">
                <label for="id_plato">Plato</label>
                <select class="form-control selectpicker articuloB" data-live-search="true" name="id_plato"
                    id="id_plato" lang="es" autofocus>
                    <option value="" data-icon="fa-solid fa-bowl-rice" disabled selected>Buscar Plato</option>
                    @foreach ($platos as $plato)
                        <option value="{{ $plato->id }}_{{ $plato->stock }}_{{ $plato->Precio_plato }}">
                            {{ $plato->Nombre_plato }}    ---   {{ $plato->tipo }}
                         </option>
                      @endforeach
                   </select>
            </div>
        </div>
        <div>
            <label for="cliente_id">Cliente</label>
            <select class="form-control selectpicker clienteB" data-live-search="true" name="cliente_id" id="cliente_id" lang="es">
                <option value="" data-icon="fas fa-user-tie" disabled selected>Buscar cliente</option>
                @foreach ($clientes as $cliente)
                    @if($cliente->tipo == 'SI')
                        <option value="{{ $cliente->id }}" style="color:gold;">{{ $cliente->id }} {{ $cliente->Nombre_cliente }}</option>
                    @else
                        <option value="{{ $cliente->id }}">{{ $cliente->id }} {{ $cliente->Nombre_cliente }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" min="0"
                       max="100" oninput="validity.valid||(value='')">
            </div>
        </div>
        <div>
            <div class="form-group">
                <label for="comentario">Comentario</label>
                <textarea class="form-control" name="comentario" id="comentario" cols="45" rows="3"></textarea>
            </div>
        </div>
        <div>
            <div class="form-group col-md-15">
            <label for="descuento">Descuento</label>
            <div class="input-group">
                <select name="descuento" id="descuento" class="form-control"  aria-describedby="basic-addon2" oninput="validity.valid||(value='')">
                    <option value="0">0</option>
                    <option value="5">5</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="13">13</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon2">%</span>
                </div>
            </div>
        </div>
        </div>
        <div>
             <div class="form-group">
                 <label for="Precio_plato">Precio de venta</label>
                 <input type="number" class="form-control" name="Precio_plato" id="Precio_plato" aria-describedby="helpId" disabled>
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
    <div class="card" style="width:140%; height: 100%; margin: 0px  -220px ;">
      <div class="card-body">
        <div class="table-responsive col-md-12  table-bordered shadow-lg">
                    <table id="detalles" class="table table-striped col-md-12 table-bordered shadow-lg">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Eliminar</th>
                                <th>Artículo</th>
                                <th>Comentario</th>
                                <th>Precio Venta (Bs)</th>
                                <th>Descuento</th>
                                <th>Cantidad</th>
                                <th style="width:150px;">SubTotal (Bs)</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="6">
                                    <p align="right">TOTAL PAGAR:</p>
                                </th>
                                <th>
                                    <p align="right"><span align="right" id="total_pagar_html">Bs 0.00</span>
                                        <input type="hidden" name="total" id="total_pagar">
                                    </p>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
        </div>
      </div>
    </div>
    <div class="card-footer text-muted">
            <button type="submit" id="guardar" class="btn btn-success float-right">Registrar</button>
            <a href="{{ route('comanda.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
  </div>
</div>
</form>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css"></link>
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            $("#Precio_plato").val(datosProducto[2]);
        }

        function agregar() {
            datosProducto = document.getElementById('id_plato').value.split('_');
            id_plato = datosProducto[0];

            articulo = $("#id_plato option:selected").text();
            cantidad = $("#cantidad").val();
            comentario = $("#comentario").val();
            descuento = $("#descuento").val();
            Precio_plato = $("#Precio_plato").val();
            if (id_plato != "" && cantidad != "" && cantidad > 0 && descuento != "" && Precio_plato != "" && comentario != "") {
                if (parseInt(cantidad) > 0) {
                    subtotal[cont] = (cantidad * Precio_plato) - (cantidad * Precio_plato * descuento / 100);
                    total = total + subtotal[cont];
                    var fila = '<tr class="selected" id="fila' + cont +
                        '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
                        ');"><i class="fa fa-trash-alt"></i></button></td> <td><input type="hidden" name="id_plato[]" value="' +
                        id_plato + '">' + articulo + '</td> <td> <input type="hidden" name="comentario[]" value="' +
                        comentario + '">' + comentario + '</td> <td> <input type="hidden" name="Precio_plato[]" value="' +
                        parseFloat(Precio_plato).toFixed(2) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(Precio_plato).toFixed(2) +
                        '" disabled> </td> <td> <input type="hidden" name="descuento[]" value="' +
                        parseFloat(descuento) + '"> <input class="form-control" type="number" value="' +
                        parseFloat(descuento) + '" disabled> </td> <td> <input type="hidden" name="cantidad[]" value="' +
                        cantidad + '"> <input type="number" value="' + cantidad +
                        '" class="form-control" disabled> </td> <td align="right">Bs ' + parseFloat(subtotal[cont]).toFixed(
                            2) + '</td></tr>';
                    cont++;
                    limpiar();
                    totales();
                    evaluar();
                    $('#detalles').append(fila);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lo siento',
                        text: 'La cantidad a vender supera el stock.',
                    })
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lo siento',
                    text: 'Rellene todos los campos del detalle de la venta.',
                })
            }
        }
    
        function limpiar() {
            $("#cantidad").val("");
            $("#descuento").val("0");
            $("#comentario").val("");
        }

        function totales() {
            $("#total").html("Bs " + total.toFixed(2));
            total_pagar = total;
            $("#total_pagar_html").html("Bs " + total_pagar.toFixed(2));
            $("#total_pagar").val(total_pagar.toFixed(2));
        }

        function evaluar() {
            if (total > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
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
