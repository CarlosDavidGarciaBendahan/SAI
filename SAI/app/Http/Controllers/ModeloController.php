<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Marca;
use App\Modelo;

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
        $marcas = Marca::orderby('mar_marca')->pluck('mar_marca','id');
        return view('admin.producto.modelo.create')->with(compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelo = new Modelo($request->all());
        $modelo->save();

        flash("Registro del modelo '' ". $request->mod_modelo." '' exitoso.")->success();
        return redirect()->route('modelo.index');
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
        $modelo = Modelo::find($id);
        $marcas = Marca::orderby('mar_marca')->pluck('mar_marca','id');
        return view('admin.producto.modelo.edit')->with(compact(['modelo','marcas']));
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
        $modelo = Modelo::find($id);

        $modelo->mod_modelo = $request->mod_modelo;
        $modelo->mod_fk_marca = $request->mod_fk_marca;
        $modelo->save();

        flash("Modificación del modelo '' ". $request->mod_modelo." '' exitoso.")->success();
        return redirect()->route('modelo.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = Modelo::find($id);
        $modelo->delete();

        flash("Eliminación del modelo '' ". $modelo->mod_modelo." '' exitoso.")->success();
        return redirect()->route('modelo.index');
    }
}
