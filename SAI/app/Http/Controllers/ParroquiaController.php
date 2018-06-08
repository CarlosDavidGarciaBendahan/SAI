<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parroquia;
use App\Estado;
use App\Municipio;
use Laracast\Flash\Flash;
use App\Http\Requests\ParroquiaRequest;
use Auth;

class ParroquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //dd("fffff");
        $parroquias = Parroquia::where('id','>',0)->orderby('par_fk_municipio','asc')->paginate(5);

        return view('admin.lugar.parroquia.index',['parroquias'=>$parroquias]);

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

            return view ('admin.lugar.parroquia.create')->with(compact('estados'));
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
    public function store(ParroquiaRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $parroquia = new Parroquia($request->all());
            $parroquia->save();
            flash("Registro de la parroquia " .$request->par_nombre . " exitosamente.")->success();
            return redirect()->route('parroquia.index');
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
            $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();
            $parroquia = Parroquia::find($id);
            if ($parroquia !== null) {

                return view ('admin.lugar.parroquia.edit')->with(compact(['parroquia','estados']));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('parroquia.index');
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
    public function update(ParroquiaRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $parroquia = Parroquia::find($id);
            if ($parroquia !== null) {
                $parroquia->par_nombre = $request->par_nombre;
                $parroquia->par_fk_municipio = $request->par_fk_municipio;
                $parroquia->save();
                flash("Modificación de la Parroquia " .$parroquia->par_nombre . " exitosamente.")->success();
                return redirect()->route('parroquia.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('parroquia.index');
            }
            //dd($parroquia);

        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
       // dd($request->all());
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

            $Parroquia = Parroquia::find($id);
            if ($parroquia !== null) {
                $Parroquia->delete();

                flash("Eliminación de la Parroquia " .$Parroquia->par_nombre . " exitosamente.")->success();
                return redirect()->route('parroquia.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('parroquia.index');
            }    
        }else{

            flash('Solo los usuarios con el rol "Administrador" puede eliminar.')->error();
            return redirect()->back();

        }
    }
}
