@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gráfico de ventas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <i class="fas fa-gift"></i>
                Ventas Mensuales
            </h4>
        <div class="table-responsive ">
                   <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
                    <thead class="bg-primary text-white">
                           <tr>
                               <th>Mes</th>
                               <th>Total Mes</th>
                               <th>Ver detalles</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($ventasmes as $total)
                           <tr>
                                   <td>{{ \Carbon\Carbon::createFromFormat('m', $total->mes)->formatLocalized('%B')}}</td>
                                   <td>Bs. {{ number_format($total->totalmes, 2) }}</td>
                                   <td>
                                        <a href="{{ route('comanda.index') }}" class="small-box-footer h4">Ventas <i
                                        class="fa fa-arrow-circle-right"></i></a>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                </table>
            </div>


            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-gift"></i>
                                Ventas diarias
                            </h4>
                            <canvas id="ventas_diarias" height="100"></canvas>
                            <div id="orders-chart-legend" class="orders-chart-legend"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-chart-line"></i>
                                Ventas - Meses
                            </h4>
                            <canvas id="ventas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <i class="fas fa-couch"></i>
                                Productos más vendidos
                            </h4>
                            <div class="table-responsive ">
                                <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad vendida</th>
                                            <th>Ver detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productosvendidos as $productosvendido)
                                            <tr>
                                                <td>{{ $productosvendido->id }}</td>
                                                <td>{{ Str::ucfirst($productosvendido->Nombre_plato) }}</td>
                                                <td><strong>{{ $productosvendido->cantidad }}</strong> Unidades</td>
                                                <td>
                                                        <a class="btn btn-primary"
                                                            href="{{ route('plato.show', $productosvendido->id) }}">
                                                            Ver <i class="far fa-eye"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script> console.log('Hi!'); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script>
        $(function() {

            var varVenta = document.getElementById('ventas').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasmes as $reg) {
    setlocale(LC_TIME, 'es_ES', 'Spanish_Bolivia', 'Bolivia');
    $mes_traducido = strftime('%B', strtotime($reg->mes));

    echo '"' . $mes_traducido . '",';
} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasmes as $reg) {
    echo '' . $reg->totalmes . ',';
} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            var varVenta = document.getElementById('ventas_diarias').getContext('2d');
            var charVenta = new Chart(varVenta, {
                type: 'bar',
                data: {
                    labels: [<?php foreach ($ventasdia as $ventadia) {
    $dia = $ventadia->dia;
    echo '"' . $dia . '",';
} ?>],
                    datasets: [{
                        label: 'Ventas',
                        data: [<?php foreach ($ventasdia as $reg) {
    echo '' . $reg->totaldia . ',';
} ?>],
                        backgroundColor: 'rgba(20, 204, 20, 1)',
                        borderColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                },
            });
        });
    </script>

@stop
