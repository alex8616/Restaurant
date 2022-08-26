<?php

namespace App\Http\Controllers;

use App\Models\DetalleComanda;
use App\Models\User;
use App\Models\Comanda;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('reporte.pdf')->only(['reporte.pdf']);
    }


    public function reportePDF($userId, $tipoReporte, $desde = null, $hasta = null)
    {
        $data = [];
        if ($tipoReporte == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else {
            $from = Carbon::parse($desde)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($hasta)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($userId == 0) {
            $data = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->whereBetween('comandas.fecha_venta', [$from, $to])
                ->get();
        } else {
            $data  = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->whereBetween('comandas.fecha_venta', [$from, $to])
                ->where('user_id', $userId)
                ->get();
        }
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;

        $pdf = PDF::loadView('report.pdf', compact('data', 'tipoReporte', 'user', 'desde', 'hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }
}
