<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracast\Flash\Flash;
use App\FuenteVenta;
use App\Http\Requests\FuenteVentaRequest;
use Auth;

class FuenteVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuenteVentas = FuenteVenta::orderby('nombre','ASC')->paginate();


        return view('admin.oficina.fuenteventa.index')->with(compact('fuenteVentas')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            return view('admin.oficina.fuenteventa.create');
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
    public function store(FuenteVentaRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $fuenteventa = new fuenteventa($request->all());


            $fuenteventa->save();

            flash('Fuente de venta "'.$request->nombre.'" creada exitosamente.' )->success();
            return redirect()->route('fuenteventa.index');
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        ;
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

            $fuenteventa = fuenteventa::find($id);
            if ($fuenteventa !== null) {

                return view('admin.oficina.fuenteventa.edit')->with(compact('fuenteventa'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FuenteVentaRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $fuenteventa = fuenteventa::find($id);
            if ($fuenteventa !== null) {
                $fuenteventa->nombre = $request->nombre;
                $fuenteventa->descripcion = $request->descripcion;

                $fuenteventa->save();


                flash('Fuente de venta "'.$fuenteventa->nombre.'" editada exitosamente.' )->success();
                return redirect()->route('fuenteventa.index');
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
            $fuenteventa = fuenteventa::find($id);
            if ($fuenteventa !== null) {
                $fuenteventa->delete();

                flash('Fuente de venta "'.$fuenteventa->nombre.'" eliminada exitosamente.' )->error();
                return redirect()->route('fuenteventa.index');
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
