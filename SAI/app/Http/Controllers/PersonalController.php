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
use App\Http\Requests\PersonalEditRequest;
use App\Http\Requests\PersonalRequest;
use Auth;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $personals = Personal::where('id','>',0)->orderby('per_identificador','per_cedula')->paginate(5);

        return view('admin.oficina.personal.index')->with(compact('personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $estados = Estado::where('id','>',0)->orderby('est_nombre','asc')->get();
            $roles = Rol::where('rol_tipo','=','P')->orderby('rol_rol')->pluck('rol_rol','id');
            $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->pluck('ofi_direccion','id');

            return view('admin.oficina.personal.create')->with(compact('estados','roles','oficinas'));
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
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
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       $personal = Personal::find($id);
            if ($personal !== null) {
                $estados = Estado::where('id','>',0)->orderby('est_nombre','asc')->get();
                $municipios = Municipio::where('id','>',0)->orderby('mun_nombre','asc')->get();
                $parroquias = Parroquia::where('id','>',0)->orderby('par_nombre','asc')->get();
                $roles = Rol::where('rol_tipo','=','P')->orderby('rol_rol')->pluck('rol_rol','id');
                $oficinas = Oficina::orderby('ofi_direccion')->pluck('ofi_direccion','id');
                


                $contacto_correos = Contacto_Correo::where('con_cor_fk_personal','=',$personal->id)->orderby('con_cor_correo')->get();
                $contacto_telefonos = Contacto_Telefono::where('con_tel_fk_personal','=',$personal->id)->orderby('con_tel_codigo','con_tel_numero')->get();

                return view('admin.oficina.personal.show')->with(compact('estados','municipios','parroquias','roles','oficinas','personal','contacto_correos','contacto_telefonos'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $personal = Personal::find($id);
            if ($personal !== null) {
                $estados = Estado::where('id','>',0)->orderby('est_nombre','asc')->get();
                $municipios = Municipio::where('id','>',0)->orderby('mun_nombre','asc')->get();
                $parroquias = Parroquia::where('id','>',0)->orderby('par_nombre','asc')->get();
                $roles = Rol::where('rol_tipo','=','P')->orderby('rol_rol')->pluck('rol_rol','id');
                $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->pluck('ofi_direccion','id');
                

                $contacto_correos = Contacto_Correo::where('con_cor_fk_personal','=',$personal->id)->orderby('con_cor_correo')->get();
                $contacto_telefonos = Contacto_Telefono::where('con_tel_fk_personal','=',$personal->id)->orderby('con_tel_codigo','con_tel_numero')->get();

                return view('admin.oficina.personal.edit')->with(compact('estados','municipios','parroquias','roles','oficinas','personal','contacto_correos','contacto_telefonos'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalEditRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $personal = Personal::find($id);
            if ($personal !== null) {
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
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

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
        if (Auth::user()->rol->rol_rol === 'Administrador'){
            $personal = Personal::find($id);    
            if ($personal !== null) {
                $personal->delete();
                flash("Eliminación del personal '' ".$personal->per_identificador."-".$personal->per_cedula." '' exitoso")->success();
                return redirect()->route('personal.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }
        

        
    }
}
