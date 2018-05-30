<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracast\Flash\Flash;
use App\FuenteVenta;

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
        return view('admin.oficina.fuenteventa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fuenteventa = new fuenteventa($request->all());


        $fuenteventa->save();

        flash('Fuente de venta "'.$request->nombre.'" creada exitosamente.' )->success();
        return redirect()->route('fuenteventa.index');
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
        $fuenteventa = fuenteventa::find($id);

        return view('admin.oficina.fuenteventa.edit')->with(compact('fuenteventa'));
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

        $fuenteventa = fuenteventa::find($id);

        $fuenteventa->nombre = $request->nombre;
        $fuenteventa->descripcion = $request->descripcion;

        $fuenteventa->save();


        flash('Fuente de venta "'.$fuenteventa->nombre.'" editada exitosamente.' )->success();
        return redirect()->route('fuenteventa.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fuenteventa = fuenteventa::find($id);

        $fuenteventa->delete();

        flash('Fuente de venta "'.$fuenteventa->nombre.'" eliminada exitosamente.' )->error();
        return redirect()->route('fuenteventa.index');
    }
}
