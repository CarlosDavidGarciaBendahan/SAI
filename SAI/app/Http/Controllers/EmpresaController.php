<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Empresa;
use App\Estado;
use App\Municipio;
use App\Parroquia;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::orderBy('emp_identificador','emp_rif','asc')->paginate(5);

        return view('admin.oficina.empresa.index')->with(compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $estados = Estado::orderby('est_nombre','asc')->get();
        return view('admin.oficina.empresa.create')->with(compact('estados'));
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

        $empresa = new Empresa($request->all());
        $empresa->save();

        flash("Registro de la empresa '' ".$request->emp_nombre." '' exitoso")->success();
        return redirect()->route('empresa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();
        $empresa = Empresa::find($id);

        return view('admin.oficina.empresa.show')->with(compact('empresa','estados','municipios','parroquias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();
        $empresa = Empresa::find($id);

        return view('admin.oficina.empresa.edit')->with(compact('empresa','estados','municipios','parroquias'));
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
        //dd($request->all());
        $empresa = Empresa::find($id);

        $empresa->emp_nombre = $request->emp_nombre;
        $empresa->emp_direccion = $request->emp_direccion;
        $empresa->emp_fk_parroquia = $request->emp_fk_parroquia;
        $empresa->save();

        flash("Modificación de la empresa '' ".$empresa->emp_nombre." '' exitosa")->success();
        return redirect()->route('empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();

        flash("Eliminación de la empresa '' ".$empresa->emp_nombre." '' exitosa")->success();
        return redirect()->route('empresa.index');
    }
}