<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\UnidadMedida;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesmedida = UnidadMedida::orderby('uni_medida')->paginate(5);

        return view('admin.producto.unidadmedida.index')->with(compact('unidadesmedida'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.producto.unidadmedida.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $unidadmedida = new UnidadMedida($request->all());
        $unidadmedida->save();

        flash("Registro de la unidad de medida '' ". $request->uni_medida ." '' exitoso.")->success();
        return redirect()->route('unidadmedida.index');
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
        $unidadmedida = UnidadMedida::find($id);

        return view('admin.producto.unidadmedida.edit')->with(compact('unidadmedida'));
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
        $unidadmedida = UnidadMedida::find($id);
        $unidadmedida->uni_medida = $request->uni_medida;
        $unidadmedida->save();

        flash("Modificación de la unidad de medida '' ". $request->uni_medida ." '' exitoso.")->success();
        return redirect()->route('unidadmedida.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidadmedida = UnidadMedida::find($id);
        $unidadmedida->delete();
        flash("Eliminación de la unidad de medida '' ". $unidadmedida->uni_medida ." '' exitoso.")->success();
        return redirect()->route('unidadmedida.index');
    }
}
