<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracast\Flash\Flash;
use App\Estado;
use App\Municipio;
use App\Http\Requests\EstadoResquest;

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
        return view('admin.lugar.estado.create');
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

            $estado = new Estado($request->all()); //request valores recibidos del formulario
            $estado->save();

            //$estado = DB::table('estado')->orderBy('est_nombre', 'asc')->get();


            //return view ('admin.lugar.estado.index',['estado' => $estado]);
        //DB::commit();

        flash("Registro del estado " .$request->est_nombre . " exitosamente.")->success();
        return redirect()->route('estado.index');
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
        $estado = Estado::find($id);
        if ($estado !== null) {
           
            return view('admin.lugar.estado.edit',['estado'=>$estado]);
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('estado.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoResquest $request, $id)
    {
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $estado = Estado::find($id);

        if ($estado !== null) {
            
            $estado->delete();

            flash("Eliminación del estado " .$estado->est_nombre . " exitosamente.")->success();
            return redirect()->route('estado.index');
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('estado.index');
        }

    }
}
