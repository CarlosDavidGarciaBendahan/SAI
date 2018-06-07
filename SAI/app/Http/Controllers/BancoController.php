<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Banco;
use App\Http\Requests\BancoRequest;
use Auth;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = Banco::orderby('ban_nombre')->paginate(5);

        return view('admin.banco.banco.index')->with(compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            return view('admin.banco.banco.create');
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
    public function store(BancoRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $banco = new Banco($request->all());
            $banco->save();

            flash("Registro del banco '' ".$request->ban_nombre." '' exitoso")->success();
            return redirect()->route('banco.index');
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
            $banco =  Banco::find($id);
            if ($banco !== null) {
                return view('admin.banco.banco.edit')->with(compact('banco'));
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
    public function update(BancoRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $banco = Banco::find($id);
            if ($banco !== null) {
                $banco->ban_nombre = $request->ban_nombre;
                $banco->save();

                flash("Modificación del banco '' ".$banco->ban_nombre." '' exitoso")->success();
                return redirect()->route('banco.index');
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
            $banco = Banco::find($id);
            if ($banco !== null) {
                $banco->delete();

                flash("Eliminación del banco '' ".$banco->ban_nombre." '' exitoso")->success();
                return redirect()->route('banco.index');
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
