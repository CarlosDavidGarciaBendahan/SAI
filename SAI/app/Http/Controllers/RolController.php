<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Rol;


class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::orderBy('rol_rol','asc')->paginate(5);

        return view('admin.oficina.rol.index')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.oficina.rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = new Rol($request->all());

        $rol->save();

        flash("Registro del rol '' ".$request->rol_rol." '' exitoso")->success();
        return redirect()->route('rol.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);

        return view('admin.oficina.rol.show')->with(compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);

        return view('admin.oficina.rol.edit')->with(compact('rol'));
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
        $rol = Rol::find($id);

        $rol->rol_rol = $request->rol_rol;
        $rol->save();


        flash("Modificación del rol '' ".$rol->rol_rol." '' exitoso")->success();
        return redirect()->route('rol.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->delete();

        flash("Eliminación del rol '' ".$rol->rol_rol." '' exitoso")->success();
        return redirect()->route('rol.index');
    }
}
