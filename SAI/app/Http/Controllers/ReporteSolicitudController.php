<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Cliente_Juridico;
use App\Cliente_Natural;

class ReporteSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = solicitud::orderby('id','DESC')->paginate(10);
        $total_cambio = count(solicitud::where('sol_tipo','=','cambio')->where('sol_aprobado','=','S')->get());
        $total_devolucion = count(solicitud::where('sol_tipo','=','devolucion')->where('sol_aprobado','=','S')->get());
        $total_cambio_rechazada = count(solicitud::where('sol_tipo','=','cambio')->where('sol_aprobado','=','N')->get());
        $total_devolucion_rechazada = count(solicitud::where('sol_tipo','=','devolucion')->where('sol_aprobado','=','N')->get());

        $clientes_juridicos = cliente_juridico::orderby('cli_jur_identificador','cli_jur_rif','ASC')->get();
        $clientes_naturales = cliente_natural::orderby('cli_nat_identificador','cli_nat_cedula','ASC')->get();
        
        $totalesJ = array(0 => 0);
        foreach ($clientes_juridicos as $cliente_juridico) {
            $total = $this->ContarSolicitudClienteJ(solicitud::orderby('id','DESC')->get(),$cliente_juridico->id);

            $totalesJ = array_add($totalesJ,$cliente_juridico->id,$total);
        }

        $totalesN = array(0 => 0);
        foreach ($clientes_naturales as $cliente_natural) {
            $total = $this->ContarSolicitudClienteN(solicitud::orderby('id','DESC')->get(),$cliente_natural->id);

            $totalesN = array_add($totalesN,$cliente_natural->id,$total);
        }
        //dd($totalesN[1]);
        //dd(array_get($totalesN,3));
        return view('admin.reportes.solicitudes.index')->with(compact('solicitudes','total_cambio','total_devolucion','total_cambio_rechazada','total_devolucion_rechazada','clientes_juridicos','clientes_naturales','totalesN','totalesJ'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    public function ContarSolicitudClienteJ($solicitudes,$id){

        $contador = 0;
        //dd($solicitudes);
        foreach ($solicitudes as $solicitud) {
            if ($solicitud->notaEntrega->venta->cliente_juridico !== null) {
                    
                if ($solicitud->notaEntrega->venta->cliente_juridico->id === $id) {
                    $contador++;
                }
            }
        }

        return $contador;

    }
    public function ContarSolicitudClienteN($solicitudes,$id){

        $contador = 0;

        foreach ($solicitudes as $solicitud) {
            if ($solicitud->notaEntrega->venta->cliente_natural !== null) {
                if ($solicitud->notaEntrega->venta->cliente_natural->id === $id) {
                    $contador++;
                }
            }
        }

        return $contador;

    }
}
