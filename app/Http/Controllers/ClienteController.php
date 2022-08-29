<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Database;
use Carbon\Carbon;
use App\Notifications\ClienteNotification;
use Illuminate\Support\Facades\Notification; 



class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::get();
        //auth()->user()->notify(new ClienteNotification($clientes));
        
        return view('cliente.listar',compact('clientes'));
    }

    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'Nombre_cliente' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'Apellidop_cliente' => 'nullable|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'Apellidom_cliente' => 'nullable|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50',
            'Direccion_cliente' => 'nullable|max:100',
            'Celular_cliente' => 'nullable|min:8|max:12|regex:/^[+,0-9]{8,12}$/|unique:clientes',
            'Correo_cliente' => 'nullable|email|max:100|unique:clientes',
            'FechaNacimiento_cliente' => 'required|date_format:Y-m-d|after:year',
            'latidud' => 'required',
            'longitud' => 'required',
           ]);

        $datoscliente = Cliente::create([
            'Nombre_cliente' => $data['Nombre_cliente'],
            'Apellidop_cliente' => $data['Apellidop_cliente'],
            'Apellidom_cliente' => $data['Apellidom_cliente'],
            'Direccion_cliente' => $data['Direccion_cliente'],
            'Celular_cliente' => $data['Celular_cliente'],
            'FechaNacimiento_cliente' => $data['FechaNacimiento_cliente'],
            'Correo_cliente' => $data['Correo_cliente'],
            'latidud' => $data['latidud'],
            'longitud' => $data['longitud'],
        ]);
        
        return redirect()->route('cliente.index')->with('success', 'Se registró correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $total_ventas = 0;
        foreach ($cliente->comandas as $key =>  $comanda) {
            $total_ventas +=$comanda->total;
        }
        return view('cliente.show', compact('cliente', 'total_ventas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //return response()->json($cliente);
        return view('cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datoscliente = request()->except(['_token', '_method']);

        Cliente::where('id', '=', $id)->update($datoscliente);
        $cliente = Cliente::findOrFail($id);

        return redirect()->route('cliente.index')->with('actualizar', 'ok');;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function listvip(){
        $users = User::all();
        $clientes = Cliente::where('tipo','=','SI')->get();       
        return view('cliente.listvip',compact('clientes'));
    }

    public function listcumple(){
        $users = User::all();
        $news = Cliente::whereRaw("TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, CURDATE()) < TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, ADDDATE(CURDATE(), 7))")
                        ->get();
        return view('cliente.listcumple', compact('news'));
    }

}
