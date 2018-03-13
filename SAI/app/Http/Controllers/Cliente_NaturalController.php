<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Cliente_Natural;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Contacto_Correo;
use App\Contacto_Telefono;


class Cliente_NaturalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes_naturales = Cliente_Natural::orderby('cli_nat_identificador','cli_nat_cedula')->paginate(5);

        return view('admin.oficina.cliente_natural.index')->with(compact('clientes_naturales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderby('est_nombre','asc')->get();

        return view('admin.oficina.cliente_natural.create')->with(compact('estados'));
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
        $cliente_natural = new Cliente_Natural($request->all());
        $cliente_natural->save();

        $contacto_correo = new Contacto_Correo($request->all());
        //asocio el cliente con el contacto, es decir, deberia llenar la FK_cliente_natural
        $contacto_correo->Cliente_Natural()->associate($cliente_natural);
        $contacto_correo->save();
        //dd($contacto_correo);

        flash("Registro del cliente '' ".$request->cli_nat_nombre." '' exitoso")->success();
        return redirect()->route('cliente_natural.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente_natural = Cliente_Natural::find($id);
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();

        return view('admin.oficina.cliente_natural.show')->with(compact('cliente_natural','estados','municipios','parroquias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente_natural = Cliente_Natural::find($id);
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();

        return view('admin.oficina.cliente_natural.edit')->with(compact('cliente_natural','estados','municipios','parroquias'));
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
        $cliente_natural = Cliente_Natural::find($id);
        $cliente_natural->cli_nat_nombre = $request->cli_nat_nombre;
        $cliente_natural->cli_nat_nombre2 = $request->cli_nat_nombre2;
        $cliente_natural->cli_nat_apellido = $request->cli_nat_apellido;
        $cliente_natural->cli_nat_apellido2 = $request->cli_nat_apellido2;
        $cliente_natural->cli_nat_direccion = $request->cli_nat_direccion;
        $cliente_natural->cli_nat_fk_parroquia = $request->cli_nat_fk_parroquia;
        $cliente_natural->save();

        flash("Modificación del cliente natural '' ".$request->cli_nat_identificador."-".$request->cli_nat_cedula." '' exitosa")->success();
        return redirect()->route('cliente_natural.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente_natural = Cliente_Natural::find($id);
        $cliente_natural->delete();

        flash("Eliminación del cliente natural '' ".$cliente_natural->cli_nat_identificador."-".$cliente_natural->cli_nat_cedula." '' exitosa")->success();
        return redirect()->route('cliente_natural.index');
    }
}
