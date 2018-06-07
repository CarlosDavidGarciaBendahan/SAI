<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Producto_Computador;
use App\Producto_Articulo;
use App\Tipo_Producto;
use App\Oficina;
use App\Sector;
use App\Marca;
use App\Modelo;
use App\Imagen;
use App\CodigoPC;
use App\Http\Requests\ProComRequest;
use Auth;


class Producto_ComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto_computadoras = Producto_Computador::orderby('pro_com_codigo')->paginate(10);

        return view('admin.producto.producto_computador.index')->with(compact('producto_computadoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
            $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->get();
            $marcas = Marca::orderby('mar_marca')->get();
            $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
            $producto_articulos = Producto_Articulo::orderby('pro_art_codigo')->pluck('pro_art_codigo','id');

            return view('admin.producto.producto_computador.create')->with(compact('oficinas','marcas','tipo_productos','producto_articulos'));

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
    public function store(ProComRequest $request)
    {
        
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){
        

            $producto_computador = new Producto_Computador($request->all());

            $producto_computador->pro_com_codigo = strtoupper($producto_computador->pro_com_codigo);
            //dd($producto_computador);
            $producto_computador->save();

            $producto_computador->articulos()->sync($request->componentes);


            $file = $request->file('imagen');        
            $name = 'indatechC.A._' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $path = public_path() . '/imagenes/computador/';
            $file->move($path,$name);

            $imagen = new Imagen();
            $imagen->ima_nombre = $name;
            $imagen->producto_computador()->associate($producto_computador);
            $imagen->save();



            flash("Registro del computador '' ".$request->pro_com_codigo." '' exitoso")->success();
            return redirect()->route('producto_computador.index');

        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
        //dd($request->file('imagen'));
        //dd($request->codigosPC);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $producto_computador = Producto_Computador::find($id);
        if ($producto_computador !== null) {
            $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->get();
            $sectores = Sector::orderby('sec_sector')->get();
            $marcas = Marca::orderby('mar_marca')->get();
            $modelos = Modelo::orderby('mod_modelo')->get();
            $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
            $producto_articulos = Producto_Articulo::orderby('pro_art_codigo')->pluck('pro_art_codigo','id');

            $codigosPC = CodigoPC::where('cod_pc_fk_producto_computador','=',$id)->orderby('cod_pc_codigo','ASC')->paginate(5);

            return view('admin.producto.producto_computador.show')->with(compact('oficinas','marcas','tipo_productos','producto_computador','sectores','modelos','producto_articulos','codigosPC'));

        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('producto_computador.index');
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


            $producto_computador = Producto_Computador::find($id);
            if ($producto_computador !== null) {

                $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->get();
                $sectores = Sector::orderby('sec_sector')->get();
                $marcas = Marca::orderby('mar_marca')->get();
                $modelos = Modelo::orderby('mod_modelo')->get();
                $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();

                $producto_articulos = Producto_Articulo::orderby('pro_art_codigo')->pluck('pro_art_codigo','id');
                $codigosPC = CodigoPC::where('cod_pc_fk_producto_computador','=',$id)->orderby('cod_pc_codigo','ASC')->paginate(5);

                return view('admin.producto.producto_computador.edit')->with(compact('oficinas','marcas','tipo_productos','producto_computador','sectores','modelos','producto_articulos','codigosPC'));
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_computador.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
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
    public function update(ProComRequest $request, $id)
    {
        //dd($request->all());
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $producto_computador = Producto_Computador::find($id);    
            if ($producto_computador !== null) {
                $producto_computador->pro_com_descripcion = $request->pro_com_descripcion;
                $producto_computador->pro_com_cantidad = $request->pro_com_cantidad;
                $producto_computador->pro_com_precio = $request->pro_com_precio;
                $producto_computador->pro_com_moneda = $request->pro_com_moneda;
                $producto_computador->pro_com_catalogo = $request->pro_com_catalogo;
                $producto_computador->pro_com_fk_sector = $request->pro_com_fk_sector;
                $producto_computador->pro_com_fk_modelo = $request->pro_com_fk_modelo;
                $producto_computador->pro_com_fk_tipo_producto = $request->pro_com_fk_tipo_producto;

                $producto_computador->save();

                $producto_computador->articulos()->detach();
                $producto_computador->articulos()->sync($request->componentes);

                flash("Modificación del computador '' ".$producto_computador->pro_com_codigo." '' exitoso")->success();
                return redirect()->route('producto_computador.index');

            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_computador.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
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
        
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            $producto_computador = Producto_Computador::find($id);
            if ($producto_computador !== null) {

                $producto_computador->delete();
                flash("Eliminación del computador '' ".$producto_computador->pro_com_codigo." '' exitoso")->success();
                return redirect()->route('producto_computador.index');
            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_computador.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" o "Encargado" pueden registrar.')->error();
            return redirect()->back();

        }
    }

    public function BuscarComputador($id){

        $producto_computador = producto_computador::Find($id);
        $producto_computador->tipo_producto;
        


        return ($producto_computador);
    }

    public function catalogo(){

        
        $PCs = Producto_Computador::where('pro_com_catalogo','<>',0)->orderby('pro_com_codigo')->get();


        return view('admin.producto.catalogo.index')->with(compact('PCs'));
    }
}
