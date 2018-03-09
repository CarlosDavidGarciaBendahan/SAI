<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Lote;
use Laracast\Flash\Flash;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotes = Lote::orderby('lot_nombre')->paginate(5);
        //$date = Carbon::now();
        //$date = $date->format('d-m-Y');
        ///dd($date);

        return view('admin.producto.lote.index')->with(compact('lotes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.producto.lote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$date = new Carbon;
        //$date = $date->format('d-m-Y');
        //$date = $request->lot_fecha_recibido;
        
        $lote = new Lote($request->all());
        //$lote->lot_nombre = $request->lot_nombre;
        //$lote->lot_fecha_recibido = $date;
        dd($lote);
        $lote->save();

        flash("Registro del lote '' ". $request->lot_nombre . " '' exitoso.")->success();
        return redirect()->route('lote.index');
        //dd($date);
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
        $lote =  Lote::find($id);

        return view('admin.producto.lote.show')->with(compact('lote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote =  Lote::find($id);

        return view('admin.producto.lote.edit')->with(compact('lote'));
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
        $lote =  Lote::find($id);

        $lote->lot_nombre = $request->lot_nombre;
        $lote->lot_fecha_recibido = $request->lot_fecha_recibido;

        $lote->save();

        flash("Modificación del lote '' ". $lote->lot_nombre ." '' exitoso")->success();
        return redirect()->route('lote.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lote =  Lote::find($id);
        $lote->delete();

        flash("Eliminación del lote '' ". $lote->lot_nombre ." '' exitoso")->success();
        return redirect()->route('lote.index');
    }
}
