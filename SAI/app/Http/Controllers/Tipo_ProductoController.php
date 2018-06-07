<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_Producto;
use Laracast\Flash\Flash;
use App\Http\Requests\TipoProductoRequest;
use Auth;


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
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            return view ('admin.producto.tipo_producto.create');
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoProductoRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $tipo_producto = new Tipo_Producto($request->all());
            $tipo_producto->save();

            flash("Registro del tipo producto '' " .$request->tip_tipo . " '' exitosamente.")->success();
            return redirect()->route('tipo_producto.index');


        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

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
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $tipo_producto = Tipo_Producto::find($id);
            if ($tipo_producto !== null) {
                return view('admin.producto.tipo_producto.edit')->with(compact('tipo_producto'));



            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoProductoRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $tipo_producto = Tipo_Producto::find($id);
            if ($tipo_producto !== null) {
                $tipo_producto->tip_tipo = $request->tip_tipo;
                $tipo_producto->save();

                flash("Edición del tipo de producto '' " .$tipo_producto->tip_tipo . " '' exitosamente.")->success();
                return redirect()->route('tipo_producto.index');


            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador'){
            $tipo_producto = Tipo_Producto::find($id);
            if ($tipo_producto !== null) {
                $tipo_producto->delete();

                flash("Eliminación del tipo de producto '' " .$tipo_producto->tip_tipo . " '' exitosamente.")->success();
                return redirect()->route('tipo_producto.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }
        
        
    }
}
