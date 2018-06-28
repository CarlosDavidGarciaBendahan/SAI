<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cambio_bolivar;
class cambio_bolivarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*for ($i=1; $i <= 12 ; $i++) { 
            for ($j=1; $j <= 31; $j++) { 
                //echo("i: ".$i." j:".$j." <br>");
               // echo("insert into cambio_bolivar (fecha,precio_dolar) values ('2018-".$i."-01',333);");
                echo("insert into cambio_bolivar (fecha,precio_dolar) values ('2018-".$i."-".$j."',333); <br>");
            }
        }*/
        $cotizaciones = cambio_bolivar::orderby('fecha','DESC')->paginate(10);
        return view('admin.cambio_bolivar.cambio_bolivar')->with(compact('cotizaciones'));
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
        $cambio = new cambio_bolivar($request->all());
        $cambio->save();

        flash("Cotización registrada")->success();
        return redirect()->route('cambio_bolivar.create');
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
        $c = cambio_bolivar::wherefecha($id);
        $c->delete();


        flash("Cotización eliminada")->success();
        return redirect()->route('cambio_bolivar.create');


    }
}
