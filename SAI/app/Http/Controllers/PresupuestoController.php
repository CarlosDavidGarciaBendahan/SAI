<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Presupuesto;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use App\Empresa;
use App\Detalle;
use App\Producto_Computador;
use App\Producto_Articulo;
use Carbon\Carbon;
use App\Mail\EnvioDePresupuesto;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $presupuestos = Presupuesto::where('pre_eliminado','=','0')->orderby('id','ASC')->paginate(10);

        return view('admin.oficina.presupuesto.index')->with(compact('presupuestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::orderby('emp_nombre','ASC')->get();
        $clientes_naturales = Cliente_Natural::orderby('cli_nat_apellido','cli_nat_nombre','ASC')->get();
        $clientes_juridicos= Cliente_Juridico::orderby('cli_jur_nombre','ASC')->get();
        $productos_computadores = Producto_Computador::orderby('pro_com_codigo','ASC')->pluck('pro_com_codigo','id');
        $productos_articulos = Producto_Articulo::orderby('pro_art_codigo','ASC')->pluck('pro_art_codigo','id');

        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');
        //dd($fecha);
       

        return view('admin.oficina.presupuesto.create')->with(compact('empresas','clientes_naturales','clientes_juridicos','productos_computadores','productos_articulos','fecha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->articulo_id);
        //dd($request->computador_id);
        // dd($request->all());

        $presupuesto = new Presupuesto($request->all());


        $tipo_cliente = $request->tipo_cliente;
        
        if($tipo_cliente !== null){
            //dd("El tipo de cliente es: NATURAL");
            $presupuesto->pre_fk_cliente_juridico = null;
            //$presupuesto->pre_fk_cliente_natural = null;
        }else{
            //dd("El tipo de cliente es: JURIDICO");
            $presupuesto->pre_fk_cliente_natural = null;
        }

        //dd($presupuesto);
        if($presupuesto->pre_fk_cliente_natural !== null or $presupuesto->pre_fk_cliente_juridico !== null)
            $presupuesto->save();
        else{
            flash("Debe seleccionar un cliente")->error();
            return back();
        }

        //Registro de los detalles - COMPUTADOR
        $cantidadPC = sizeof($request->computador_id);

        for ($i=0; $i < $cantidadPC; $i++) { 

            $detalle = new Detalle();

            $detalle->det_cantidad = $request->cantidad_computador[$i];
            $detalle->det_total = $request->total_computador[$i];
            $detalle->Presupuesto()->associate($presupuesto); 
            $detalle->Producto_Computador()->associate($request->computador_id[$i]); 
            $detalle->det_fk_producto_articulo = null;

            $detalle->save();
        }
        //Registro de los detalles - ARTICULO
        $cantidadArticulo = sizeof($request->articulo_id);

        for ($i=0; $i < $cantidadArticulo; $i++) { 

            $detalle = new Detalle();

            $detalle->det_cantidad = $request->cantidad_articulo[$i];
            $detalle->det_total = $request->total_articulo[$i];
            $detalle->Presupuesto()->associate($presupuesto); 
            $detalle->Producto_Articulo()->associate($request->articulo_id[$i]); 
            $detalle->det_fk_producto_computador = null;

            $detalle->save();
        }


        //show($presupuesto->id);

        
        $this->downloadServer($presupuesto->id);
        return redirect()->action('PresupuestoController@enviarPresupuesto', [$presupuesto->id]);
        //$this->enviarPresupuesto($presupuesto->id);
        //flash("Registro del presupuesto '' ".$presupuesto->id." '' exitoso")->success();
        //return redirect()->route('presupuesto.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presupuesto = Presupuesto::find($id);
        //dd($presupuesto->cliente_juridico);
        //dd($presupuesto->cliente_natural);
        $pdf = \PDF::loadView('vistaPDF',['presupuesto'=> $presupuesto]);
        //return $pdf->download('presupuesto'.'#'.$presupuesto_id.'.pdf');


        return $pdf->stream('presupuesto'.'#'.$presupuesto->id.'.pdf',array("Attachment" => 0));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presupuesto = Presupuesto::find($id);

        if ($presupuesto->pre_fecha_aprobado === null) {
            $fecha = Carbon::now();
            $fecha = $fecha->format('d-m-Y');

            $presupuesto->pre_fecha_aprobado = $fecha;

            $presupuesto->save();
            $this->downloadServer($presupuesto->id);
            $this->enviarPresupuestoCliente($presupuesto,"El presupuesto #".$presupuesto->id."  ha sido aprobado en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)));
            /*if ($presupuesto->cliente_natural !== null) {
            foreach ($presupuesto->cliente_natural->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto("El presupuesto #".$presupuesto->id."  ha sido aprobado en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)),$presupuesto->id,"Aprobación del presupuesto#".$presupuesto->id));
            }
            } else {
                foreach ($presupuesto->cliente_juridico->contacto_correos as $correo) {
                    \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto("El presupuesto #".$presupuesto->id." ya ha sido aprobado anteriormente en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)),$presupuesto->id,"Aprobación del presupuesto#".$presupuesto->id));
                }
            }*/
            flash("Se ha aprobado el presupuesto #".$presupuesto->id." '' exitosamente")->success();
            //EJEMPLO PARA ENVIO DE CORREO ELECTRONICO
            
        }else
            flash("El presupuesto #".$presupuesto->id." ya ha sido aprobado anteriormente en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)))->error();

        
        
        //\Mail::to($presupuesto->)->send(new EnvioDePresupuesto("mensaje enviado al momento de aprobar el presupuesto."));
        return redirect()->route('presupuesto.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presupuesto = Presupuesto::find($id);


        if ($presupuesto->pre_eliminado === 0) {

            $presupuesto->pre_eliminado = -1;
            $presupuesto->save();
            flash("Se ha eliminado el presupuesto #".$presupuesto->id." '' exitosamente")->success();
            
        }else
            flash("NO se ha eliminado el presupuesto #".$presupuesto->id." ''")->error();

        return redirect()->route('presupuesto.index');
    }

    public function download($id){//descarga para el usuario!!!

        //$name = 'Presupuesto#' . $presupuesto->id  . '.pdf';
        //$path = public_path() . '/presupuesto/';
        //$file->move($path,$name);

        $presupuesto = Presupuesto::find($id);
        //dd($presupuesto->cliente_juridico);
        //dd($presupuesto->cliente_natural);
        $pdf = \PDF::loadView('vistaPDF',['presupuesto'=> $presupuesto]);
        //return $pdf->download('presupuesto'.'#'.$presupuesto_id.'.pdf');
        return $pdf->download('presupuesto'.'#'.$presupuesto->id.'.pdf');
    }


    public function downloadServer($id){
        $presupuesto2 = Presupuesto::find($id);     
        $name = 'Presupuesto#' . $presupuesto2->id  . '.pdf';
        $path = public_path() . '/presupuesto/';   
        $pdf = \PDF::loadView('vistaPDF',['presupuesto'=> $presupuesto2])->save( $path . $name );
    }

    public function enviarPresupuesto($id){

        $presupuesto = Presupuesto::find($id);
        $this->enviarPresupuestoCliente($presupuesto,"Adjunto se encuentra el presupuesto#".$presupuesto->id." .Cualquier duda comunicarse con nosotros.");
        /*if ($presupuesto->cliente_natural !== null) {
            foreach ($presupuesto->cliente_natural->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto("El presupuesto #".$presupuesto->id." ya ha sido aprobado anteriormente en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)),$presupuesto->id," presupuesto#".$presupuesto->id));
            }
            flash("Se ha realizado el envio del presupuesto#". $presupuesto->id." al cliente " . $presupuesto->cliente_natural->cli_nat_nombre ." ".$presupuesto->cliente_natural->cli_nat_nombre2." ".$presupuesto->cliente_natural->cli_nat_apellido." ".$presupuesto->cliente_natural->cli_nat_apellido2)->success();
        } else {
            foreach ($presupuesto->cliente_juridico->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto("El presupuesto #".$presupuesto->id." ya ha sido aprobado anteriormente en la fecha ".date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)),$presupuesto->id," presupuesto#".$presupuesto->id));
            }
            flash("Se ha realizado el envio del presupuesto#". $presupuesto->id." al cliente ". $presupuesto->cliente_juridico->cli_jur_nombre)->success();
        }*/

        return redirect()->route('presupuesto.index');
    }

    public function enviarPresupuestoCliente($presupuesto,$mensaje){
        if ($presupuesto->cliente_natural !== null) {
            foreach ($presupuesto->cliente_natural->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto($mensaje,$presupuesto->id," presupuesto#".$presupuesto->id));
            }
            flash("Se ha realizado el envio del presupuesto#". $presupuesto->id." al cliente " . $presupuesto->cliente_natural->cli_nat_nombre ." ".$presupuesto->cliente_natural->cli_nat_nombre2." ".$presupuesto->cliente_natural->cli_nat_apellido." ".$presupuesto->cliente_natural->cli_nat_apellido2)->success();
        } else {
            foreach ($presupuesto->cliente_juridico->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDePresupuesto($mensaje,$presupuesto->id," presupuesto#".$presupuesto->id));
            }
            flash("Se ha realizado el envio del presupuesto#". $presupuesto->id." al cliente ". $presupuesto->cliente_juridico->cli_jur_nombre)->success();
        }
    }

    public function CancelarPresupuesto($id)
    {
        $presupuesto = Presupuesto::find($id);

        if ($presupuesto->pre_fecha_aprobado !== null) {

            $presupuesto->pre_fecha_aprobado = null;
            $presupuesto->save();

            $this->downloadServer($presupuesto->id);

            $this->enviarPresupuestoCliente($presupuesto,"El presupuesto #".$presupuesto->id." fue cancelado");
            
            flash("Se ha cancelado el presupuesto #".$presupuesto->id." '' exitosamente")->success();
            //EJEMPLO PARA ENVIO DE CORREO ELECTRONICO
            
        }else
            flash("El presupuesto #".$presupuesto->id." no ha sido aprobado anteriormente ")->error();

        
        
        //\Mail::to($presupuesto->)->send(new EnvioDePresupuesto("mensaje enviado al momento de aprobar el presupuesto."));
        return redirect()->route('presupuesto.index');
    }
    
}
