@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE MENUS</h1>
</div>
@stop

@section('content')
<a href="{{ route('menu.create') }}" class="btn btn-primary mb-2">Registrar Menu Nuevo</a>
<a href="{{ route('menu.index') }}" class="btn btn-primary mb-2">Listar Menu</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Guardado!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> Error !</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('cancelado'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('cancelado') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="order-listing"
                class="table venta table-striped mt-0.5 table-bordered shadow-lg dt-responsive nowrap">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th style="width:50px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{$i=1}}
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                Menu del Dia <strong>{{ \Carbon\Carbon::parse($menu->fecha_registro)->locale('es')->isoFormat('dddd D \d\e MMMM \d\e\l Y') }}</strong>
                                - ({{ \Carbon\Carbon::parse($menu->fecha_registro)->format('d-m-Y H:i a') }})
                            </td>
                            <td style="width: 250px;">
                                    <a href="{{ route('menu.pdf', $menu) }}" class="btn btn-danger text-bold"
                                        target="_blank">Imprimir<i class="fas fa-file-pdf ml-2"></i></a>

                                    <a href="{{ route('menu.show', $menu) }}" class="btn btn-info">Detalles <i
                                            class="fas fa-eye"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@stop

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $('.venta').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registro por página",
                    "zeroRecords": "No se encontro registro",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "search": "Buscar",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                    },
                    "infoEmpty": "No hay registros",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)"
                },
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ]

            });
        });
    </script>
@stop
