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

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ventas = Venta::where('ven_eliminada','=',0)->orderby('id','ASC')->paginate(10);

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
        $clientes_naturales = Cliente_Natural::orderby('cli_nat_apellido','cli_nat_nombre','ASC')->get();
        $clientes_juridicos= Cliente_Juridico::orderby('cli_jur_nombre','ASC')->get();
        //$productos_computadores = Producto_Computador::orderby('pro_com_codigo','ASC')->pluck('pro_com_codigo','id');
        //$productos_articulos = Producto_Articulo::orderby('pro_art_codigo','ASC')->pluck('pro_art_codigo','id');
        $codigosPC = DB::select('
                                select pc.id, pc.cod_pc_codigo
                                from codigoPC as pc  
                                ');
        $codigosPC = collect($codigosPC)->pluck('cod_pc_codigo','id');

        $codigosArticulo = DB::select('
                                select art.id, art.cod_art_codigo
                                from codigoArticulo as art  
                                ');
        $codigosArticulo = collect($codigosArticulo)->pluck('cod_art_codigo','id');

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');

        //dd($codigosPC);
        //dd($clientes_naturales);
        //dd($clientes_juridicos);

        return view('admin.cliente.venta.create')->with(compact('clientes_naturales','clientes_juridicos','fecha','codigosPC','codigosArticulo'));;
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
        $venta->ven_monto_total = 0;
        if ($request->tipo_cliente !== null) {
            $venta->ven_fk_cliente_juridico = null;
        } else {
            $venta->ven_fk_cliente_natural = null;
        }

        foreach ($request->codigoPC as $id ) {
            $codigoPC = CodigoPC::find($id);

            $venta->ven_monto_total = $venta->ven_monto_total + $codigoPC->Producto_Computador->pro_com_precio;
        }
        foreach ($request->codigoArticulo as $id ) {
            $codigoArticulo = codigoArticulo::find($id);

            $venta->ven_monto_total = $venta->ven_monto_total + $codigoArticulo->Producto_Articulo->pro_art_precio;
        }

        $venta->ven_moneda = "Bs";

        $venta->save();


        $venta->VentaPCs()->sync($request->codigoPC);
        $venta->VentaArticulos()->sync($request->codigoArticulo);

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
        $venta = Venta::find($id);

        $venta->ven_eliminada = -1;
        $venta->save();

        flash("Se ha eliminado exitosamente la venta #".$venta->id)->success();
        return redirect()->route('venta.index');
    }
}
