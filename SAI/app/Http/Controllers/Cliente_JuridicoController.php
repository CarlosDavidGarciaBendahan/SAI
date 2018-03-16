<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Cliente_Juridico;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Contacto_Correo;
use App\Contacto_Telefono;

class Cliente_JuridicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes_juridicos = Cliente_Juridico::orderby('cli_jur_identificador','cli_jur_rif')->paginate(5);

        return view('admin.oficina.cliente_juridico.index')->with(compact('clientes_juridicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderby('est_nombre','asc')->get();

        return view('admin.oficina.cliente_juridico.create')->with(compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_juridico = new Cliente_Juridico($request->all());
        $cliente_juridico->save();

        foreach ($request->correos as $correo) {
            $c = new Contacto_Correo();
            $c->con_cor_correo = $correo;
            $c->cliente_juridico()->associate($cliente_juridico); 
            $c->con_cor_fk_cliente_natural = null;
            $c->con_cor_fk_empresa = null;
            $c->con_cor_fk_personal = null;

            $c->save();
            //dd($c);
        }

        $cantidadTelefonos = sizeof($request->numeros);

        for ($i=0; $i < $cantidadTelefonos; $i++) { 

            $tlf = new Contacto_Telefono();

            $tlf->con_tel_codigo = $request->codigos[$i];
            $tlf->con_tel_numero = $request->numeros[$i];
            $tlf->con_tel_tipo = $request->tipos[$i];
            $tlf->cliente_juridico()->associate($cliente_juridico); 
            $tlf->con_tel_fk_cliente_natural = null;
            $tlf->con_tel_fk_empresa = null;
            $tlf->con_tel_fk_personal = null;

            $tlf->save();
        }

        flash("Registro del cliente '' ".$request->cli_jur_nombre." '' exitoso")->success();
        return redirect()->route('cliente_juridico.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente_juridico = Cliente_Juridico::find($id);
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();

        return view('admin.oficina.cliente_juridico.show')->with(compact('cliente_juridico','estados','municipios','parroquias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente_juridico = Cliente_Juridico::find($id);
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();

        return view('admin.oficina.cliente_juridico.edit')->with(compact('cliente_juridico','estados','municipios','parroquias'));

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
        $cliente_juridico = Cliente_Juridico::find($id);
        $cliente_juridico->cli_jur_nombre = $request->cli_jur_nombre;
        $cliente_juridico->cli_jur_direccion = $request->cli_jur_direccion;
        $cliente_juridico->cli_jur_fk_parroquia = $request->cli_jur_fk_parroquia;
        $cliente_juridico->save();

        flash("Modificación del cliente juridico '' ".$request->cli_jur_identificador."-".$request->cli_jur_rif." '' exitosa")->success();
        return redirect()->route('cliente_juridico.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente_juridico = Cliente_Juridico::find($id);
        $cliente_juridico->delete();

        flash("Eliminación del cliente juridico '' ".$cliente_juridico->cli_jur_identificador."-".$cliente_juridico->cli_jur_rif." '' exitosa")->success();
        return redirect()->route('cliente_juridico.index');
    }
}
