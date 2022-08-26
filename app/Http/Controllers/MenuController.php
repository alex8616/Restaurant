<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use Illuminate\Http\Request;
use App\Models\DetalleMenu;
use App\Models\DetalleComanda;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Dompdf\options;
use Dompdf;


use Barryvdh\DomPDF\Facade\Pdf;

class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::orderBy('id', 'asc')->get();
        $detallemenus = DetalleMenu::orderBy('id', 'asc')->get();
        return view ('menu.index', compact('menus','detallemenus'));
    }

    public function create()
    {
        $platos = Plato::get();
        $comanda = Comanda::get();
        return view('menu.create', compact('comanda','platos'));
    }

	public function store(Request $request){
		try {
            DB::beginTransaction();
            $user = Auth::user();
            $menu = Menu::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_registro' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key]);
            }
            $menu->detallemenus()->createMany($results);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('menu.index')->with('error', 'No se registro la venta, verifique los datos antes de registrar la venta');
            }
            return redirect()->route('menu.index')->with('success', 'Se registró la venta');    
    }

    public function show(Menu $menu)
    {
        $detallemenus = $menu->detallemenus;
        return view('menu.show', compact('menu', 'detallemenus'));
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        //
    }

    public function cambio_de_estado($id){
      
    }

    public function pdf(Menu $menu){

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $platos = Plato::get();
        $detallemenus = $menu->detallemenus;
        //$pdf = PDF::loadView('menu.pdf', compact('menu', 'platos', 'detallemenus'))->setOptions(['defaultFont' => 'sans-serif'])->setOptions(['isRemoteEnabled',TRUE]);
        //return $pdf->stream('Reporte_de_venta'.$menu->id.'pdf');

        $pdf = app('dompdf.wrapper');
      
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);

        $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        $pdf->getDomPDF()->setHttpContext($contxt);

        //Cargar vista/tabla html y enviar varibles con la data
        $pdf = PDF::loadView('menu.pdf', compact('menu', 'platos', 'detallemenus'))->setOptions(['defaultFont' => 'sans-serif'])->setOptions(['isRemoteEnabled',TRUE]);
        //Establecer orientación horizontal al pdf
        $pdf->setPaper('A4', 'landscape');

        //descargar la vista en formato pdf 
        $fecha = date('Y-m-d');
        //return $pdf->download("MyPdf.pdf");
    }
}
