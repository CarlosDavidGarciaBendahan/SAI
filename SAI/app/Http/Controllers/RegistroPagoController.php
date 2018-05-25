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
    /*public function index()
    {
        //
    }*/

    public function index($venta_id)
    {
        $registroPagos = RegistroPago::where('reg_fk_venta','=',$venta_id)->orderby('id','ASC')->paginate(10);

        //dd(count($registroPagos));
        if (count($registroPagos) !== 0) {
            return view('admin.cliente.registroPago.index')->with(compact('registroPagos'));
        } else {
            flash("La venta #".$venta_id." no tiene registrado ningún pago.")->error();
            return redirect()->route('venta.index');
        }
        
        
    }

    public function listarRegistroPago($x = 1){

        //dd($x);
        $registroPagos = RegistroPago::orderby('reg_fk_venta','DESC')->paginate(10);

        //dd($registroPagos);

        return view('admin.cliente.registroPago.index')->with(compact('registroPagos'));
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

        $monto_pagado = 0;

        foreach ($venta->RegistroPagos as $pago) {
            $monto_pagado = $monto_pagado + $pago->reg_monto;
        }
       
        if ($monto_pagado >= $venta->ven_monto_total) {
            flash("La venta #".$venta->id." ha sido pagada en su totalidad. NO puede registrar más pagos.")->error();
            return redirect()->route('venta.index');
        } else {
            return view('admin.cliente.registroPago.create')->with(compact('bancos','venta'));
        }

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

        $venta = Venta::find($request->reg_fk_venta);
        $pagado = 0;
        $PorPagar = 0;
        //VERIFICO SI LA VENTA TIENE REGISTROS ASOCIADOS
        if ( count($venta->RegistroPagos) !== 0 ) {
            //Sumo todo lo que se ha pagado
            foreach ($venta->RegistroPagos as  $RegistroPago) {
                $pagado = $pagado + $RegistroPago->reg_monto;
            }

            $PorPagar = $venta->ven_monto_total - $pagado;
            //verifico que lo que se ha pagado + lo que se este pagando
            //no sea mayor que el monto de la venta.
            if ( $venta->ven_monto_total >= ($pagado + $request->reg_monto) ){
                $registroPago = new RegistroPago($request->all());
                $registroPago->save();

                flash("Se ha registrado el pago exitosamente por un monto de: ".$request->reg_monto." ".$request->reg_moneda." en a venta #".$venta->id)->success();
                return redirect()->route('venta.index');
            } else {
                flash("El monto: ".$request->reg_monto." ".$request->reg_moneda. " sobre pasa el valor de la venta #".$venta->id. " El monto que falta por pagar es de: ".$PorPagar." ".($pagado + $request->reg_monto))->error();
                return redirect()->back();
            }
            

        } else {
            if ( $venta->ven_monto_total >= ($pagado + $request->reg_monto) ){
                $registroPago = new RegistroPago($request->all());
                $registroPago->save();

                flash("Se ha registrado el pago exitosamente por un monto de: ".$request->reg_monto." ".$request->reg_moneda." en a venta #".$venta->id)->success();
                return redirect()->route('venta.index');
            } else {
                flash("El monto: ".$request->reg_monto." ".$request->reg_moneda. " sobre pasa el valor de la venta #".$venta->id. " El monto que falta por pagar es de: ".$venta->monto_total)->error();
                return redirect()->back();
            }
        }
        
        
        

        /*$registroPago = new RegistroPago($request->all());
        $registroPago->save();

        flash("Se ha registrado el pago exitosamente por un monto de: ".$request->reg_monto." ".$request->reg_moneda)->success();
        return redirect()->route('venta.index');*/


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
        $registroPago = RegistroPago::find($id);
        $bancos = Banco::orderby('ban_nombre','ASC')->pluck('ban_nombre','id');

        return view('admin.cliente.registropago.edit')->with(compact('registroPago','bancos'));
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
        //dd($request->all());
        $registroPago = RegistroPago::find($id);

        $registroPago->reg_fecha_pagado = $request->reg_fecha_pagado ;
        $registroPago->reg_monto = $request->reg_monto ;
        $registroPago->reg_moneda = $request->reg_moneda ;
        $registroPago->reg_concepto = $request->reg_concepto ;
        $registroPago->reg_forma = $request->reg_forma ;
        $registroPago->reg_fk_banco_origen = $request->reg_fk_banco_origen ;
        $registroPago->reg_fk_banco_destino = $request->reg_fk_banco_destino ;

        $registroPago->save();

        flash("La modificación del registro #". $registroPago->id." fue exitosa")->success();
        return redirect()->route('registroPago.index',['id'=>$registroPago->reg_fk_venta]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registroPago = RegistroPago::find($id);
        $registroPago->delete();
        flash("La eliminación del registro #". $registroPago->id." fue exitosa")->success();
        return redirect()->route('registroPago.index',['id'=>$registroPago->reg_fk_venta]);
    }
}
