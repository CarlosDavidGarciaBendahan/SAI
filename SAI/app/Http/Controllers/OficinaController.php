<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Oficina;
use App\Estado;
use App\Municipio;
use App\Parroquia;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Oficina::orderby('ofi_tipo','ofi_direccion')->paginate(5);

        return view('admin.oficina.oficina.index')->with(compact('oficinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('est_nombre','id')->orderby('est_nombre','asc')->get();

        return view ('admin.oficina.oficina.create')->with(compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $oficina = new Oficina($request->all());
        $oficina->save();

        flash("Registro de la oficina '' ".$request->ofi_direccion." '' exitoso")->success();
        return redirect()->route('oficina.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estados = Estado::select('est_nombre','id')->orderby('est_nombre','asc')->get();
        $oficina = Oficina::find($id);

        return view ('admin.oficina.oficina.show')->with(compact('estados','oficina'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::select('est_nombre','id')->orderby('est_nombre','asc')->get();
        $oficina = Oficina::find($id);

        return view ('admin.oficina.oficina.edit')->with(compact('estados','oficina'));
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
        $oficina = Oficina::find($id);
        $oficina->ofi_tipo = $request->ofi_tipo;
        $oficina->ofi_direccion = $request->ofi_direccion;
        $oficina->ofi_fk_parroquia = $request->ofi_fk_parroquia;
        $oficina->save();

        flash("Modificación de la oficina '' ". $request->ofi_direccion ." '' exitoso")->success();
        return redirect()->route('oficina.index');
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
        $oficina = Oficina::find($id);
        $oficina->delete();

        flash("Eliminación de la oficina '' ". $oficina->ofi_direccion ." '' exitoso")->success();
        return redirect()->route('oficina.index');

    }
}
