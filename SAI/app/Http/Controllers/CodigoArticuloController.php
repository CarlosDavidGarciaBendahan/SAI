<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Lote;
use App\producto_articulo;
USE App\CodigoArticulo;

class CodigoArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($articulo_id)
    {
        $producto_articulo = Producto_articulo::find($articulo_id);

        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        return view("admin.producto.codigoArticulo.create")->with(compact('producto_articulo','lote'));
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

        $cantidad = sizeof($request->codigosArticulo);

        for ($i=0; $i < $cantidad; $i++) { 

            $codigoArticulo = new codigoArticulo($request->all());

            $codigoArticulo->cod_art_codigo = $request->codigosArticulo[$i];
            $codigoArticulo->cod_art_estado = $request->estado[$i];
            $codigoArticulo->cod_art_fk_pc  = null;
            //$codigoArticulo->cod_pc_fk_producto_computador = $request->cod_pc_fk_producto_computador;

            $codigoArticulo->save();

        }

        flash("Registro de los artículos exitosamente")->success();
        //return redirect()->route('producto_computador.show')->with(['id' => $request->cod_pc_fk_producto_computador]);
        return redirect()->route('producto_articulo.show',['id' => $request->cod_art_fk_producto_articulo]);
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

    public function asignarPC($articulo_id,$pc_id){

        $codigoArticulo = CodigoArticulo::find($articulo_id);
        
        $codigoArticulo->cod_art_fk_pc = $pc_id;
        $codigoArticulo->save();

        flash("Se ha asignado el articulo exitosamente")->success();
        return redirect()->route('codigoPC.edit',['id' => $pc_id]);
        
    }

    public function quitarPC($articulo_id,$pc_id){

        $codigoArticulo = CodigoArticulo::find($articulo_id);
        
        $codigoArticulo->cod_art_fk_pc = null;
        $codigoArticulo->save();

        flash("Se ha DESVINCULADO el articulo exitosamente")->success();
        return redirect()->route('codigoPC.edit',['id' => $pc_id]);
        
    }
}
