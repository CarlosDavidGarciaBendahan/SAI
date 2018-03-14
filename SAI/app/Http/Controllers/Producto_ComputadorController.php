<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Producto_Computador;
use App\Producto_Articulo;
use App\Tipo_Producto;
use App\Oficina;
use App\Sector;
use App\Marca;
use App\Modelo;
use App\Imagen;


class Producto_ComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto_computadoras = Producto_Computador::orderby('pro_com_codigo')->paginate(5);

        return view('admin.producto.producto_computador.index')->with(compact('producto_computadoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oficinas = Oficina::orderby('ofi_direccion')->get();
        $marcas = Marca::orderby('mar_marca')->get();
        $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();

        return view('admin.producto.producto_computador.create')->with(compact('oficinas','marcas','tipo_productos'));
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

        $producto_computador = new Producto_Computador($request->all());
        $producto_computador->save();

        flash("Registro del computador '' ".$request->pro_com_codigo." '' exitoso")->success();
        return redirect()->route('producto_computador.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $oficinas = Oficina::orderby('ofi_direccion')->get();
        $sectores = Sector::orderby('sec_sector')->get();
        $marcas = Marca::orderby('mar_marca')->get();
        $modelos = Modelo::orderby('mod_modelo')->get();
        $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
        $producto_computador = Producto_Computador::find($id);

        return view('admin.producto.producto_computador.show')->with(compact('oficinas','marcas','tipo_productos','producto_computador','sectores','modelos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oficinas = Oficina::orderby('ofi_direccion')->get();
        $sectores = Sector::orderby('sec_sector')->get();
        $marcas = Marca::orderby('mar_marca')->get();
        $modelos = Modelo::orderby('mod_modelo')->get();
        $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
        $producto_computador = Producto_Computador::find($id);

        return view('admin.producto.producto_computador.edit')->with(compact('oficinas','marcas','tipo_productos','producto_computador','sectores','modelos'));
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
        $producto_computador = Producto_Computador::find($id);

        $producto_computador->pro_com_descripcion = $request->pro_com_descripcion;
        $producto_computador->pro_com_cantidad = $request->pro_com_cantidad;
        $producto_computador->pro_com_precio = $request->pro_com_precio;
        $producto_computador->pro_com_moneda = $request->pro_com_moneda;
        $producto_computador->pro_com_catalogo = $request->pro_com_catalogo;
        $producto_computador->pro_com_fk_sector = $request->pro_com_fk_sector;
        $producto_computador->pro_com_fk_modelo = $request->pro_com_fk_modelo;
        $producto_computador->pro_com_fk_tipo_producto = $request->pro_com_fk_tipo_producto;

        $producto_computador->save();

        flash("Modificación del computador '' ".$producto_computador->pro_com_codigo." '' exitoso")->success();
        return redirect()->route('producto_computador.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $producto_computador = Producto_Computador::find($id);
        $producto_computador->delete();
        flash("Eliminación del computador '' ".$producto_computador->pro_com_codigo." '' exitoso")->success();
        return redirect()->route('producto_computador.index');
    }
}
