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
use App\UnidadMedida;
use App\CodigoArticulo;
use Auth;
use App\Http\Requests\ProArtRequest;
use App\Http\Requests\ProArtEditRequest;
use Illuminate\Support\Facades\Storage; //eliminar imagenes
use Illuminate\Support\Facades\DB;


class Producto_ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto_articulos = Producto_Articulo::orderby('pro_art_codigo')->paginate(5);

        return view('admin.producto.producto_articulo.index')->with(compact('producto_articulos'));
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
            $unidadmedidas = UnidadMedida::orderby('uni_medida')->get();

            return view('admin.producto.producto_articulo.create')->with(compact('oficinas','marcas','tipo_productos','unidadmedidas'));
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
    public function store(ProArtRequest $request)
    {

        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){

            //dd($request->all());
            $producto_articulo = new Producto_Articulo($request->all());
            $producto_articulo->pro_art_codigo = strtoupper($producto_articulo->pro_art_codigo);
            //dd($producto_articulo);
            //dd($producto_articulo);
            $producto_articulo->pro_art_cantidad = 0;
            $producto_articulo->pro_art_moneda = '$';
            $producto_articulo->save();

            $file = $request->file('imagen');        
            $name = 'indatechC.A._' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $path = public_path() . '/imagenes/articulo/';
            $file->move($path,$name);

            $imagen = new Imagen();
            $imagen->ima_nombre = $name;
            $imagen->producto_articulo()->associate($producto_articulo);
            $imagen->save();



            flash("Registro del articulo '' ".$request->pro_art_codigo." '' exitoso")->success();
            return redirect()->route('producto_articulo.index');
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
    {

            $producto_articulo = Producto_Articulo::find($id);
            if ($producto_articulo !== null) {

                $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->get();
                $sectores = Sector::orderby('sec_sector')->get();
                $marcas = Marca::orderby('mar_marca')->get();
                $modelos = Modelo::orderby('mod_modelo')->get();
                $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
                $unidadmedidas = UnidadMedida::orderby('uni_medida')->get();


                $codigosArticulo = CodigoArticulo::where('cod_art_fk_producto_articulo','=',$id)->orderby('cod_art_codigo','ASC')->paginate(5);

                return view('admin.producto.producto_articulo.show')->with(compact('oficinas','marcas','tipo_productos','producto_articulo','sectores','modelos','unidadmedidas','codigosArticulo'));
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


            $producto_articulo = Producto_Articulo::find($id);
            if ($producto_articulo !== null) {

                $oficinas = Oficina::where('id','>',0)->orderby('ofi_direccion')->get();
                $sectores = Sector::orderby('sec_sector')->get();
                $marcas = Marca::orderby('mar_marca')->get();
                $modelos = Modelo::orderby('mod_modelo')->get();
                $tipo_productos = Tipo_Producto::orderby('tip_tipo')->get();
                $unidadmedidas = UnidadMedida::orderby('uni_medida')->get();

                $codigosArticulo = CodigoArticulo::where('cod_art_fk_producto_articulo','=',$id)->orderby('cod_art_codigo','ASC')->paginate(5);

                return view('admin.producto.producto_articulo.edit')->with(compact('oficinas','marcas','tipo_productos','producto_articulo','sectores','modelos','unidadmedidas','codigosArticulo'));

           

            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
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
    public function update(ProArtEditRequest $request, $id)
    {
        /*if (   $request->imagen === null) {
            dd("no hay imagen");
        }
        dd($request->all());*/
        if (Auth::user()->rol->rol_rol === 'Administrador' || Auth::user()->rol->rol_rol === 'Encargado'){


            $producto_articulo = Producto_Articulo::find($id);   
            if ($producto_articulo !== null) {

                $producto_articulo->pro_art_descripcion = $request->pro_art_descripcion;
                $producto_articulo->pro_art_cantidad = $request->pro_art_cantidad;
                $producto_articulo->pro_art_precio = $request->pro_art_precio;
                $producto_articulo->pro_art_moneda = $request->pro_art_moneda;
                $producto_articulo->pro_art_catalogo = $request->pro_art_catalogo;
                $producto_articulo->pro_art_capacidad = $request->pro_art_capacidad;
                $producto_articulo->pro_art_fk_sector = $request->pro_art_fk_sector;
                $producto_articulo->pro_art_fk_modelo = $request->pro_art_fk_modelo;
                $producto_articulo->pro_art_fk_tipo_producto = $request->pro_art_fk_tipo_producto;
                $producto_articulo->pro_art_fk_unidadmedida = $request->pro_art_fk_unidadmedida;

                $producto_articulo->save();


                //Actualizo la imagen... SI Y SOLO SI, SE HA ENVIADO UNA NUEVA
                if ($request->imagen !== null) {
                    $path = public_path() . '\\imagenes\\articulo\\';
                    if (count($producto_articulo->imagenes) !== 0) { //si tengo imagenes elimino esas imagenes
                        foreach ($producto_articulo->imagenes as $imagen) {
                            if(file_exists($path.$imagen->ima_nombre)){
                              unlink($path.$imagen->ima_nombre);
                            }
                            //Storage::delete($path.$imagen->ima_nombre);
                            //dd($path.$imagen->ima_nombre);
                        }
                        DB::table('imagen')->where('ima_fk_producto_articulo','=',$producto_articulo->id)->delete();
                    }

                    $file = $request->file('imagen');        
                    $name = 'indatechC.A._' . time() . '.' . $request->file('imagen')->getClientOriginalExtension();
                   
                    $file->move($path,$name);

                    $imagen = new Imagen();
                    $imagen->ima_nombre = $name;
                    $imagen->producto_articulo()->associate($producto_articulo);
                    $imagen->save();
                }
                



                flash("Modificación del articulo '' ".$producto_articulo->pro_art_codigo." '' exitoso")->success();
                return redirect()->route('producto_articulo.index');
           

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


            $producto_articulo = Producto_Articulo::find($id);
            if ($producto_articulo !== null) {

                $producto_articulo->delete();
                flash("Eliminación del articulo '' ".$producto_articulo->pro_art_codigo." '' exitoso")->success();
                return redirect()->route('producto_articulo.index');
           

            }else{  
                flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
                return redirect()->route('producto_articulo.index');
            }
        }else{

            flash('Solo los usuarios con el rol "Administrador" puede eliminar.')->error();
            return redirect()->back();

        }
    }

    public function BuscarArticulo($id){

        $producto_articulo = producto_articulo::Find($id);
        $producto_articulo->tipo_producto;
        


        return ($producto_articulo);
    }

}
