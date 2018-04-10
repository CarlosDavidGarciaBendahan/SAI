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
use App\Codigo_PC;
use App\Codigo_Articulo;

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
                                where   
                                ');
        $codigosArticulo = 

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        return view('admin.cliente.venta.create')->with(compact('clientes_naturales','clientes_juridicos','fecha'));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
