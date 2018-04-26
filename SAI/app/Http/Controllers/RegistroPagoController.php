<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\flash\flash;
use App\RegistroPago;
use App\Banco;
use App\Venta;

class RegistroPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($venta_id)
    {
        $bancos = Banco::orderby('ban_nombre','ASC')->pluck('ban_nombre','id');
        $venta = Venta::find($venta_id);

        return view('admin.cliente.registroPago.create')->with(compact('bancos','venta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $registroPago = new RegistroPago($request->all());
        $registroPago->save();

        flash("Se ha registrado el pago exitosamente por un monto de: ".$request->reg_monto." ".$request->reg_moneda)->success();
        return redirect()->route('venta.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
