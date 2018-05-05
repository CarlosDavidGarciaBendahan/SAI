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
        $codigosArticulo = CodigoArticulo::orderBy('cod_art_codigo','ASC')->paginate(10);

        return view('admin.producto.CodigoArticulo.index')->with(compact('codigosArticulo'));
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
        
        $codigoArticulo = codigoArticulo::find($id);
        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        return view("admin.producto.codigoArticulo.show")->with(compact('codigoArticulo','lote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $codigoArticulo = codigoArticulo::find($id);
        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        return view("admin.producto.codigoArticulo.edit")->with(compact('codigoArticulo','lote'));
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
        
        $codigoArticulo = codigoArticulo::find($id);

        //dd($codigoArticulo->codigoPC === null);

        $codigoArticulo->cod_art_fk_lote = $request->cod_art_fk_lote;
        $codigoArticulo->cod_art_estado = $request->cod_art_estado;

        $codigoArticulo->save();

        //dd($request->all());

        flash("Modificación del artículo'' ".$codigoArticulo->cod_art_codigo." '' exitosa")->success();
        return redirect()->route('codigoArticulo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $codigoArticulo = codigoArticulo::find($id);

        
        $codigoArticulo->delete();

        //dd($request->all());

        flash("Eliminación del artículo '' ".$codigoArticulo->cod_art_codigo." '' exitosa")->success();
        return redirect()->route('codigoArticulo.index');
    }

    public function asignarPC($articulo_id,$pc_id){

        $codigoArticulo = CodigoArticulo::find($articulo_id);
        
        $codigoArticulo->cod_art_fk_pc = $pc_id;
        $codigoArticulo->save();

        flash("Se ha asignado el articulo exitosamente")->success();
        return redirect()->route('codigoPC.edit',['id' => $pc_id]);
        
    }

    public function quitarPC($articulo_id,$pc_id = null){

        $codigoArticulo = CodigoArticulo::find($articulo_id);
        
        $codigoArticulo->cod_art_fk_pc = null;
        $codigoArticulo->save();

        flash("Se ha DESVINCULADO el articulo exitosamente")->success();
        if ($pc_id === null) {
            
        return redirect()->route('codigoArticulo.edit',['id' => $articulo_id]);
        } else {
            
         return redirect()->route('codigoPC.edit',['id' => $pc_id]);
        }
        
        
    }

    public function disponibilidadArticulo($codigoArticulo){ 
        $ultimaVenta = null;
        $ultimaSolicitudAprobada = null;
        $ultimaSolicitudEntragadoAprobada = null;

        foreach ($codigoArticulo->ventas as  $venta) {
            if ($venta->ven_eliminada === 0) {//Verifico que la venta NO ha sido eliminada.
                if($ultimaVenta === null){//Guardo la primera venta no eliminada que consiga.
                    $ultimaVenta = $venta->ven_fecha_compra;
                }else{//en caso de haber conseguido más de una venta NO eliminada 
                //verifico cual es la más reciente entre las dos
                    
                    if ($venta->ven_fecha_compra >= $ultimaVenta ) {
                        $ultimaVenta = $venta->ven_fecha_compra;
                    }
                    
                }
            } else {
                        # code...
            } 
        }
        //dd($ultimaVenta);
        foreach ($codigoArticulo->solicitudes as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){ //si la solicitud esta aprobada, se toma en cuenta.
                if ($ultimaSolicitudAprobada === null) {//guardo la primare solicitud aprobada.
                    $ultimaSolicitudAprobada = $solicitud->sol_fecha;
                } else {
                    if ($solicitud->sol_fecha >= $ultimaSolicitudAprobada) {
                        $ultimaSolicitudAprobada = $solicitud->sol_fecha;
                    } 
                    
                }
            }
        }

        foreach ($codigoArticulo->SolicitudesEntregadas as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){ //si la solicitud esta aprobada, se toma en cuenta.
                if ($ultimaSolicitudEntragadoAprobada === null) {//guardo la primare solicitud aprobada.
                    $ultimaSolicitudEntragadoAprobada = $solicitud->sol_fecha;
                } else {
                    if ($solicitud->sol_fecha >= $ultimaSolicitudEntragadoAprobada) {
                        $ultimaSolicitudEntragadoAprobada = $solicitud->sol_fecha;
                    } 
                    
                }
            }
        }
        
        //dd($this->VerificarFechas($ultimaVenta,$ultimaSolicitudAprobada,$ultimaSolicitudEntragadoAprobada));
        return ($this->VerificarFechas($ultimaVenta,$ultimaSolicitudAprobada,$ultimaSolicitudEntragadoAprobada));
    }
    //este metodo recibe puras fechas!!!
    public function VerificarFechas($ultimaVenta, $ultimaSolicitud, $ultimaSolicitudCambio){
        $disponible = true;
        //Valido por la existencia de las fechas.
        if ($ultimaVenta === null && $ultimaSolicitud === null && $ultimaSolicitudCambio === null) {
            $disponible = true; //NO se ha vendido, no se ha devuelto y no se ha dado en cambio.
        } else {
            if ($ultimaVenta === null && $ultimaSolicitud === null && $ultimaSolicitudCambio !== null) {
                $disponible = false; //Se entrego por cambio el producto. NO DISPONIBLE
            } else {
                if ($ultimaVenta !== null && $ultimaSolicitud === null && $ultimaSolicitudCambio === null) {
                    $disponible = false;
                } 
                else{
                    if ($ultimaVenta !== null && $ultimaSolicitud !== null && $ultimaSolicitudCambio === null) {
                        //Existe la venta y la devolucion. Debo verificar cual es mas reciente.
                        if ($ultimaVenta > $ultimaSolicitud) {
                            $disponible = false;//se vendió más recientemente que la solicitud de devolucion.
                        } else {
                            $disponible = true;
                        }
                        
                    } else {
                        if ($ultimaVenta !== null && $ultimaSolicitud !== null && $ultimaSolicitudCambio !== null) {
                            if ($ultimaVenta > $ultimaSolicitud  &&  $ultimaVenta > $ultimaSolicitudCambio) {
                                $disponible = false;
                            } else {
                                if ($ultimaSolicitud > $ultimaVenta  &&  $ultimaSolicitud > $ultimaSolicitudCambio) {
                                    $disponible = true;
                                } else {
                                    if ($ultimaSolicitudCambio > $ultimaSolicitud  &&  $ultimaSolicitudCambio> $ultimaVenta) {
                                        $disponible = false;
                                    } 
                                }
                            }
                            
                        } 
                        
                    }
                    
                }
            }
        }
        return $disponible;
    }
}
