<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracast\Flash\Flash;
use App\Estado;
use App\Municipio;
use App\Http\Requests\EstadoResquest;
use App\Http\Requests\EstadoEditResquest;
use Auth;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function view($id){
        $estado = Estado::find($id);
        $estado->Municipios;

        $estado->Municipios->each(function($municipio){
            $municipio->Parroquias;
        });


        return view('admin.lugar.estado',['estado' => $estado]);
        //dd($estado);
    }*/
    public function index(Request $request)
    {
        $estado = Estado::where('id','>',0)->orderBy('est_nombre')->paginate(10);
        
        return view('admin.lugar.estado.index',['estado'=>$estado]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            return view('admin.lugar.estado.create');
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
    public function store(EstadoResquest $request)
    {
        //dd($request);

        //DB::beginTransaction();

        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $estado = new Estado($request->all()); //request valores recibidos del formulario
            $estado->save(););

            flash("Registro del estado " .$request->est_nombre . " exitosamente.")->success();
            return redirect()->route('estado.index');  
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

        $estado = Estado::find($id);
        if ($estado !== null) {
           
            return view('admin.lugar.estado.show',['estado'=>$estado]);
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('estado.index');
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
            $estado = Estado::find($id);
            if ($estado !== null) {
               
                return view('admin.lugar.estado.edit',['estado'=>$estado]);
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('estado.index');
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
    public function update(EstadoEditResquest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $estado = Estado::find($id);
            if ($estado !== null) {
               
                $estado->est_nombre = $request->est_nombre;
                $estado->save();
                //$estado->slug = $request->slug;
                //dd($estado);

                flash("Modificación del estado exitosamente a ".$estado->est_nombre )->success();
                return redirect()->route('estado.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('estado.index');
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
    public function destroy( $id)
    {

        if (Auth::user()->rol->rol_rol === 'Administrador'){
            $estado = Estado::find($id);

            if ($estado !== null) {
                
                $estado->delete();

                flash("Eliminación del estado " .$estado->est_nombre . " exitosamente.")->success();
                return redirect()->route('estado.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('estado.index');
            }        
        }else{
            flash('Solo los usuarios con el rol "Administrador" pueden eliminar.')->error();
            return redirect()->back();
        }

        

    }
}
