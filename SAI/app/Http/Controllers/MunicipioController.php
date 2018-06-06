<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use App\Municipio;
use Laracast\Flash\Flash;
use App\Http\Requests\MunicipioRequest;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::where('id','>',0)->orderby('mun_nombre','asc')->paginate(10);
        
        
        return view ('admin.lugar.municipio.index',['municipios'=>$municipios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->pluck('est_nombre','id');

        return view('admin.lugar.municipio.create',['estados'=>$estados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioRequest $request)
    {
        //dd($request->all());
        
        
        //DB::beginTransaction();    
            $municipio = new Municipio($request->all());
            $municipio->save();
        //DB::commit();    
            flash("Registro del municipio " .$request->mun_nombre . " exitosamente.")->success();
            return redirect()->route('municipio.index');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $municipio = Municipio::find($id);
        if ($municipio !== null) {
           
            return view ('admin.lugar.municipio.show',['municipio'=>$municipio]);
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('municipio.index');
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
        $municipio = Municipio::find($id);

        if ($municipio !== null) {
        
            $estados = Estado::select('est_nombre','id')->where('id','>',0)->orderby('est_nombre','asc')->pluck('est_nombre','id');
            //dd($municipio);

            return view('admin.lugar.municipio.edit',['municipio'=>$municipio, 'estados'=>$estados]);
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('municipio.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MunicipioRequest $request, $id)
    {
        //dd($request->all());
        $municipio = Municipio::find($id);
        
        if ($municipio !== null) {
        
            $municipio->mun_nombre = $request->mun_nombre;
            $municipio->mun_fk_estado = $request->mun_fk_estado;

            $municipio->save();

            flash("Modificación del municipio exitosamente a ".$municipio->mun_nombre )->success();
            return redirect()->route('municipio.index');
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('municipio.index');
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
        $municipio = Municipio::find($id);
        
        if ($municipio !== null) {
            $municipio->delete();

            flash("Eliminación del municipio " .$municipio->mun_nombre . " exitosamente.")->success();
            return redirect()->route('municipio.index');
        }else{  
            flash('No hay ningun registro en la Base de Datos del objeto buscado.')->error();
            return redirect()->route('municipio.index');
        }
    }
}
