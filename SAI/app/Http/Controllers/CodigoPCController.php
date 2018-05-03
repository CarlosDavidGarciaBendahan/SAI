<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Producto_Computador;
use App\Lote;
use App\CodigoPC;
use App\CodigoArticulo;

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
    public function store(Request $request)
    {
        //dd($request->all());

        $cantidad = sizeof($request->codigosPC);

        for ($i=0; $i < $cantidad; $i++) { 

            $codigoPC = new codigoPC($request->all());

            $codigoPC->cod_pc_codigo = $request->codigosPC[$i];
            $codigoPC->cod_pc_estado = $request->estado[$i];
            //$codigoPC->cod_pc_fk_producto_computador = $request->cod_pc_fk_producto_computador;

            $codigoPC->save();
        }

        flash("Registro de las computadoras exitosamente")->success();
        //return redirect()->route('producto_computador.show')->with(['id' => $request->cod_pc_fk_producto_computador]);
        return redirect()->route('producto_computador.show',['id' => $request->cod_pc_fk_producto_computador]);

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
        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        $codigosArticulo = CodigoArticulo::where('cod_art_fk_pc','=',$id)->orderBy('cod_art_codigo','ASC')->paginate(5);


        return view("admin.producto.codigoPC.show")->with(compact('codigoPC','lote','codigosArticulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $codigoPC = CodigoPC::find($id);
        $lote = Lote::orderBy('id','ASC')->pluck('lot_nombre','id');

        $codigosArticulo = CodigoArticulo::orderBy('cod_art_codigo','ASC')->paginate(5);


        return view("admin.producto.codigoPC.edit")->with(compact('codigoPC','lote','codigosArticulo'));
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
        $codigoPC = CodigoPC::find($id);

        $codigoPC->cod_pc_fk_lote = $request->cod_pc_fk_lote;
        $codigoPC->cod_pc_estado = $request->cod_pc_estado;

        $codigoPC->save();

        //dd($request->all());

        flash("Modificación de la PC '' ".$codigoPC->cod_pc_codigo." '' exitosa")->success();
        return redirect()->route('codigoPC.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $codigoPC = CodigoPC::find($id);

        
        $codigoPC->delete();

        //dd($request->all());

        flash("Eliminación de la PC '' ".$codigoPC->cod_pc_codigo." '' exitosa")->success();
        return redirect()->route('codigoPC.index');
    }

    public function disponibilidadPC($codigoPC){
        $disponible = true; //supongo que  está disponible el producto. 

        $ultimaVenta = null;
        $ultimaSolicitudAprobada = null;

        foreach ($codigoPC->ventas as  $venta) {
            if ($venta->ven_eliminada === 0) {//Verifico que la venta NO ha sido eliminada.
                if($ultimaVenta === null){//Guardo la primera venta no eliminada que consiga.
                    $ultimaVenta = $venta;
                }else{//en caso de haber conseguido más de una venta NO eliminada 
                //verifico cual es la más reciente entre las dos
                    
                    if ($venta->ven_fecha_compra >= $ultimaVenta->ven_fecha_compra ) {
                        $ultimaVenta = $venta;
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
                    $ultimaSolicitudAprobada = $solicitud;
                } else {
                    if ($solicitud->sol_fecha >= $ultimaSolicitudAprobada) {
                        $ultimaSolicitudAprobada = $solicitud;
                    } 
                    
                }
            }
        }

        if ($ultimaVenta !== null && $ultimaSolicitudAprobada !== null) {//Se verifica si existe alguna venta y solicitud para esa PC
            //Verifico que la ultima venta realizada y no eliminada, sea más reciente que la ultima solicitud aprobada.
            if ($ultimaVenta->ven_fecha_compra > $ultimaSolicitudAprobada->sol_fecha) {
                $disponible = false;
            }
        } else {//en caso de no existir solicitud, se verifica que exista la venta. 
            if ($ultimaVenta !== null && $ultimaSolicitudAprobada === null) {//si existe la venta, la PC no esta disponible
                $disponible = false;
            } else {
                # code...
            }
            
        }
        
        
        
        //dd($disponible);
        
        return $disponible;
    }
}
