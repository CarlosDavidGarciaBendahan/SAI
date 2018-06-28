<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\NotaEntrega;
use App\Solicitud;
use App\CodigoPC;
use App\CodigoArticulo;
use App\http\Controllers\CodigoPCController;
use App\http\Controllers\CodigoArticuloController;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        /*$codigoPCs = CodigoPC::orderby('cod_pc_codigo','ASC')->get();
        $PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();

            foreach ($codigoPCs as $key => $codigoPC) {
               
               if(!$PC->disponibilidadPC($codigoPC)){ //SI NO esta disponible lo quito
                    $codigoPCs->forget($key);//agrego los disponibles!!!
                }
            } 

        dd($codigoPCs);*/
        //$this->ObtenerPCsEntregadasPorCambio(6);
        $solicitudes = Solicitud::orderBy('id','DESC')->paginate(10);

        return view('admin.cliente.solicitud.index')->with(compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarNotas($s)
    {
        $notaEntregas = NotaEntrega::orderby('id','ASC')->paginate(10);
        return view('admin.cliente.solicitud.listarNotas')->with(compact('notaEntregas'));
    }

    public function create($notaEntrega_id)
    {
        $notaEntrega = notaEntrega::find($notaEntrega_id);
        $solicitudes = solicitud::where('sol_fk_notaentrega','=',$notaEntrega_id)->where('sol_tipo','=','cambio')->orderby('id','ASC')->pluck('id','id');

        return view('admin.cliente.solicitud.create')->with(compact('notaEntrega','solicitudes'));
    }

    /*public function createSolicitud($solicitud_id)
    {
        $solicitud = Solicitud::find($solicitud_id);

        if($solicitud->sol_tipo === "cambio"){

            $notaEntrega = $solicitud->notaEntrega;

            return view('admin.cliente.solicitud.create')->with(compact('notaEntrega','solicitud'));
        }else{

            flash("Disculpe, esta opción solo esta disponible para las solicitudes de cambio de producto.")->error();
            return redirect()->back();
        }
    }*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $solicitud = new Solicitud($request->all());
        $notaEntrega = $solicitud->NotaEntrega;
        

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        /* VERIFICO LA GARANTIA */    
        $fecha = Carbon::parse($fecha);        
        $dias = $fecha->diffInDays(Carbon::parse($notaEntrega->not_fecha));
        $Garantia = false;

        if($dias <= 90){
            $solicitud->save();
        }else{/* FIN   VERIFICO LA GARANTIA */
            flash('No puede crearse una solicitud porque la Nota de entrega no está en garantía. Tiene '.($dias-90). ' dias vencida')->error();
            return redirect()->route('solicitud.index');
        }


        

        //dd($solicitud->NotaEntrega)

        flash("Se ha creado la solicitud #".$solicitud->id." exitosamente.")->success();
        return redirect()->route('solicitud.seleccionarProductos',['id'=>$solicitud->id]);
    }

    public function storeAgregarProductos(Request $request)
    {
        //dd($request->all());
        
        $solicitud = solicitud::find($request->id);

        $solicitud->sol_observaciones = $request->sol_observaciones;
        $solicitud->save(); 

        if ($solicitud->sol_tipo === 'cambio') {

            flash("Se ha agregado los productos a cambiar en la solicitud #".$solicitud->id." exitosamente. Por favor elegir los productos a entregar")->success();
            return redirect()->route('solicitud.elegirProductosACambiar',['id'=>$solicitud->id]);
            //$this->elegirProductosACambiar($solicitud->id);
        } else {
            flash("Se ha agregado los productos a la solicitud #".$solicitud->id." exitosamente.")->success();
            return redirect()->route('solicitud.index');
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
        $solicitud = solicitud::find($id);

        return view('admin.cliente.solicitud.show')->with(compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = solicitud::find($id);

        /*$PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();



        $codigoPCsCambio = CodigoPC::orderby('cod_pc_codigo','ASC')->get();
        $codigoArticulosCambio = CodigoArticulo::orderby('cod_art_codigo','ASC')->get();
            

            foreach ($codigoPCsCambio as $key => $codigoPC) {
               
               if(!$PC->disponibilidadPC($codigoPC)){//verifico si NO esta disponible
                    $codigoPCsCambio->forget($key);//quito los NO disponibles!!!
                }else{
                    foreach ($solicitud->CodigoPCs as $pc) {
                        
                        if($codigoPC->id === $pc->id){
                            $codigoPCsCambio->forget($key);//quito los NO disponibles!!!
                        }
                    }
                }
            } 
            foreach ($codigoArticulosCambio as $key => $codigoArticulo) {
               
               if(!$Articulo->disponibilidadArticulo($codigoArticulo)){//verifico si NO esta disponible
                    $codigoArticulosCambio->forget($key);//quito los NO disponibles!!!
                }else{
                    foreach ($solicitud->CodigoArticulos as $articulo) {
                        
                        if($codigoArticulo->id === $articulo->id){
                            $codigoArticulosCambio->forget($key);//quito los NO disponibles!!!
                        }
                    }
                }
            } 



        $CodigoPCs = collect() ;
        $CodigoArticulos = collect() ;

        foreach ($solicitud->notaEntrega->venta->ventaPCs as $CodigoPC) {
            
            if($PC->disponibilidadPCParaSolicitud($CodigoPC,$solicitud->notaEntrega->venta->ven_fecha_compra)){
                $CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
            }
        }
        foreach ($solicitud->notaEntrega->venta->ventaArticulos as $CodigoArticulo) {
            
            if($Articulo->disponibilidadArticuloParaSolicitud($CodigoArticulo,$solicitud->notaEntrega->venta->ven_fecha_compra)){
                $CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
            }
        }*/

        //dd($CodigoPCs);
        return view('admin.cliente.solicitud.edit')->with(compact('solicitud'));//,'CodigoPCs','CodigoArticulos','codigoArticulosCambio','codigoPCsCambio'));
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
        $solicitud = solicitud::find($id);

        $solicitud->sol_aprobado = $request->sol_aprobado;
        $solicitud->sol_observaciones = $request->sol_observaciones;

        $solicitud->save();
        flash("solicitud#".$id." se modificó exitosamente")->success();
        return redirect()->route('solicitud.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solicitud = Solicitud::find($id);
            $solicitud->CodigoPCs()->detach($solicitud->CodigoPCs);
            $solicitud->CodigoArticulos()->detach($solicitud->CodigoArticulos);

            $solicitud->CodigoPCsEntregado()->detach($solicitud->CodigoPCsEntregado);
            $solicitud->CodigoArticulosEntregado()->detach($solicitud->CodigoArticulosEntregado);
        $solicitud->delete();

        flash("La eliminación de la solicitud #".$solicitud->id." fue exitosa.")->success();
        return redirect()->route('solicitud.index');
    }

    public function seleccionarProductos($id){
        $solicitud =  Solicitud::find($id);
        //dd($id_solicitudElegida);
        $notaEntrega = $solicitud->NotaEntrega;

        $PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();

        $CodigoPCs = collect() ;
        $CodigoArticulos = collect() ;

        $disponibleVentaPC = collect() ;
        $disponibleVentaArticulo = collect() ;

        foreach ($notaEntrega->venta->ventaPCs as $CodigoPC) {
            //dd(!$PC->disponibilidadPC($CodigoPC));
            if(!$PC->disponibilidadPC($CodigoPC) && $PC->disponibilidadPCParaSolicitud($CodigoPC,$notaEntrega->venta->ven_fecha_compra) ){
                $CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
            }
            if ($PC->disponibilidadPC($CodigoPC)) {//verifico si esta disponible para vender
                $disponibleVentaPC->push($CodigoPC);//agrego los disponibles!!!
            }
        }
        foreach ($notaEntrega->venta->ventaArticulos as $CodigoArticulo) {
            //dd($Articulo->disponibilidadArticulo($CodigoArticulo));
            if(!$Articulo->disponibilidadArticulo($CodigoArticulo) && $Articulo->disponibilidadArticuloParaSolicitud($CodigoArticulo,$notaEntrega->venta->ven_fecha_compra)){
                $CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
            }
            if ($Articulo->disponibilidadArticulo($CodigoArticulo)) {//verifico si esta disponible para vender
                $disponibleVentaArticulo->push($CodigoArticulo);//agrego los disponibles!!!
            }
        }

        $PCsentregados = $this->ObtenerPCsEntregadasPorCambio($notaEntrega->id);
        $ArticulosEntregados = $this->ObtenerArticulosEntregadasPorCambio($notaEntrega->id);
        ////////////////////////////////////////////////////////
        //OBTENER PRODUCTOS DE LA SOLICITUD
        /*
        foreach ($this->ObtenerPCsEntregadasPorCambio($notaEntrega->id) as $CodigoPC) {
            //dd(!$PC->disponibilidadPC($CodigoPC));
            if(!$PC->disponibilidadPC($CodigoPC) && $PC->disponibilidadPCParaSolicitud($CodigoPC,$notaEntrega->venta->ven_fecha_compra) ){
                $CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
            }
            if ($PC->disponibilidadPC($CodigoPC)) {//verifico si esta disponible para vender
                $disponibleVentaPC->push($CodigoPC);//agrego los disponibles!!!
            }
        }
        foreach ($this->ObtenerArticulosEntregadasPorCambio($notaEntrega->id) as $CodigoArticulo) {
            //dd($Articulo->disponibilidadArticulo($CodigoArticulo));
            if(!$Articulo->disponibilidadArticulo($CodigoArticulo) && $Articulo->disponibilidadArticuloParaSolicitud($CodigoArticulo,$notaEntrega->venta->ven_fecha_compra)){
                $CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
            }
            if ($Articulo->disponibilidadArticulo($CodigoArticulo)) {//verifico si esta disponible para vender
                $disponibleVentaArticulo->push($CodigoArticulo);//agrego los disponibles!!!
            }
        }*/
        ////////////////////////////////////////////////////////
        
        return view('admin.cliente.solicitud.create-productos')->with(compact('solicitud','notaEntrega','CodigoPCs','CodigoArticulos','disponibleVentaArticulo','disponibleVentaPC','PCsentregados','ArticulosEntregados'));
    }


    public function eliminarProducto($solicitud_id,$producto_id,$tipo_producto,$editar=false){

        $solicitud = solicitud::find($solicitud_id);

        if ($tipo_producto === "pc") {
            $solicitud->CodigoPCs()->detach($producto_id);

            flash("Se ha eliminado exitosamente el producto de la solicitud #".$solicitud->id)->success();
        } else {
            if ($tipo_producto === "articulo") {
                $solicitud->CodigoArticulos()->detach($producto_id);

                flash("Se ha eliminado exitosamente el producto de la solicitud #".$solicitud->id)->success();
            } 
            
        }

        if (!$editar) {
            return redirect()->route('solicitud.seleccionarProductos',['id'=>$solicitud->id]);
        } else {
            return redirect()->route('solicitud.edit',['id'=>$solicitud->id]);
        }
        
        
    }
    public function agregarProducto($solicitud_id,$producto_id,$tipo_producto,$editar=false){

        $solicitud = solicitud::find($solicitud_id);

        if ($tipo_producto === "pc") {
            $solicitud->CodigoPCs()->attach($producto_id);

            flash("Se ha agregado exitosamente el producto a la solicitud #".$solicitud->id)->success();
        } else {
            if ($tipo_producto === "articulo") {
                $solicitud->CodigoArticulos()->attach($producto_id);

                flash("Se ha agregado exitosamente el producto a la solicitud #".$solicitud->id)->success();
            } 
            
        }

        if (!$editar) {
            return redirect()->route('solicitud.seleccionarProductos',['id'=>$solicitud->id]);
        } else {
            return redirect()->route('solicitud.edit',['id'=>$solicitud->id]);
        }
    }

    public function eliminarProductoCambio($solicitud_id,$producto_id,$tipo_producto,$editar=false){

        $solicitud = solicitud::find($solicitud_id);

        if ($tipo_producto === "pc") {
            $solicitud->CodigoPCsEntregado()->detach($producto_id);

            flash("Se ha eliminado exitosamente el producto de la solicitud #".$solicitud->id)->success();
        } else {
            if ($tipo_producto === "articulo") {
                $solicitud->CodigoArticulosEntregado()->detach($producto_id);

                flash("Se ha eliminado exitosamente el producto de la solicitud #".$solicitud->id)->success();
            } 
            
        }


        //return redirect()->action('SolicitudController@storeAgregarProductos');

        if (!$editar) {
            return redirect()->route('solicitud.elegirProductosACambiar',['id'=>$solicitud->id]);
        } else {
            return redirect()->route('solicitud.edit',['id'=>$solicitud->id]);
        }
        
        
    }
    public function agregarProductoCambio($solicitud_id,$producto_id,$tipo_producto,$editar=false){

        $solicitud = solicitud::find($solicitud_id);

        if ($tipo_producto === "pc") {
            $solicitud->CodigoPCsEntregado()->attach($producto_id);

            flash("Se ha agregado exitosamente el producto a la solicitud #".$solicitud->id)->success();
        } else {
            if ($tipo_producto === "articulo") {
                $solicitud->CodigoArticulosEntregado()->attach($producto_id);

                flash("Se ha agregado exitosamente el producto a la solicitud #".$solicitud->id)->success();
            } 
            
        }

        //return redirect()->action('SolicitudController@storeAgregarProductos');
        

        if (!$editar) {
            return redirect()->route('solicitud.elegirProductosACambiar',['id'=>$solicitud->id]);
        } else {
            return redirect()->route('solicitud.edit',['id'=>$solicitud->id]);
        }
        
    }

    public function elegirProductosACambiar($solicitud_id){
            $solicitud = solicitud::find($solicitud_id);

            $codigoPCs = CodigoPC::orderby('cod_pc_codigo','ASC')->get();
            $codigoArticulos = CodigoArticulo::whereNull('cod_art_fk_pc')->orderby('cod_art_codigo','ASC')->get();
            //BUSCAR UNA MANERA DE MOSTRAR LOS PRODUCTOS DISPONIBLES PARA CAMBIO. 
            //EN LA LISTA TENDRE EL BTN PARA AGREGAR LOS PRODUCTOS
            //DEBO VERIFICAR UNA MANERA DE QUE NO INGRESE MAS PRODUCTOS DE LO QUE SON
            //TENGO QUE VER CUANTAS PCs SON Y CUANTOS ARTICULOS SON
            //
            
            $PC = new CodigoPCController();
            $Articulo = new CodigoArticuloController();

            foreach ($codigoPCs as $key => $codigoPC) {
               
               if(!$PC->disponibilidadPC($codigoPC)){//verifico si NO esta disponible
                    $codigoPCs->forget($key);//quito los NO disponibles!!!
                }else{
                    foreach ($solicitud->CodigoPCs as $pc) {
                        
                        if($codigoPC->id === $pc->id){
                            $codigoPCs->forget($key);//quito los NO disponibles!!!
                        }
                    }
                }
            } 
            foreach ($codigoArticulos as $key => $codigoArticulo) {
               
               if(!$PC->disponibilidadPC($codigoArticulo)){//verifico si NO esta disponible
                    $codigoArticulos->forget($key);//quito los NO disponibles!!!
                }else{
                    foreach ($solicitud->CodigoArticulos as $articulo) {
                        
                        if($codigoArticulo->id === $articulo->id){
                            $codigoArticulos->forget($key);//quito los NO disponibles!!!
                        }
                    }
                }
            } 


            //flash("Se ha agregado los productos a cambiar a la solicitud #".$solicitud->id." exitosamente.")->success();
            return view('admin.cliente.solicitud.ProductosACambiar')->with(compact('solicitud','codigoPCs','codigoArticulos'));
    }

    public function cargarArchivo(){
        return view('admin.cliente.solicitud.cargarArchivo');
    }


    public function ImportarExcel(Request $request){


        //dd($request->all());

        $file = $request->file('imagen');        
        $name = 'indatechC.A._' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
        $path = public_path() . '/solicitud/';
        $file->move($path,$name);


        //$path = public_path() . '/registroPago/';
        //$name = "registroPago1.xlsx";
        //dd($columnas);
        \Excel::selectSheets('registro')->load($path.$name, function($archivo){

            //selecciono las columnas que necesito
            $columnas = array('tipo_solicitud','concepto','numero_de_nota_entrega','productos');

            //agarro los resultados..
            $resultados = $archivo->get($columnas);
            //dd($resultados->all());
            $notaEntrega = NotaEntrega::find($resultados[0]->numero_de_nota_entrega);
            if($notaEntrega !== null){  
                $solicitud = new solicitud(); 

                $solicitud->sol_tipo = $resultados[0]->tipo_solicitud;
                $solicitud->sol_concepto = $resultados[0]->concepto;
                $solicitud->sol_fk_notaentrega = $notaEntrega->id;

                $fecha = Carbon::now();
                $fecha = $fecha->format('d-m-Y');

                $solicitud->sol_fecha = $fecha;
                $solicitud->sol_aprobado = 'N';

                /* VERIFICO LA GARANTIA */    
                $fecha = Carbon::parse($fecha);        
                $dias = $fecha->diffInDays(Carbon::parse($notaEntrega->not_fecha));
                $Garantia = false;

                if($dias <= 90){
                    $Garantia = true;
                    $solicitud->sol_observaciones = "Si tiene garantía.";
                }else{/* FIN   VERIFICO LA GARANTIA */
                    $solicitud->sol_observaciones = "No es aprobada la solicitud porque no está en garantia";
                    flash("No está en garantía esta nota de entrega. Supera los 90 días")->error();
                    //return  back();
                }

                $solicitud->save();
            
            

            //agregarProducto($solicitud_id,$producto_id,$tipo_producto,$editar=false)
                //if($Garantia){
                $CodVal = "";
                $CodNoVal = "";
                    foreach ($resultados as $resultado) {
                        //AQUI VOY VALIDANDO E INGRESANDO LOS PRODUCTOS DE LA NOTA ENTREGA.
                        if($this->validarCodigoProductoArchivo($notaEntrega,strtoupper($resultado->productos),$solicitud->id)){
                            $CodVal = $resultado->productos."-".$CodVal ;
                        }else{
                            $CodNoVal = $resultado->productos  ."-".$CodNoVal;
                        }
                        //flash($resultado->productos)->warning();
                        //break;//ejecuto este codigo una sola vez y lo rompo
                    }
                    flash("Códigos válidos: ".$CodVal)->success();
                    flash("Códigos NO válidos: ".$CodNoVal)->error();
                    flash('Se ha cargado la solicitud con exito desde el archivo.')->success();

                //}
            }else{
                //dd($archivo);
                
                flash("No existe la nota de entrega#".$resultados[0]->numero_de_nota_entrega)->error();
                if(file_exists($archivo->file)){//elimino el archivo xls creado en el servidor
                    unlink($archivo->file);
                }
                //return back();
            }
        })->get();

        return redirect()->route('solicitud.index');
        //return redirect()->route('venta.index');    
    }



    public function validarCodigoProductoArchivo(NotaEntrega $notaEntrega,$codigo,$solicitud_id){
        $PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();

        $ObjetoPC = codigoPC::wherecod_pc_codigo($codigo)->get();
        $ObjetoArticulo = codigoArticulo::wherecod_art_codigo($codigo)->get();

        $valido = false;
        //dd($ObjetoPC[0]);
       //dd($ObjetoArticulo[0]);
        if(count($ObjetoPC) > 0 ){
            foreach ($notaEntrega->venta->ventaPCs as $pc) {
                if($ObjetoPC[0]->id === $pc->id){
                    if(!$PC->disponibilidadPC($pc) && $PC->disponibilidadPCParaSolicitud($pc,$notaEntrega->venta->ven_fecha_compra)){
                        //$CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
                        $this->agregarProducto($solicitud_id,$pc->id,"pc");
                        $valido = true;
                        break;
                    }
                    /*$valido = true;
                    break;*/
                    //flash("Producto con código '' ".$codigo." '' válido")->success();
                }
            }
            //flash("Producto con código '' ".$codigo." '' válido")->success();
        }

        if(count($ObjetoArticulo) > 0){
            foreach ($notaEntrega->venta->ventaArticulos as $art) {
                if($ObjetoArticulo[0]->id === $art->id){
                    if(!$Articulo->disponibilidadArticulo($art)  && $Articulo->disponibilidadArticuloParaSolicitud($art,$notaEntrega->venta->ven_fecha_compra)){
                        //$CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
                        $valido = true;
                            $this->agregarProducto($solicitud_id,$art->id,"articulo");
                        break;
                    }
                    /*$valido = true;
                    break;*/
                    //flash("Producto con código '' ".$codigo." '' válido")->warning();
                    //flash("Producto con código '' ".$codigo." '' válido")->success();
                }
            }
        }
        if (!count($ObjetoArticulo) > 0 && !count($ObjetoPC) > 0) {
            flash("WARNING: código '' ".$codigo." '' no existe!!!")->warning();
            //return -1;
        }
        

        if(count($ObjetoPC) > 0 ){
            foreach ($notaEntrega->solicitudes as $solicitud) {
                foreach ($solicitud->CodigoPCsEntregado as $PCentregado) {
                    if($ObjetoPC[0]->id === $PCentregado->id){
                        if($PC->disponibilidadPCParaSolicitud($PCentregado,$solicitud->sol_fecha)){
                            //$CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
                            $valido = true;
                            $this->agregarProducto($solicitud_id,$PCentregado->id,"pc");

                            break;
                        }
                        /*$valido = true;
                        break;*/
                        //flash("Producto con código '' ".$codigo." '' válido")->success();
                    }
                }
                
            }
            //flash("Producto con código '' ".$codigo." '' válido")->success();
        }

        if(count($ObjetoArticulo) > 0){
            foreach ($notaEntrega->solicitudes as $solicitud) {
                foreach ($solicitud->CodigoArticulosEntregado as $Articuloentregado) {
                    if($ObjetoArticulo[0]->id === $Articuloentregado->id){
                        if($Articulo->disponibilidadArticuloParaSolicitud($Articuloentregado,$notaEntrega->venta->ven_fecha_compra)){
                            //$CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
                            $valido = true;
                            $this->agregarProducto($solicitud_id,$Articuloentregado->id,"articulo");
                            break;
                        }
                        /*$valido = true;
                        break;*/
                        //flash("Producto con código '' ".$codigo." '' válido")->warning();
                        //flash("Producto con código '' ".$codigo." '' válido")->success();
                    }
                }
                
            }
        }




        return $valido;
    }



    public function ObtenerPCsEntregadasPorCambio($notaEntrega_id){

        //BUSCO NOTA DE ENTREGA  DE LA CUAL BUSCARE TODAS LA SOLICITUDES
        $notaEntrega = NotaEntrega::find($notaEntrega_id);

        //CREO UNA COLLECTION PARA GUARDAR LOS PRODUCTOS
        $productos = collect() ;

        //BUSCO TODAS LAS SOLICITUDES DE UNA NOTA DE ENTREGA
        foreach ($notaEntrega->solicitudes  as $solicitud) {
            //VERIFICO LA SOLICITUD ESTE APROBADA Y QUE SEA DE TIPO CAMBIO
            //PORQUE SOLO NECESITO CONSEGUIR LOS PRODUCTOS QUE SE ENTREGARON A CAMBIO DE OTROS
            if ($solicitud->sol_aprobado === 'S' and $solicitud->sol_tipo === 'cambio') {
                //SI LA SOLICITUD ESTA APROBADA Y ES TIPO CAMBIO
                //BUSCO TODAS LAS PCS QUE SE HAN ENTREGADO A CAMBIO

                foreach ($solicitud->CodigoPCsEntregado as $PCentregado) {
                    $productos->push($PCentregado);
                }
            }
        }
        //dd($productos);
        return $productos;
    }
    public function ObtenerArticulosEntregadasPorCambio($notaEntrega_id){

        //BUSCO NOTA DE ENTREGA  DE LA CUAL BUSCARE TODAS LA SOLICITUDES
        $notaEntrega = NotaEntrega::find($notaEntrega_id);

        //CREO UNA COLLECTION PARA GUARDAR LOS PRODUCTOS
        $productos = collect() ;

        //BUSCO TODAS LAS SOLICITUDES DE UNA NOTA DE ENTREGA
        foreach ($notaEntrega->solicitudes  as $solicitud) {
            //VERIFICO LA SOLICITUD ESTE APROBADA Y QUE SEA DE TIPO CAMBIO
            //PORQUE SOLO NECESITO CONSEGUIR LOS PRODUCTOS QUE SE ENTREGARON A CAMBIO DE OTROS
            if ($solicitud->sol_aprobado === 'S' and $solicitud->sol_tipo === 'cambio') {
                //SI LA SOLICITUD ESTA APROBADA Y ES TIPO CAMBIO
                //BUSCO TODAS LAS PCS QUE SE HAN ENTREGADO A CAMBIO

                foreach ($solicitud->CodigoArticulosEntregado as $ArticuloEntregado) {
                    $productos->push($ArticuloEntregado);
                }
            }
        }
        //dd($productos);
        return $productos;
    }

}
