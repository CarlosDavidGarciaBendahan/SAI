<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Lote;
use App\producto_articulo;
USE App\CodigoArticulo;
use App\Http\Requests\CodigoArticuloRequest;
use Auth;

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
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $producto_articulo = Producto_articulo::find($articulo_id);

            $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

            return view("admin.producto.codigoArticulo.create")->with(compact('producto_articulo','lote'));
            
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CodigoArticuloRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){


            $cantidad = sizeof($request->codigosArticulo);//cantidad de codigos ingresados
            $cantidadAgregada = 0;//cuenta los que se han agregado
            $NoAgregado = null; //copio los codigos no agregados

            if ($cantidad > 0) {
                for ($i=0; $i < $cantidad; $i++) { 

                    $codigoArticulo = new codigoArticulo($request->all());

                    $codigoArticulo->cod_art_codigo = strtoupper($request->codigosArticulo[$i]);
                    $codigoArticulo->cod_art_estado = $request->estado[$i];
                    $codigoArticulo->cod_art_fk_pc  = null;
                    //$codigoArticulo->cod_pc_fk_producto_articulo = $request->cod_pc_fk_producto_articulo;
                    if (!$this->Exist($codigoArticulo->cod_art_codigo)) {
                        
                        $codigoArticulo->save();
                        $cantidadAgregada++;
                    }else{
                        $NoAgregado = $NoAgregado ."/".$codigoArticulo->cod_art_codigo; 
                    }


                }

                $articulo = producto_articulo::find( $codigoArticulo->cod_art_fk_producto_articulo);
                $articulo->pro_art_cantidad = $articulo->pro_art_cantidad + $cantidadAgregada;
                $articulo->save();

                flash("Registro de los artículos exitosamente")->success();
                if ($NoAgregado !== null) {
                    flash('Estos códigos ya estan registrados: '.$NoAgregado)->error();
                    
                }
                //return redirect()->route('producto_articulo.show')->with(['id' => $request->cod_pc_fk_producto_articulo]);
                return redirect()->route('producto_articulo.show',['id' => $request->cod_art_fk_producto_articulo]);
            }else{
                flash('Debe de agregar al menos un producto.')->error();
                return redirect()->back();
            }
            
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        //dd($request->all());
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
        if ($codigoArticulo !== null) {

            $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

            return view("admin.producto.codigoArticulo.show")->with(compact('codigoArticulo','lote'));
        }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $codigoArticulo = codigoArticulo::find($id);
            if ($codigoArticulo !== null) {

                $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

                return view("admin.producto.codigoArticulo.edit")->with(compact('codigoArticulo','lote'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CodigoArticuloRequest $request, $id)
    {
        
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $codigoArticulo = codigoArticulo::find($id);

            if ($codigoArticulo !== null) {
                $codigoArticulo->cod_art_fk_lote = $request->cod_art_fk_lote;
                $codigoArticulo->cod_art_estado = $request->cod_art_estado;

                $codigoArticulo->save();

                //dd($request->all());

                flash("Modificación del artículo'' ".$codigoArticulo->cod_art_codigo." '' exitosa")->success();
                return redirect()->route('codigoArticulo.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }

        //dd($codigoArticulo->codigoPC === null);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador'){


            $codigoArticulo = codigoArticulo::find($id);
            if ($codigoArticulo !== null) {
                
                $codigoArticulo->delete();

                //dd($request->all());

                flash("Eliminación del artículo '' ".$codigoArticulo->cod_art_codigo." '' exitosa")->success();
                return redirect()->route('codigoArticulo.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }
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

    public function disponibilidadArticuloParaSolicitud($codigoArticulo,$fecha_venta){ 
        foreach ($codigoArticulo->ventas as  $venta) {
            if ($venta->ven_eliminada === 0) {//Verifico que la venta NO ha sido eliminada.
                //la ultima venta debe tener la misma fecha que $fecha_venta
                if ($fecha_venta < $venta->ven_fecha_compra) {
                    //si se consigue una venta NO eliminada, pero, dicha venta tiene fecha más reciente que la a verificar entonces el producto no está disponible.
                    return false;
                }
                
            }
        }
        //dd($ultimaVenta);
        foreach ($codigoArticulo->solicitudes as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){//si existe una slicitud con fecha más reciente que la venta, no esta disponible para otra solicitud.
                if ($fecha_venta < $solicitud->sol_fecha) {
                    return false;
                }
            }
        }

        foreach ($codigoArticulo->SolicitudesEntregadas as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){//si existe una slicitud con fecha más reciente que la venta, no esta disponible para otra solicitud.
                if ($fecha_venta < $solicitud->sol_fecha) {
                        return false;
                }
            }
        }
        
        return (true);
    }

    public function Exist($cod_art_codigo){//verifico la existencia del producto
        $exist = false;

        $pc = codigoArticulo::where('cod_art_codigo','like',$cod_art_codigo)->get();// o busco

            //dd($pc);
        if(count($pc) <> 0){// si lo consigo entonces si existe
            $exist = true;
        } 
        //dd($exist);
        return $exist;
    }
}
