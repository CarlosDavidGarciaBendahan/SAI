<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracast\Flash\Flash;
use App\Estado;
use App\Municipio;

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


        return view('admin.estado',['estado' => $estado]);
        //dd($estado);
    }*/

    public function index()
    {
        //$estado = new Estado::orderBy('est_nombre','ASC')->paginate(1);
        //$estado = new Estado::all();
        $estado = DB::table('estado')->orderBy('est_nombre', 'asc')->get();
        //dd($estado);
        
        //$estado = new Estado();
        //retornar la variable a una vista
        
        return view('admin.estado.index',['estado'=>$estado]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.estado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $estado = new Estado($request->all()); //request valores recibidos del formulario
        $estado->save();

        //$estado = DB::table('estado')->orderBy('est_nombre', 'asc')->get();


        //return view ('admin.estado.index',['estado' => $estado]);
        
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

        return view('admin.estado.show',['estado'=>$estado]);
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

        return view('admin.estado.edit',['estado'=>$estado]);
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
        $estado = Estado::find($id);

        $estado->est_nombre = $request->est_nombre;
        $estado->save();
        //$estado->slug = $request->slug;
        //dd($estado);

        flash("Modificación del estado exitosamente a ".$estado->est_nombre )->success();
        return redirect()->route('estado.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estado = Estado::find($id);
        $estado->delete();

        flash("Eliminación del estado " .$estado->est_nombre . " exitosamente.")->success();
        return redirect()->route('estado.index');

    }
}
