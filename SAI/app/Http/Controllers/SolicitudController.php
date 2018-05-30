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
        $solicitud->save();

        $notaEntrega = $solicitud->NotaEntrega;

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

        $PC = new CodigoPCController();
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
        }

        //dd($CodigoPCs);
        return view('admin.cliente.solicitud.edit')->with(compact('solicitud','CodigoPCs','CodigoArticulos','codigoArticulosCambio','codigoPCsCambio'));
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
        dd($request->all());
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

        foreach ($notaEntrega->venta->ventaPCs as $CodigoPC) {
            
            if($PC->disponibilidadPCParaSolicitud($CodigoPC,$notaEntrega->venta->ven_fecha_compra)){
                $CodigoPCs->push($CodigoPC);//agrego los disponibles!!!
            }
        }
        foreach ($notaEntrega->venta->ventaArticulos as $CodigoArticulo) {
            
            if($Articulo->disponibilidadArticuloParaSolicitud($CodigoArticulo,$notaEntrega->venta->ven_fecha_compra)){
                $CodigoArticulos->push($CodigoArticulo);//agrego los disponibles!!!
            }
        }
        
        return view('admin.cliente.solicitud.create-productos')->with(compact('solicitud','notaEntrega','CodigoPCs','CodigoArticulos'));
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




}
