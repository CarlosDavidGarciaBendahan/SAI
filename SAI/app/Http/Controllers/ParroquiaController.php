<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parroquia;
use App\Estado;
use App\Municipio;

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
        $parroquias = Parroquia::orderby('par_fk_municipio','asc')->paginate(5);

        return view('admin.parroquia.index',['parroquias'=>$parroquias]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('est_nombre','id')->orderby('est_nombre','asc')->pluck('est_nombre','id');

        //$municipios = Municipio::select('mun_nombre','id','mun_fk_estado')->orderby('mun_fk_estado','asc')->get();//->pluck('mun_nombre','id','mun_fk_estado');

        //$estados = Estado::select('est_nombre','id')->orderby('est_nombre','asc')->get();
        //dd($municipios);
        //return view ('admin.parroquia.create',['estados'=>$estados,'municipios'=>$municipios]);
        return view ('admin.parroquia.create')->with(compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
