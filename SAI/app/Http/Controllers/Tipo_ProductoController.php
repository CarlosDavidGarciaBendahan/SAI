<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_Producto;
use Laracast\Flash\Flash;

class Tipo_ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_productos = Tipo_Producto::orderby('tip_tipo')->paginate(5);

        //dd($tipo_productos);
        return view('admin.producto.tipo_producto.index')->with(compact('tipo_productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.producto.tipo_producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_producto = new Tipo_Producto($request->all());
        $tipo_producto->save();

        flash("Registro del tipo producto '' " .$request->tip_tipo . " '' exitosamente.")->success();
        return redirect()->route('tipo_producto.index');
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
        $tipo_producto = Tipo_Producto::find($id);

        return view('admin.producto.tipo_producto.edit')->with(compact('tipo_producto'));
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
        $tipo_producto = Tipo_Producto::find($id);

        $tipo_producto->tip_tipo = $request->tip_tipo;
        $tipo_producto->save();

        flash("Edición del tipo de producto '' " .$tipo_producto->tip_tipo . " '' exitosamente.")->success();
        return redirect()->route('tipo_producto.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_producto = Tipo_Producto::find($id);
        $tipo_producto->delete();

        flash("Eliminación del tipo de producto '' " .$tipo_producto->tip_tipo . " '' exitosamente.")->success();
        return redirect()->route('tipo_producto.index');
    }
}
