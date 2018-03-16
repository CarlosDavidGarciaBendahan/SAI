<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracast\Flash\Flash;
use App\Contacto_Correo;
use App\Empresa;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use App\Personal;


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
    public function createPersonal($Personal_id)
    {
        
        $personal = Personal::find($Personal_id);

        return view('admin.oficina.contacto_correo.createPersonal')->with(compact('personal'));
    }
    public function createCliente_Natural($Cliente_Natural_id)
    {
        
        $cliente_natural = Cliente_Natural::find($Cliente_Natural_id);

        return view('admin.oficina.contacto_correo.createCliente_Natural')->with(compact('cliente_natural'));
    }
    public function createCliente_Juridico($Cliente_Juridico_id)
    {
        
        $cliente_juridico = Cliente_Juridico::find($Cliente_Juridico_id);

        return view('admin.oficina.contacto_correo.createCliente_Juridico')->with(compact('cliente_juridico'));
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
                return redirect()->route('cliente_natural.edit', $correo->con_cor_fk_cliente_natural);
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $correo->con_cor_fk_cliente_juridico);
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
                        return redirect()->route('personal.edit', $correo->con_cor_fk_personal);
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
    public function editPersonal($id,$Personal_id)
    {
        $correo = Contacto_Correo::find($id);
        $personal = Personal::find($Personal_id);

        //dd($Personal);

        return view('admin.oficina.contacto_correo.editPersonal')->with(compact('correo','personal'));
    }
    public function editCliente_Juridico($id,$Cliente_Juridico_id)
    {
        $correo = Contacto_Correo::find($id);
        $cliente_juridico = Cliente_Juridico::find($Cliente_Juridico_id);

        //dd($Cliente_Juridico);

        return view('admin.oficina.contacto_correo.editCliente_Juridico')->with(compact('correo','cliente_juridico'));
    }
    public function editCliente_Natural($id,$Cliente_Natural_id)
    {
        $correo = Contacto_Correo::find($id);
        $cliente_natural = Cliente_Natural::find($Cliente_Natural_id);

        //dd($Cliente_Natural);

        return view('admin.oficina.contacto_correo.editCliente_Natural')->with(compact('correo','cliente_natural'));
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
                return redirect()->route('cliente_natural.edit', $correo->con_cor_fk_cliente_natural);
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $correo->con_cor_fk_cliente_juridico);
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
                        return redirect()->route('personal.edit', $correo->con_cor_fk_personal);
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
                return redirect()->route('cliente_natural.edit', $correo->con_cor_fk_cliente_natural);
            } else{
                if ($correo->con_cor_fk_cliente_juridico !== null) {
                    return redirect()->route('cliente_juridico.edit', $correo->con_cor_fk_cliente_juridico);
                }else{
                    if ($correo->con_cor_fk_personal !== null) {
                        return redirect()->route('personal.edit', $correo->con_cor_fk_personal);
                    } 
                }

            }
        }
    }
}
