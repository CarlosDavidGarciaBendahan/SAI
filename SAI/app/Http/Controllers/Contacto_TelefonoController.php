<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Contacto_Telefono;
use App\Empresa;

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
                return redirect()->route();
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route();
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
                return redirect()->route();
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route();
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
                return redirect()->route();
            } else{
                if ($tlf->con_tel_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($tlf->con_tel_fk_personal !== null) {
                        return redirect()->route();
                    } 
                }

            }
        }
    }
}
