<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Oficina;
use App\Sector;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectores = Sector::orderby('sec_fk_oficina','asc')->paginate(5);

        return view('admin.oficina.sector.index')->with(compact('sectores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oficinas = Oficina::select('*')->where('id','>',0)->orderby('ofi_direccion','asc')->get();

        return view('admin.oficina.sector.create')->with(compact('oficinas'));
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
        $sector = new Sector($request->all());
        $sector->save();

        flash("Registro del sector '' ".$request->sec_sector." '' exitoso")->success();
        return redirect()->route('sector.index');
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
        $sector = Sector::find($id);
       // $oficinas = Oficina::select('*')->orderby('ofi_direccion','asc')->get();
        $oficinas = Oficina::select('id','ofi_direccion')->where('id','>',0)->orderby('ofi_direccion','asc')->pluck('ofi_direccion','id');

        return view('admin.oficina.sector.edit')->with(compact('sector','oficinas'));
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
        $sector = Sector::find($id);
        $sector->sec_sector = $request->sec_sector;
        $sector->sec_fk_oficina = $request->sec_fk_oficina;
        $sector->save();

        flash("Modificación del sector '' ".$sector->sec_sector." exitosa")->success();
        return redirect()->route('sector.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sector = Sector::find($id);
        $sector->delete();

        flash("Eliminación del sector '' ".$sector->sec_sector." exitosa")->success();
        return redirect()->route('sector.index');
    }
}
