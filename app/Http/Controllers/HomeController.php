<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
        
        //$ventasmes = DB::select('SELECT month(comandas.fecha_venta) as mes, sum(comandas.total) as totalmes from comandas  group by month(comandas.fecha_venta) order by month(comandas.fecha_venta) desc limit 12');

        $ventasmes = DB::select('SELECT month(comandas.fecha_venta) as mes, sum(comandas.total) as totalmes from comandas  group by month(comandas.fecha_venta) order by month(comandas.fecha_venta) desc limit 12');

        $ventasdia = DB::select('SELECT DATE_FORMAT(comandas.fecha_venta,"%d/%m/%Y") as dia, sum(comandas.total) as totaldia from comandas  group by comandas.fecha_venta order by day(comandas.fecha_venta) desc limit 15');
      
        $productosvendidos = DB::select('SELECT   
        sum(detalle_comandas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comandas on platos.id=detalle_comandas.plato_id 
        inner join comandas on detalle_comandas.comanda_id=comandas.id where year(comandas.fecha_venta)=year(curdate()) 
        group by platos.Nombre_plato, platos.id order by sum(detalle_comandas.cantidad) desc limit 10');


        /*
        $productosvendidos = DB::select('SELECT a.codigo as codigo, 
        sum(dv.cantidad) as cantidad, a.nombre as nombre , a.id as id , a.stock as stock from articulos a
        inner join detalle_ventas dv on a.id=dv.articulo_id 
        inner join ventas v on dv.venta_id=v.id where v.estado="VALIDO" 
        and year(v.fecha_venta)=year(curdate()) 
        group by a.codigo ,a.nombre, a.id , a.stock order by sum(dv.cantidad) desc limit 10');

        */

        return view('home.dashboard', compact('ventasmes', 'ventasdia', 'productosvendidos'));
    }
}
