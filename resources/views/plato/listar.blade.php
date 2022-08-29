@extends('adminlte::page')

@section('title', 'Restaurant')

@section('content_header')
<div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>LISTADO DE PLATOS</h1>
</div>
@stop

@section('content')
<section class="wrapper">
    <div class="container-fostrap">
        <div class="content">
            <div class="container">
                <div class="row">
                @foreach($platos as $plato)
                    <div class="col-xs-12 col-sm-4">
                        <div class="card">
                            <a class="img-card" href="#">
                            @if (isset($plato->imagen))
                                <img class="img-thumbnail" src="{{ asset('storage' . '/' . $plato->imagen) }}"/>
                            @else
                                <img class="img-thumbnail" src="{{ asset('storage/uploads/nofound.jpg') }}"/>
                            @endif
                          </a>
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a href="#"> {{$plato->Nombre_plato}}</a>
                                </h4><br><br>
                                <p class="" style="float:left">
                                    <i class="fa-solid fa-money-bill-1-wave"></i> Precio: {{ $plato->Precio_plato }} Bs.                                
                                </p>
                                <p style="float:right">
                                    <i class="fa-solid fa-calendar-days"></i> Registro: {{date('d/m/Y');}}
                                </p>
                            </div><br><br>
                            <div class="card-read-more">
                                <a href="{{route('plato.edit',$plato)}}"class="btn btn-outline-info" style="width:48%">EDITAR</a>
                                <a href="{{route('plato.show',$plato)}}"class="btn btn-outline-warning" style="width:48%">VER</a>
                            </div><br>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    {{$platos->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

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
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
<style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

    html,
    body {
    -moz-box-sizing: border-box;
        box-sizing: border-box;
    height: 100%;
    width: 100%; 
    background: #FFF;
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    }
    
    .wrapper {
    display: table;
    height: 100%;
    width: 100%;
    }

    .container-fostrap {
    display: table-cell;
    padding: 1em;
    text-align: center;
    vertical-align: middle;
    }
    .fostrap-logo {
    width: 100px;
    margin-bottom:15px
    }
    h1.heading {
    color: #fff;
    font-size: 1.15em;
    font-weight: 900;
    margin: 0 0 0.5em;
    color: #505050;
    }
    @media (min-width: 450px) {
    h1.heading {
        font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
    h1.heading {
        font-size: 3.05em;
    }
    }
    @media (min-width: 900px) {
    h1.heading {
        font-size: 3.25em;
        margin: 0 0 0.3em;
    }
    } 
    .card {
    display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
    box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
    width: 100%;
    height:200px;
    border-top-left-radius:2px;
    border-top-right-radius:2px;
    display:block;
        overflow: hidden;
    }
    .img-card img{
    width: 100%;
    height: 200px;
    object-fit:cover; 
    transition: all .25s ease;
    } 
    .card-content {
    padding:15px;
    text-align:left;
    }
    .card-title {
    margin-top:0px;
    font-weight: 700;
    font-size: 1.65em;
    }
    .card-title a {
    color: #000;
    text-decoration: none !important;
    }
    .card-read-more {
    border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
    text-decoration: none !important;
    padding:10px;
    font-weight:600;
    text-transform: uppercase
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
       // VARIABLES
        const rangeInput = document.querySelector('input[type = "range"]');
        const imageList = document.querySelector(".image-list");
        const searchInput = document.querySelector('input[type="search"]');
        const btns = document.querySelectorAll(".view-options button");
        const photosCounter = document.querySelector(".toolbar .counter span");
        const imageListItems = document.querySelectorAll(".image-list li");
        const captions = document.querySelectorAll(".image-list figcaption p:first-child");
        const myArray = [];
        let counter = 1;
        const active = "active";
        const listView = "list-view";
        const gridView = "grid-view";
        const dNone = "d-none";

        // SET VIEW
        for (const btn of btns) {
        btn.addEventListener("click", function() {
            const parent = this.parentElement;
            document.querySelector(".view-options .active").classList.remove(active);
            parent.classList.add(active);
            this.disabled = true;
            document.querySelector('.view-options [class^="show-"]:not(.active) button').disabled = false;

            if (parent.classList.contains("show-list")) {
            parent.previousElementSibling.previousElementSibling.classList.add(dNone);
            imageList.classList.remove(gridView);
            imageList.classList.add(listView);
            } else {
            parent.previousElementSibling.classList.remove(dNone);
            imageList.classList.remove(listView);
            imageList.classList.add(gridView);
            }
        });
        }

        // SET THUMBNAIL VIEW - CHANGE CSS VARIABLE
        rangeInput.addEventListener("input", function() {
        document.documentElement.style.setProperty("--minRangeValue",`${this.value}px`);
        });

        // SEARCH FUNCTIONALITY
        for (const caption of captions) {
        myArray.push({
            id: counter++,
            text: caption.textContent
        });
        }

        searchInput.addEventListener("keyup", keyupHandler);

        function keyupHandler() {
        for (const item of imageListItems) {
            item.classList.add(dNone);
        }
        const text = this.value;
        const filteredArray = myArray.filter(el => el.text.includes(text));
        if (filteredArray.length > 0) {
            for (const el of filteredArray) {
            document.querySelector(`.image-list li:nth-child(${el.id})`).classList.remove(dNone);
            }
        }
        photosCounter.textContent = filteredArray.length;
        }
    </script>
    
    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                    'Eliminando ...',
                    'Los Datos Fueron ELIMINADOS Correctamente',
                    'success'
                    )
        </script>
    @endif

    @if(session('actualizar')=='ok')
        <script>
            Swal.fire(
                    'Actualizando ...',
                    'Los Datos Fueron Actualizados Correctamente',
                    'success'
                    )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
                Swal.fire({
                title: '¿Estas Seguro?',
                text: "Este Plato Se Eliminara Definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡SI, Eliminar!'
                }).then((result) => {
                if (result.value) {
                    this.submit();
                }
                })
        })
    </script>
@stop


