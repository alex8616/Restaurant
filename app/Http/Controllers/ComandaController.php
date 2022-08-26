<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use Illuminate\Http\Request;
use App\Models\DetalleComanda;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Articulo;
use App\Models\DetalleVenta;
use App\Models\Venta;

use Barryvdh\DomPDF\Facade\Pdf;



class ComandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comandas = Comanda::orderBy('id', 'asc')->get();
        $detallecomandas = DetalleComanda::orderBy('id', 'asc')->get();
        return view ('comanda.index', compact('comandas','detallecomandas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::get();
        $platos = Plato::get();
        $comanda = Comanda::get();
        return view('comanda.create', compact('clientes','comanda','platos'));
        return response()->json($comanda);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Reqpuest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        try {
            DB::beginTransaction();
            $user = Auth::user();
            $comanda = Comanda::create($request->all() + [
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
            ]);
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "descuento" => $request->descuento[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comanda->detallecomandas()->createMany($results);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('comanda.index')->with('error', 'No se registro la venta, verifique los datos antes de registrar la venta');
            }
            return redirect()->route('comanda.index')->with('success', 'Se registró la venta');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function show(Comanda $comanda)
    {
        $subtotal = 0;
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
            $subtotal += $detallecomanda->cantidad *
            $detallecomanda->precio_venta - $detallecomanda->cantidad *
            $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }

        return view('comanda.show', compact('comanda', 'detallecomandas', 'subtotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function edit(Comanda $comanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comanda $comanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comanda  $comanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comanda $comanda)
    {
        //
    }

    public function cambio_de_estado($id){
        $comanda = Comanda::findOrFail($id);
        $comanda->estado = 'CANCELADO';
        $comanda->update();
        return redirect()->back()->with('Confirmado');
    }

    public function pdf(Comanda $comanda){

        $subtotal = 0;
        $detallecomandas = $comanda->detallecomandas;
        foreach ($detallecomandas as $detallecomanda) {
                $subtotal += $detallecomanda->cantidad *
                $detallecomanda->precio_venta - $detallecomanda->cantidad *
                $detallecomanda->precio_venta * $detallecomanda->descuento / 100;
        }
        $pdf = PDF::loadView('comanda.pdf', compact('comanda', 'subtotal', 'detallecomandas'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,150,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$comanda->id.'pdf');
    }
}
