<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Oficina;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Http\Requests\OficinaRequest;
use Auth;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Oficina::where('id','>',0)->orderby('ofi_tipo','ofi_direccion')->paginate(5);

        return view('admin.oficina.oficina.index')->with(compact('oficinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();

            return view ('admin.oficina.oficina.create')->with(compact('estados'));
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
    public function store(OficinaRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $oficina = new Oficina($request->all());
            $oficina->save();

            flash("Registro de la oficina '' ".$request->ofi_direccion." '' exitoso")->success();
            return redirect()->route('oficina.index');
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        //dd($request->all());

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       $oficina = Oficina::find($id);
            if ($oficina !== null) {
                $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();
        

                return view ('admin.oficina.oficina.show')->with(compact('estados','oficina'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        
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
            $oficina = Oficina::find($id);
            if ($oficina !== null) {
                $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();
                

                return view ('admin.oficina.oficina.edit')->with(compact('estados','oficina'));
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
    public function update(OficinaRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $oficina = Oficina::find($id);
            if ($oficina !== null) {
                $oficina->ofi_tipo = $request->ofi_tipo;
                $oficina->ofi_direccion = $request->ofi_direccion;
                $oficina->ofi_fk_parroquia = $request->ofi_fk_parroquia;
                $oficina->save();

                flash("Modificación de la oficina '' ". $request->ofi_direccion ." '' exitoso")->success();
                return redirect()->route('oficina.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        
        
        //dd($request->all());
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
            $oficina = Oficina::find($id);
            if ($oficina !== null) {
                $oficina->delete();

                flash("Eliminación de la oficina '' ". $oficina->ofi_direccion ." '' exitoso")->success();
                return redirect()->route('oficina.index');
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
