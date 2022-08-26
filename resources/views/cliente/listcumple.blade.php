@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE CUMPLEAÑOS PROXIMO</h1>
</div>
@stop

@section('content')
<a href="{{ route('cliente.create') }}" class="btn btn-primary mb-2">Registrar Cliente Nuevo</a>
<a href="{{ route('cliente.listvip') }}" class="btn btn-primary mb-2">Clientes VIP</a>
<a href="{{ route('cliente.listcumple') }}" class="btn btn-primary mb-2">Actividades</a>

<div class="card">
    <div class="card-body">
    <table class="table table-striped" id="cliente">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direccion</th>
            <th>Fecha De Nacimientor</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($news as $new)
            <tr>
                <td>{{$new->id}}</td>
                <td>{{$new->Nombre_cliente}}</td>
                <td>{{$new->Apellidop_cliente}} {{$new->Apellidom_cliente}}</td>
                <td>{{$new->Direccion_cliente}}</td>
                <td>Su cumple es {{\Carbon\Carbon::parse($new->FechaNacimiento_cliente)->locale('es')->isoFormat('dddd D \d\e MMMM')}}</td>
                <td>
                    <a href="#" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
    </tbody>
</table>
    </div>
</div>
@stop

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#cliente').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
            "lengthMenu": "Mostrar  " +
                                   `<select class="custon-select custom-select-sm form-control form-control-sm"> 
                                        <option value='10'>10</option>
                                        <option value='25'>25</option>
                                        <option value='50'>50</option>
                                        <option value='100'>100</option>
                                        <option value='-1'>All</option>
                                    </select>`
                                    + " Registros Por Pagina",
            "zeroRecords": "No Se Encontro Ningun Usuario - Lo Siento",
            "info": "Mostrando La Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Ningun Registro Coincide Con Lo Buscado",
            "infoFiltered": "(Filtrado de _MAX_ Registros Totales)",
            'search': 'Buscar:',
            'paginate':{
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        }
        });
    </script>
@stop


