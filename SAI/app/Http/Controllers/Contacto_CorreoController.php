<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Contacto_Correo;
use App\Empresa;


class Contacto_CorreoController extends Controller
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

        return view('admin.oficina.contacto_correo.createEmpresa')->with(compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $correo = new Contacto_Correo($request->all());
        $correo->save();

        flash("Registrado el Correo '' ".$correo->con_cor_correo." '' exitosa")->success();

        if ($correo->con_cor_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $correo->con_cor_fk_empresa);
        } else {
            if ($correo->con_cor_fk_cliente_natural !== null) {
                return redirect()->route();
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
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
        $correo = Contacto_Correo::find($id);
        $empresa = Empresa::find($empresa_id);

        //dd($empresa);

        return view('admin.oficina.contacto_correo.editEmpresa')->with(compact('correo','empresa'));
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
        $correo = Contacto_Correo::find($id);

        $correo->con_cor_correo = $request->con_cor_correo;
        $correo->save();

        flash("Modificación del Correo '' ".$correo->con_cor_correo." '' exitosa")->success();

        if ($correo->con_cor_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $correo->con_cor_fk_empresa);
        } else {
            if ($correo->con_cor_fk_cliente_natural !== null) {
                return redirect()->route();
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
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
        $correo = Contacto_Correo::find($id);
        $correo->delete();


        flash("Eliminación del Correo '' ".$correo->con_cor_correo." '' exitosa")->success();

        if ($correo->con_cor_fk_empresa !== null) {
            return redirect()->route('empresa.edit', $correo->con_cor_fk_empresa);
        } else {
            if ($correo->con_cor_fk_cliente_natural !== null) {
                return redirect()->route();
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route();
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
                        return redirect()->route();
                    } 
                }

            }
        }
    }
}
