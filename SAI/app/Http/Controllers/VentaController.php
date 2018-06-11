<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Producto_Computador;
use App\Producto_Articulo;
use Carbon\Carbon;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use App\Venta;
use App\CodigoPC;
use App\CodigoArticulo;
use Illuminate\Support\Facades\DB;
use App\http\Controllers\CodigoPCController;
use App\http\Controllers\CodigoArticuloController;
use App\FuenteVenta;
use App\PC_Venta;
use App\Articulo_Venta;
use App\Presupuesto;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $ventas = Venta::where('ven_eliminada','=',0)->orderby('id','DESC')->paginate(10);

        /*foreach ($ventas as $venta) {
            dd($venta->notaentrega);
        }*/
        return view('admin.cliente.venta.index')->with(compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd("crear venta");

        //para poder utilizar los metodos de validacion de disponibilidad
        $PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();


        $clientes_naturales = Cliente_Natural::orderby('cli_nat_apellido','cli_nat_nombre','ASC')->get();
        $clientes_juridicos= Cliente_Juridico::orderby('cli_jur_nombre','ASC')->get();
        $fuenteventas = fuenteventa::orderby('nombre','ASC')->pluck('nombre','id');

        //BUSCO TODOS LOS ARTICULOS Y TODAS LAS PCS
        $codigosPC = CodigoPC::orderby('cod_pc_codigo','ASC')->get();
        //busco todos los articulos que no esten asignados a una PC
        $codigosArticulo = CodigoArticulo::whereNull('cod_art_fk_pc')->orderby('cod_art_codigo','ASC')->get();


        foreach ($codigosPC as $key => $computador) {
            
            //verifico si el computador NO esta disponible
            //si NO esta disponible lo quito de la lista que se va a mostrar en la venta
            if(!$PC->disponibilidadPC($computador)){
               $codigosPC->forget($key);//quito los NO disponibles!!!  porque NO pueden ser elegidos...
            }  
        } 
        foreach ($codigosArticulo as $key => $componente) {
               
               if(!$Articulo->disponibilidadArticulo($componente)){//verifico si NO esta disponible
                    $codigosArticulo->forget($key);//quito los NO disponibles!!!
                }
            } 

        $codigosPC = collect($codigosPC)->pluck('cod_pc_codigo','id');
        $codigosArticulo = collect($codigosArticulo)->pluck('cod_art_codigo','id');

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');

        //dd($codigosPC);
        //dd($clientes_naturales);
        //dd($clientes_juridicos);
        $presupuestos = presupuesto::where('pre_eliminado','=','0')->orderby('pre_fecha_solicitud','DESC')->get();
        return view('admin.cliente.venta.create')->with(compact('clientes_naturales','clientes_juridicos','fecha','codigosPC','codigosArticulo','fuenteventas','presupuestos'));;
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

        $venta = new Venta($request->all());
        //dd($venta);



        $venta->ven_monto_total = 0;
        if ($request->tipo_cliente !== null) {
            $venta->ven_fk_cliente_juridico = null;
        } else {
            $venta->ven_fk_cliente_natural = null;
        }

        if ($request->codigoPC !== null) {
            foreach ($request->codigoPC as $id ) {
                $codigoPC = CodigoPC::find($id);

                $venta->ven_monto_total = $venta->ven_monto_total + $codigoPC->Producto_Computador->pro_com_precio;


            }
        }
        if ($request->codigoArticulo !== null) {
            
            foreach ($request->codigoArticulo as $id ) {
                $codigoArticulo = codigoArticulo::find($id);

                $venta->ven_monto_total = $venta->ven_monto_total + $codigoArticulo->Producto_Articulo->pro_art_precio;
            }
        }


        //SI EXISTE DESCUENTO
        if ($request->ven_porcentaje_descuento !== null && $request->ven_porcentaje_descuento !== 0) {
            $total_descuento =  $venta->ven_monto_total * ($request->ven_porcentaje_descuento / 100) ;
            $venta->ven_monto_total = $venta->ven_monto_total - $total_descuento;
        }
        

        $venta->ven_moneda = "$";

        $venta->save();

        //ANTES SIN PRECIO UNITARIO GUARDADO

        //$venta->VentaPCs()->sync($request->codigoPC);
        //$venta->VentaArticulos()->sync($request->codigoArticulo);

        //PARA REGISTRAR PRECIO UNITARIO
        if ($request->codigoPC !== null) {
            foreach ($request->codigoPC as $id ) {
                $codigoPC = CodigoPC::find($id);

                $pc_venta = new pc_venta();
                $pc_venta->pc_ven_fk_venta = $venta->id;
                $pc_venta->pc_ven_fk_codigopc = $codigoPC->id;
                $pc_venta->precio_unitario = $codigoPC->Producto_Computador->pro_com_precio;
                DB::table('pc_venta')->insert([
                    'pc_ven_fk_venta'   =>$venta->id,
                    'pc_ven_fk_codigopc'=>$codigoPC->id,
                    'precio_unitario'   =>$codigoPC->Producto_Computador->pro_com_precio
                ]);
                //$pc_venta->save();

            }
        }
        if ($request->codigoArticulo !== null) {
            
            foreach ($request->codigoArticulo as $id ) {
                $codigoArticulo = codigoArticulo::find($id);

                $articulo_venta = new articulo_venta();
                $articulo_venta->art_ven_fk_venta = $venta->id;
                $articulo_venta->art_ven_fk_codigoarticulo = $codigoArticulo->id;
                $articulo_venta->precio_unitario = $codigoArticulo->Producto_Articulo->pro_art_precio;
                DB::table('articulo_venta')->insert([
                    'art_ven_fk_venta'          =>$venta->id,
                    'art_ven_fk_codigoarticulo' =>$codigoArticulo->id,
                    'precio_unitario'           =>$codigoArticulo->Producto_Articulo->pro_art_precio
                ]);
                //$articulo_venta->save();
            }
        }
        

        flash("Se ha creado exitosamente la venta #".$venta->id)->success();
        return redirect()->route('venta.index');
    
        //dd($venta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Venta::find($id);


        
       return view('admin.cliente.venta.show')->with(compact('venta'));

        //dd($venta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = Venta::find($id);

        //para poder utilizar los metodos de validacion de disponibilidad
        $PC = new CodigoPCController();
        $Articulo = new CodigoArticuloController();


        $clientes_naturales = Cliente_Natural::orderby('cli_nat_apellido','cli_nat_nombre','ASC')->get();
        $clientes_juridicos= Cliente_Juridico::orderby('cli_jur_nombre','ASC')->get();


        //BUSCO TODOS LOS ARTICULOS Y TODAS LAS PCS
        $codigosPC = CodigoPC::orderby('cod_pc_codigo','ASC')->get();
        //busco todos los articulos que no esten asignados a una PC
        $codigosArticulo = CodigoArticulo::whereNull('cod_art_fk_pc')->orderby('cod_art_codigo','ASC')->get();


        foreach ($codigosPC as $key => $computador) {
            
            //verifico si el computador NO esta disponible
            //si NO esta disponible lo quito de la lista que se va a mostrar en la venta
            if(!$PC->disponibilidadPC($computador)){
               $codigosPC->forget($key);//quito los NO disponibles!!!  porque NO pueden ser elegidos...
            }  
        } 
        foreach ($codigosArticulo as $key => $componente) {
               
               if(!$Articulo->disponibilidadArticulo($componente)){//verifico si NO esta disponible
                    $codigosArticulo->forget($key);//quito los NO disponibles!!!
                }
            } 

        $codigosPC = collect($codigosPC)->pluck('cod_pc_codigo','id');
        $codigosArticulo = collect($codigosArticulo)->pluck('cod_art_codigo','id');
        
        return view('admin.cliente.venta.edit')->with(compact('venta','codigosPC','codigosArticulo'));
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
        $venta = Venta::find($id);

        //dd($venta->VentaPCs);

        $venta->VentaPCs()->attach($request->codigoPC);
        $venta->VentaArticulos()->attach($request->codigoArticulo);
        if ($request->ven_porcentaje_descuento !== null && $request->ven_porcentaje_descuento !== 0) {
            $venta->ven_porcentaje_descuento = $request->ven_porcentaje_descuento;
        }

        $venta->ven_monto_total = 0;

        foreach ($venta->VentaPCs as $codigoPC ) {
            //$codigoPC = CodigoPC::find($id);

            $venta->ven_monto_total = $venta->ven_monto_total + $codigoPC->Producto_Computador->pro_com_precio;
        }
        foreach ($venta->VentaArticulos as $codigoArticulo ) {
            //$codigoArticulo = codigoArticulo::find($id);

            $venta->ven_monto_total = $venta->ven_monto_total + $codigoArticulo->Producto_Articulo->pro_art_precio;
        }


        if ($venta->ven_porcentaje_descuento !== null && $venta->ven_porcentaje_descuento !== 0) {
            $total_descuento =  $venta->ven_monto_total * ($venta->ven_porcentaje_descuento / 100) ;
            $venta->ven_monto_total = $venta->ven_monto_total - $total_descuento;
        }

        $venta->save();

        flash("Se ha modificado exitosamente la venta #".$venta->id)->success();
        //return redirect()->route('venta.show',['id'=>$venta->id]);

        return redirect()->route('venta.edit',['id'=>$venta->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        $venta->ven_eliminada = -1;
        $venta->save();

        flash("Se ha eliminado exitosamente la venta #".$venta->id)->success();
        return redirect()->route('venta.index');
    }

    public function eliminarProducto($venta_id,$producto_id,$tipo_producto){

        $venta = Venta::find($venta_id);

        if ($tipo_producto === "pc") {
            $venta->VentaPCs()->detach($producto_id);
            $producto = codigoPC::find($producto_id);

            $venta->ven_monto_total = $venta->ven_monto_total - $producto->producto_computador->pro_com_precio;
            if ($venta->ven_monto_total <= 0) {
                $venta->ven_monto_total = 0;
            }
            
            $venta->save(); 

            flash("Se ha eliminado exitosamente el producto ''".$producto->cod_pc_codigo."'' de la venta #".$venta->id)->success();
            return redirect()->route('venta.edit',['id'=>$venta->id]);
        } else {
            if ($tipo_producto === "articulo") {
                
                $venta->VentaArticulos()->detach($producto_id);
                $producto = codigoArticulo::find($producto_id);

                $venta->ven_monto_total = $venta->ven_monto_total - $producto->producto_articulo->pro_art_precio;
                if ($venta->ven_monto_total <= 0) {
                $venta->ven_monto_total = 0;
                }
                $venta->save(); 

                flash("Se ha eliminado exitosamente el producto ''".$producto->cod_art_codigo."'' de la venta #".$venta->id)->success();
                return redirect()->route('venta.edit',['id'=>$venta->id]);
            } 
            
        }
        
    }
}
