<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Personal;
use App\Oficina;
use App\Rol;
use App\Contacto_Correo;
use App\Contacto_Telefono;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $personals = Personal::orderby('per_identificador','per_cedula')->paginate(5);

        return view('admin.oficina.personal.index')->with(compact('personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderby('est_nombre','asc')->get();
        $roles = Rol::orderby('rol_rol')->pluck('rol_rol','id');
        $oficinas = Oficina::orderby('ofi_direccion')->pluck('ofi_direccion','id');

        return view('admin.oficina.personal.create')->with(compact('estados','roles','oficinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personal = new Personal($request->all());
        $personal->save();

        foreach ($request->correos as $correo) {
            $c = new Contacto_Correo();
            $c->con_cor_correo = $correo;
            $c->personal()->associate($personal); 
            $c->con_cor_fk_cliente_natural = null;
            $c->con_cor_fk_cliente_juridico = null;
            $c->con_cor_fk_empresa = null;

            $c->save();
            //dd($c);
        }

        $cantidadTelefonos = sizeof($request->numeros);

        for ($i=0; $i < $cantidadTelefonos; $i++) { 

            $tlf = new Contacto_Telefono();

            $tlf->con_tel_codigo = $request->codigos[$i];
            $tlf->con_tel_numero = $request->numeros[$i];
            $tlf->con_tel_tipo = $request->tipos[$i];
            $tlf->personal()->associate($personal); 
            $tlf->con_tel_fk_cliente_natural = null;
            $tlf->con_tel_fk_cliente_juridico = null;
            $tlf->con_tel_fk_empresa = null;

            $tlf->save();
        }

        flash("Registro del personal '' ".$request->per_identificador."-".$request->per_cedula." '' exitoso")->success();
        return redirect()->route('personal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();
        $roles = Rol::orderby('rol_rol')->pluck('rol_rol','id');
        $oficinas = Oficina::orderby('ofi_direccion')->pluck('ofi_direccion','id');
        $personal = Personal::find($id);

        return view('admin.oficina.personal.show')->with(compact('estados','municipios','parroquias','roles','oficinas','personal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::orderby('est_nombre','asc')->get();
        $municipios = Municipio::orderby('mun_nombre','asc')->get();
        $parroquias = Parroquia::orderby('par_nombre','asc')->get();
        $roles = Rol::orderby('rol_rol')->pluck('rol_rol','id');
        $oficinas = Oficina::orderby('ofi_direccion')->pluck('ofi_direccion','id');
        $personal = Personal::find($id);

        return view('admin.oficina.personal.edit')->with(compact('estados','municipios','parroquias','roles','oficinas','personal'));
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
        $personal = Personal::find($id);

        $personal->per_nombre = $request->per_nombre;
        $personal->per_nombre2 = $request->per_nombre2;
        $personal->per_apellido = $request->per_apellido;
        $personal->per_apellido2 = $request->per_apellido2;
        $personal->per_fecha_nacimiento = $request->per_fecha_nacimiento;
        $personal->per_sueldo = $request->per_sueldo;
        $personal->per_direccion = $request->per_direccion;
        $personal->per_fk_rol = $request->per_fk_rol;
        $personal->per_fk_oficina = $request->per_fk_oficina;
        $personal->per_fk_parroquia = $request->per_fk_parroquia;

        $personal->save();

        flash("Modificación del personal '' ".$personal->per_identificador."-".$personal->per_cedula." '' exitoso")->success();
        return redirect()->route('personal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personal = Personal::find($id);

        $personal->delete();
        flash("Eliminación del personal '' ".$personal->per_identificador."-".$personal->per_cedula." '' exitoso")->success();
        return redirect()->route('personal.index');
    }
}
