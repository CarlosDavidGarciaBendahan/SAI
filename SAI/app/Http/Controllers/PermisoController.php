<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Permiso;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::orderBy('perm_permiso','asc')->paginate(5);

        return view('admin.oficina.permiso.index')->with(compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.oficina.permiso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permiso = new Permiso($request->all());

        $permiso->save();

        flash("Registro del permiso '' ".$request->perm_permiso." '' exitoso")->success();
        return redirect()->route('permiso.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permiso = Permiso::find($id);

        return view('admin.oficina.permiso.show')->with(compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permiso = Permiso::find($id);

        return view('admin.oficina.permiso.edit')->with(compact('permiso'));
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
        $permiso = Permiso::find($id);

        $permiso->perm_permiso = $request->perm_permiso;
        $permiso->save();

        flash("Modificación del permiso '' ".$permiso->perm_permiso." '' exitoso")->success();
        return redirect()->route('permiso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        $permiso->delete();

        flash("Eliminación del permiso '' ".$permiso->perm_permiso." '' exitoso")->success();
        return redirect()->route('permiso.index');

    }
}
