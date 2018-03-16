<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Contacto_Telefono;
use App\Empresa;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use App\Personal;

class Contacto_TelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmpresa($empresa_id)
    {
        
        $empresa = Empresa::find($empresa_id);

        return view('admin.oficina.contacto_telefono.createEmpresa')->with(compact('empresa'));
    }
    public function createPersonal($Personal_id)
    {
        
        $personal = Personal::find($Personal_id);

        return view('admin.oficina.contacto_telefono.createPersonal')->with(compact('personal'));
    }
    public function createCliente_Juridico($Cliente_Juridico_id)
    {
        
        $cliente_juridico = Cliente_Juridico::find($Cliente_Juridico_id);

        return view('admin.oficina.contacto_telefono.createCliente_Juridico')->with(compact('cliente_juridico'));
    }
    public function createCliente_Natural($Cliente_Natural_id)
    {
        
        $cliente_natural = Cliente_Natural::find($Cliente_Natural_id);

        return view('admin.oficina.contacto_telefono.createCliente_Natural')->with(compact('cliente_natural'));
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

        $tlf = new Contacto_Telefono($request->all());
        $tlf->save();

        flash("Registrado el telefono '' ".$tlf->con_tel_codigo."-".$tlf->con_tel_numero." '' exitosa")->success();

        if ($tlf->con_tel_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $tlf->con_tel_fk_empresa);
        } else {
            if ($tlf->con_tel_fk_cliente_natural !== null) {
                return redirect()->route('cliente_natural.edit', $tlf->con_tel_fk_cliente_natural);
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $tlf->con_tel_fk_cliente_juridico);
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route('personal.edit', $tlf->con_tel_fk_personal);
                    } 
                }

            }
        }
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
    public function editEmpresa($id,$empresa_id)
    {
        $tlf = Contacto_Telefono::find($id);
        $empresa = Empresa::find($empresa_id);

        //dd($empresa);

        return view('admin.oficina.contacto_telefono.editEmpresa')->with(compact('tlf','empresa'));
    }
    public function editPersonal($id,$Personal_id)
    {
        $tlf = Contacto_Telefono::find($id);
        $personal = Personal::find($Personal_id);

        //dd($Personal);

        return view('admin.oficina.contacto_telefono.editPersonal')->with(compact('tlf','personal'));
    }
    public function editCliente_Juridico($id,$Cliente_Juridico_id)
    {
        $tlf = Contacto_Telefono::find($id);
        $cliente_juridico = Cliente_Juridico::find($Cliente_Juridico_id);

        //dd($Cliente_Juridico);

        return view('admin.oficina.contacto_telefono.editCliente_Juridico')->with(compact('tlf','cliente_juridico'));
    }
    public function editCliente_Natural($id,$Cliente_Natural_id)
    {
        $tlf = Contacto_Telefono::find($id);
        $cliente_natural = Cliente_Natural::find($Cliente_Natural_id);

        //dd($Cliente_Natural);

        return view('admin.oficina.contacto_telefono.editCliente_Natural')->with(compact('tlf','cliente_natural'));
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
        
        //dd($request->all());

        $tlf = Contacto_Telefono::find($id);

        $tlf->con_tel_codigo = $request->con_tel_codigo;
        $tlf->con_tel_numero = $request->con_tel_numero;
        $tlf->con_tel_tipo = $request->con_tel_tipo;
        $tlf->save();

        flash("Modificación del telefono '' ".$tlf->con_tel_codigo."-".$tlf->con_tel_numero." '' exitosa")->success();

        if ($tlf->con_tel_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $tlf->con_tel_fk_empresa);
        } else {
            if ($tlf->con_tel_fk_cliente_natural !== null) {
                return redirect()->route('cliente_natural.edit', $tlf->con_tel_fk_cliente_natural);
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $tlf->con_tel_fk_cliente_juridico);
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route('personal.edit', $tlf->con_tel_fk_personal);
                    } 
                }

            }
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
        $tlf = Contacto_Telefono::find($id);
        $tlf->delete();


        flash("Eliminación del telefono '' ".$tlf->con_tel_codigo."-".$tlf->con_tel_numero." '' exitosa")->success();

        if ($tlf->con_tel_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $tlf->con_tel_fk_empresa);
        } else {
            if ($tlf->con_tel_fk_cliente_natural !== null) {
                return redirect()->route('cliente_natural.edit', $tlf->con_tel_fk_cliente_natural);
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $tlf->con_tel_fk_cliente_juridico);
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route('personal.edit', $tlf->con_tel_fk_personal);
                    } 
                }

            }
        }
    }
}
