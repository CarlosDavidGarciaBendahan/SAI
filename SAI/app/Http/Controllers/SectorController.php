<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Oficina;
use App\Sector;
use App\Http\Requests\SectorRequest;
use Auth;

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
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $oficinas = Oficina::select('*')->where('id','>',0)->orderby('ofi_direccion','asc')->get();

            return view('admin.oficina.sector.create')->with(compact('oficinas'));
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
    public function store(SectorRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $sector = new Sector($request->all());
            $sector->save();

            flash("Registro del sector '' ".$request->sec_sector." '' exitoso")->success();
            return redirect()->route('sector.index');
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        //dd($request->all());
        
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
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $sector = Sector::find($id);
            if ($sector !== null) {
                $oficinas = Oficina::select('id','ofi_direccion')->where('id','>',0)->orderby('ofi_direccion','asc')->pluck('ofi_direccion','id');

                return view('admin.oficina.sector.edit')->with(compact('sector','oficinas'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        
       // $oficinas = Oficina::select('*')->orderby('ofi_direccion','asc')->get();
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectorRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $sector = Sector::find($id);
            if ($sector !== null) {
                $sector->sec_sector = $request->sec_sector;
                $sector->sec_fk_oficina = $request->sec_fk_oficina;
                $sector->save();

                flash("Modificación del sector '' ".$sector->sec_sector." exitosa")->success();
                return redirect()->route('sector.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
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
    public function destroy($id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador'){
            $sector = Sector::find($id);
            if ($sector !== null) {
                $sector->delete();

                flash("Eliminación del sector '' ".$sector->sec_sector." exitosa")->success();
                return redirect()->route('sector.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }
        
        
    }
}
