<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Marca;
use App\Modelo;
use App\Http\Requests\ModeloRequest;
use Auth;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::orderby('mod_modelo')->paginate(5);

        return view('admin.producto.modelo.index')->with(compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $marcas = Marca::orderby('mar_marca')->pluck('mar_marca','id');
            return view('admin.producto.modelo.create')->with(compact('marcas'));


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
    public function store(ModeloRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $modelo = new Modelo($request->all());
            $modelo->save();

            flash("Registro del modelo '' ". $request->mod_modelo." '' exitoso.")->success();
            return redirect()->route('modelo.index');


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

            $modelo = Modelo::find($id);
            if ($modelo !== null) {
                $marcas = Marca::orderby('mar_marca')->pluck('mar_marca','id');
                return view('admin.producto.modelo.edit')->with(compact(['modelo','marcas']));

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
    public function update(ModeloRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $modelo = Modelo::find($id);
            if ($modelo !== null) {

                $modelo->mod_modelo = $request->mod_modelo;
                $modelo->mod_fk_marca = $request->mod_fk_marca;
                $modelo->save();

                flash("Modificación del modelo '' ". $request->mod_modelo." '' exitoso.")->success();
                return redirect()->route('modelo.index');


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

            $modelo = Modelo::find($id);
            if ($modelo !== null) {

                $modelo->delete();

                flash("Eliminación del modelo '' ". $modelo->mod_modelo." '' exitoso.")->success();
                return redirect()->route('modelo.index');
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
