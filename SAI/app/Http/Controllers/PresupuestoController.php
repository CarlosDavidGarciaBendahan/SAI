<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Presupuesto;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use App\Empresa;
use App\Detalle;
use App\Producto_Computador;
use App\Producto_Articulo;
use Carbon\Carbon;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.oficina.presupuesto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::orderby('emp_nombre','ASC')->get();
        $clientes_naturales = Cliente_Natural::orderby('cli_nat_apellido','cli_nat_nombre','ASC')->get();
        $clientes_juridicos= Cliente_Juridico::orderby('cli_jur_nombre','ASC')->get();
        $productos_computadores = Producto_Computador::orderby('pro_com_codigo','ASC')->pluck('pro_com_codigo','id');
        $productos_articulos = Producto_Articulo::orderby('pro_art_codigo','ASC')->pluck('pro_art_codigo','id');

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        //dd($fecha);
       

        return view('admin.oficina.presupuesto.create')->with(compact('empresas','clientes_naturales','clientes_juridicos','productos_computadores','productos_articulos','fecha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->articulo_id);
        //dd($request->computador_id);
        //dd($request->all());

        $presupuesto = new Presupuesto($request->all());


        $tipo_cliente = $request->tipo_cliente;
        
        if($tipo_cliente !== null){
            //dd("El tipo de cliente es: NATURAL");
            $presupuesto->pre_fk_cliente_juridico = null;
            //$presupuesto->pre_fk_cliente_natural = null;
        }else{
            //dd("El tipo de cliente es: JURIDICO");
            $presupuesto->pre_fk_cliente_natural = null;
        }

        //dd($presupuesto);

        $presupuesto->save();

        //Registro de los detalles - COMPUTADOR
        $cantidadPC = sizeof($request->computador_id);

        for ($i=0; $i < $cantidadPC; $i++) { 

            $detalle = new Detalle();

            $detalle->det_cantidad = $request->cantidad_computador[$i];
            $detalle->det_total = $request->total_computador[$i];
            $detalle->Presupuesto()->associate($presupuesto); 
            $detalle->Producto_Computador()->associate($request->computador_id[$i]); 
            $detalle->det_fk_producto_articulo = null;

            $detalle->save();
        }
        //Registro de los detalles - ARTICULO
        $cantidadArticulo = sizeof($request->articulo_id);

        for ($i=0; $i < $cantidadArticulo; $i++) { 

            $detalle = new Detalle();

            $detalle->det_cantidad = $request->cantidad_articulo[$i];
            $detalle->det_total = $request->total_articulo[$i];
            $detalle->Presupuesto()->associate($presupuesto); 
            $detalle->Producto_Articulo()->associate($request->articulo_id[$i]); 
            $detalle->det_fk_producto_computador = null;

            $detalle->save();
        }


        flash("Registro del presupuesto '' ".$presupuesto->id." '' exitoso")->success();
        return redirect()->route('presupuesto.index');
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