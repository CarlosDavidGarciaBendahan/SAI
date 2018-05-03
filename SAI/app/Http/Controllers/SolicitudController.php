<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\NotaEntrega;
use App\Solicitud;
use App\http\Controllers\CodigoPCController;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $solicitudes = Solicitud::orderBy('id','ASC')->paginate(10);

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

        return view('admin.cliente.solicitud.create')->with(compact('notaEntrega'));
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


        flash("Se ha agregado los productos a la solicitud #".$solicitud->id." exitosamente.")->success();
        return redirect()->route('solicitud.index');

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
        $solicitud = Solicitud::find($id);
            $solicitud->CodigoPCs()->detach($solicitud->CodigoPCs);
                $solicitud->CodigoArticulos()->detach($solicitud->CodigoArticulos);
        $solicitud->delete();

        flash("La eliminación de la solicitud #".$solicitud->id." fue exitosa.")->success();
        return redirect()->route('solicitud.index');
    }

    public function seleccionarProductos($id){
        $solicitud =  Solicitud::find($id);
        //dd($solicitud);
        $notaEntrega = $solicitud->NotaEntrega;

        $PC = new CodigoPCController();
        $CodigoPCs = collect() ;
        $CodigoArticulos = collect() ;

        foreach ($notaEntrega->venta->ventaPCs as $key => $CodigoPC) {
            
            if ($PC->disponibilidadPC($CodigoPC)) {//solo voy a guardar las PCs que NO puedo elegir
                //es decir, PC que está disponible, significa que está en inventario.
                $CodigoPCs->push($CodigoPC);
                /*if ($notaEntrega->venta->ventaPCs->offsetExists($key)) {
                    dd("se");
                }*/

            } 
                //$CodigoPCs->forget($key);
        }
        foreach ($notaEntrega->venta->VentaArticulos as $key => $CodigoArticulo) {
            
            if ($PC->disponibilidadPC($CodigoArticulo)) {
                $CodigoArticulos->push($CodigoArticulo);
            } 
        }

        return view('admin.cliente.solicitud.create-productos')->with(compact('solicitud','notaEntrega','CodigoPCs','CodigoArticulos'));
    }


    public function eliminarProducto($solicitud_id,$producto_id,$tipo_producto){

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


        return redirect()->route('solicitud.seleccionarProductos',['id'=>$solicitud->id]);
        
    }
    public function agregarProducto($solicitud_id,$producto_id,$tipo_producto){

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
        return redirect()->route('solicitud.seleccionarProductos',['id'=>$solicitud->id]);

        
    }



}
