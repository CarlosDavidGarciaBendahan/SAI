<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CodigoPc;
use App\CodigoArticulo;
use App\Producto_Computador;
use App\Producto_Articulo;

class ReporteProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PCs = codigoPC::orderby('cod_pc_codigo','ASC')->paginate(5);
        $Articulos = codigoArticulo::orderby('cod_art_codigo','ASC')->paginate(5);


        $pcs = Producto_Computador::orderby('pro_com_codigo','ASC')->get();//->paginate(15);
        $arts = Producto_Articulo::orderby('pro_art_codigo','ASC')->get();//->paginate(15);


        return view('admin.reportes.productos.index')->with(compact('PCs','Articulos','pcs','arts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
