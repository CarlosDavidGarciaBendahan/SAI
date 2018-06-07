<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Empresa;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Contacto_Correo;
use App\Contacto_Telefono;
use App\Http\Requests\EmpresaRequest;
use Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::orderBy('emp_identificador','emp_rif','asc')->paginate(5);

        return view('admin.oficina.empresa.index')->with(compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $estados = Estado::orderby('est_nombre','asc')->get();
            return view('admin.oficina.empresa.create')->with(compact('estados'));

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
    public function store(EmpresaRequest $request)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $empresa = new Empresa($request->all());
            $empresa->save();
            //dd($empresa);
            foreach ($request->correos as $correo) {
                $c = new Contacto_Correo();
                $c->con_cor_correo = $correo;
                $c->empresa()->associate($empresa); 
                $c->con_cor_fk_cliente_natural = null;
                $c->con_cor_fk_cliente_juridico = null;
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
                $tlf->empresa()->associate($empresa); 
                $tlf->con_tel_fk_cliente_natural = null;
                $tlf->con_tel_fk_cliente_juridico = null;
                $tlf->con_tel_fk_personal = null;

                $tlf->save();
            }

            
            

            flash("Registro de la empresa '' ".$request->emp_nombre." '' exitoso")->success();
            return redirect()->route('empresa.index');
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        //dd(sizeof($request->numeros));

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       $empresa = Empresa::find($id);
            if ($empresa !== null) {
                $estados = Estado::orderby('est_nombre','asc')->get();
                $municipios = Municipio::orderby('mun_nombre','asc')->get();
                $parroquias = Parroquia::orderby('par_nombre','asc')->get();
                

                $contacto_correos = Contacto_Correo::where('con_cor_fk_empresa','=',$empresa->id)->orderby('con_cor_correo')->get();
                $contacto_telefonos = Contacto_Telefono::where('con_tel_fk_empresa','=',$empresa->id)->orderby('con_tel_codigo','con_tel_numero')->get();

                return view('admin.oficina.empresa.show')->with(compact('empresa','estados','municipios','parroquias','contacto_telefonos','contacto_correos'));
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
            $empresa = Empresa::find($id);
            if ($empresa !== null) {
                $estados = Estado::orderby('est_nombre','asc')->get();
                $municipios = Municipio::orderby('mun_nombre','asc')->get();
                $parroquias = Parroquia::orderby('par_nombre','asc')->get();
                

                $contacto_correos = Contacto_Correo::where('con_cor_fk_empresa','=',$empresa->id)->orderby('con_cor_correo')->get();
                $contacto_telefonos = Contacto_Telefono::where('con_tel_fk_empresa','=',$empresa->id)->orderby('con_tel_codigo','con_tel_numero')->get();
                //dd($contacto_correos);

                return view('admin.oficina.empresa.edit')->with(compact('empresa','estados','municipios','parroquias','contacto_correos','contacto_telefonos'));
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
    public function update(EmpresaRequest $request, $id)
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $empresa = Empresa::find($id);
            if ($empresa !== null) {
                $empresa->emp_nombre = $request->emp_nombre;
                $empresa->emp_direccion = $request->emp_direccion;
                $empresa->emp_fk_parroquia = $request->emp_fk_parroquia;
                $empresa->save();
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden modificar.')->error();
            return redirect()->back();

        }
        //dd($request->all());
        

        

        flash("Modificación de la empresa '' ".$empresa->emp_nombre." '' exitosa")->success();
        return redirect()->route('empresa.index');
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
            $empresa = Empresa::find($id);
            if ($empresa !== null) {
                $empresa->delete();

                flash("Eliminación de la empresa '' ".$empresa->emp_nombre." '' exitosa")->success();
                return redirect()->route('empresa.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador"  puede eliminar.')->error();
            return redirect()->back();

        }
        
        
    }

    public function BuscarEmpresa($id){

        $empresa = Empresa::Find($id);

        $empresa->parroquia;
        $empresa->parroquia->municipio;
        $empresa->parroquia->municipio->estado;
        $empresa->Contacto_Telefonos;
        $empresa->Contacto_Correos;


        return ($empresa);
    }
}
