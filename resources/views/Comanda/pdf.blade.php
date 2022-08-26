<?php
$medidaTicket = 180;

?>
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }

        td.cantidad {
            font-size: 11px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 5px;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
		} 
    </style>
</head>

<body>
    <div class="ticket centrado">
        <h1>RESTAURANT TUKO'S</h1>
        <h2>Ticket de venta {{ $comanda->id }}</h2>
        <h2>{{ \Carbon\Carbon::parse($comanda->fecha_venta)->format('d-m-Y H:i a') }}</h2>

        <table>
            <thead>
                <tr class="centrado">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">$$</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detallecomandas as $detallecomanda)
                    <tr>
                        <td class="cantidad">{{ $detallecomanda->cantidad }}</td>
                        <td class="producto">{{ Str::ucfirst($detallecomanda->plato->Nombre_plato) }}</td>
						<td class="precio">Bs. {{ $detallecomanda->precio_venta }}</td>
                    </tr>
				@endforeach
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
				Bs. {{ number_format($comanda->total, 2) }}
                </td>
            </tr>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
    </div>
</body>

</html>