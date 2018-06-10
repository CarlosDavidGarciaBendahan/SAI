<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Producto_Computador;
use App\Lote;
use App\CodigoPC;
use App\CodigoArticulo;
use App\Http\Requests\CodigoPCRequest;
use Auth;

class CodigoPCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigosPC = CodigoPC::orderBy('cod_pc_codigo','ASC')->paginate(10);

        return view('admin.producto.codigoPC.index')->with(compact('codigosPC'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($computador_id)
    {
        $producto_computador = Producto_Computador::find($computador_id);

        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        return view("admin.producto.codigoPC.create")->with(compact('producto_computador','lote'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CodigoPCRequest $request)
    {
        //dd($request->all());

        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $cantidad = sizeof($request->codigosPC);//cantidad de codigos ingresados
            $cantidadAgregada = 0;//cuenta los que se han agregado
            $NoAgregado = null; //copio los codigos no agregados

            if ($cantidad > 0) {
                for ($i=0; $i < $cantidad; $i++) { 

                    $codigoPC = new codigoPC($request->all());

                    $codigoPC->cod_pc_codigo = strtoupper($request->codigosPC[$i]);
                    $codigoPC->cod_pc_estado = $request->estado[$i];
                    $codigoPC->cod_pc_costo = $request->costo[$i];
                    //$codigoPC->cod_pc_fk_producto_computador = $request->cod_pc_fk_producto_computador;
                    if (!$this->Exist($codigoPC->cod_pc_codigo)) {
                        $codigoPC->save();
                        $cantidadAgregada++;
                    }else{
                        $NoAgregado = $NoAgregado ."/".$codigoPC->cod_pc_codigo; 
                    }
                }

                $Computador = producto_computador::find( $request->cod_pc_fk_producto_computador);
                $Computador->pro_com_cantidad = $Computador->pro_com_cantidad + $cantidadAgregada;
                $Computador->save();

                flash("Registro de las computadoras exitosamente")->success();
                if ($NoAgregado !== null) {
                    flash('Estos códigos ya estan registrados: '.$NoAgregado)->error();
                    
                }
                return redirect()->route('producto_computador.show',['id' => $request->cod_pc_fk_producto_computador]);
            }else{
                flash('Debe de agregar al menos un producto.')->error();
                return redirect()->back();
            }
            
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $codigoPC = CodigoPC::find($id);
            if ($codigoPC !== null) {

                $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

                $codigosArticulo = CodigoArticulo::where('cod_art_fk_pc','=',$id)->orderBy('cod_art_codigo','ASC')->paginate(5);


                return view("admin.producto.codigoPC.show")->with(compact('codigoPC','lote','codigosArticulo'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('codigoPC.index');
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
            $codigoPC = CodigoPC::find($id);

            
                if ($codigoPC !== null) {
                    //verifico si esta disponible
                    //SI esta disponible entonces puedo modificarlo
                    if($this->disponibilidadPC($codigoPC)){
                        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

                            $codigosArticulo = CodigoArticulo::orderBy('cod_art_fk_pc','ASC')->paginate(5);


                            return view("admin.producto.codigoPC.edit")->with(compact('codigoPC','lote','codigosArticulo'));
                    }else{
                        flash("El computador '' ".$codigoPC->cod_pc_codigo." '' no está disponible. No puede ser modificado")->error();
                        return redirect()->route('codigoPC.index');
                    }
                    

                }else{  
                    flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                    return redirect()->route('codigoPC.index');
                }
            
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
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
    public function update(CodigoPCRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $codigoPC = CodigoPC::find($id);
            if ($codigoPC !== null) {

            //verifico si esta disponible
            //SI esta disponible entonces puedo modificarlo
            if($this->disponibilidadPC($codigoPC)){
                $codigoPC->cod_pc_fk_lote = $request->cod_pc_fk_lote;
                $codigoPC->cod_pc_estado = $request->cod_pc_estado;

                $codigoPC->cod_pc_costo = $request->cod_pc_costo;
                $codigoPC->save();

                //dd($request->all());

                flash("Modificación de la PC '' ".$codigoPC->cod_pc_codigo." '' exitosa")->success();
                return redirect()->route('codigoPC.index');
            }else{
                flash("El computador '' ".$codigoPC->cod_pc_codigo." '' no está disponible. No puede ser modificado")->error();
                return redirect()->route('codigoPC.index');
            }
                

            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('codigoPC.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        
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

            $codigoPC = CodigoPC::find($id);
            if ($codigoPC !== null) {
                $codigoPC->delete();

                //dd($request->all());

                flash("Eliminación de la PC '' ".$codigoPC->cod_pc_codigo." '' exitosa")->success();
                return redirect()->route('codigoPC.index');

            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('codigoPC.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }

        
    }

    public function disponibilidadPC($codigoPC){ 
        $ultimaVenta = null;
        $ultimaSolicitudAprobada = null;
        $ultimaSolicitudEntragadoAprobada = null;

        foreach ($codigoPC->ventas as  $venta) {
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
        foreach ($codigoPC->solicitudes as  $solicitud) {
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

        foreach ($codigoPC->SolicitudesEntregadas as  $solicitud) {
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

    public function disponibilidadPCParaSolicitud($codigoPC,$fecha_venta){ 
        foreach ($codigoPC->ventas as  $venta) {
            if ($venta->ven_eliminada === 0) {//Verifico que la venta NO ha sido eliminada.
                //la ultima venta debe tener la misma fecha que $fecha_venta
                if ($fecha_venta < $venta->ven_fecha_compra) {
                    //si se consigue una venta NO eliminada, pero, dicha venta tiene fecha más reciente que la a verificar entonces el producto no está disponible.
                    return false;
                }
                
            }
        }
        //dd($ultimaVenta);
        foreach ($codigoPC->solicitudes as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){//si existe una slicitud con fecha más reciente que la venta, no esta disponible para otra solicitud.
                if ($fecha_venta < $solicitud->sol_fecha) {
                    return false;
                }
            }
        }

        foreach ($codigoPC->SolicitudesEntregadas as  $solicitud) {
            if($solicitud->sol_aprobado === 'S'){//si existe una slicitud con fecha más reciente que la venta, no esta disponible para otra solicitud.
                if ($fecha_venta < $solicitud->sol_fecha) {
                        return false;
                }
            }
        }
        
        return (true);
    }


    public function Exist($cod_pc_codigo){//verifico la existencia del producto
        $exist = false;

        $pc = codigoPC::where('cod_pc_codigo','like',$cod_pc_codigo)->get();// o busco

            //dd($pc);
        if(count($pc) <> 0){// si lo consigo entonces si existe
            $exist = true;
        } 
        //dd($exist);
        return $exist;
    }
}
