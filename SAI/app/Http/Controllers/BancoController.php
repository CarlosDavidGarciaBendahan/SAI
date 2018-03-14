<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Banco;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = Banco::orderby('ban_nombre')->paginate(5);

        return view('admin.banco.banco.index')->with(compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banco.banco.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banco = new Banco($request->all());
        $banco->save();

        flash("Registro del banco '' ".$request->ban_nombre." '' exitoso")->success();
        return redirect()->route('banco.index');
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
        $banco =  Banco::find($id);
    
        return view('admin.banco.banco.edit')->with(compact('banco'));
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
        $banco = Banco::find($id);
        $banco->ban_nombre = $request->ban_nombre;
        $banco->save();

        flash("Modificación del banco '' ".$banco->ban_nombre." '' exitoso")->success();
        return redirect()->route('banco.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banco = Banco::find($id);
        $banco->delete();

        flash("Eliminación del banco '' ".$banco->ban_nombre." '' exitoso")->success();
        return redirect()->route('banco.index');
    }
}
