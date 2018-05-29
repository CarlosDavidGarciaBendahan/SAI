<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parroquia;
use App\Estado;
use App\Municipio;
use Laracast\Flash\Flash;

class ParroquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //dd("fffff");
        $parroquias = Parroquia::where('id','>',0)->orderby('par_fk_municipio','asc')->paginate(5);

        return view('admin.lugar.parroquia.index',['parroquias'=>$parroquias]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();

        return view ('admin.lugar.parroquia.create')->with(compact('estados'));
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

        $parroquia = new Parroquia($request->all());
        $parroquia->save();
        flash("Registro de la parroquia " .$request->par_nombre . " exitosamente.")->success();
        return redirect()->route('parroquia.index');
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
        $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->get();
        $parroquia = Parroquia::find($id);

        return view ('admin.lugar.parroquia.edit')->with(compact(['parroquia','estados']));
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
       // dd($request->all());
        $parroquia = Parroquia::find($id);
        $parroquia->par_nombre = $request->par_nombre;
        $parroquia->par_fk_municipio = $request->par_fk_municipio;
        $parroquia->save();
        //dd($parroquia);

        flash("Modificación de la Parroquia " .$parroquia->par_nombre . " exitosamente.")->success();
        return redirect()->route('parroquia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Parroquia = Parroquia::find($id);
        $Parroquia->delete();

        flash("Eliminación de la Parroquia " .$Parroquia->par_nombre . " exitosamente.")->success();
        return redirect()->route('parroquia.index');
    }
}
