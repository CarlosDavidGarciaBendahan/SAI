<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\NotaEntrega;
use App\Empresa;
use App\Venta;
use Illuminate\Support\Facades\DB;
use App\Mail\EnvioDeNotaEntrega;

class NotaEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$notaEntregas = NotaEntrega::orderby('id','ASC')->paginate(10);


        $notaEntregas = NotaEntrega::orderby('id','ASC')->paginate(10);

        return view('admin.cliente.notaEntrega.index')->with(compact('notaEntregas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($venta_id)
    {
        $fecha = Carbon::now();
        $fecha = $fecha->format('d-m-Y');

        $empresas = Empresa::orderby('emp_nombre','ASC')->get();
        $venta = Venta::find($venta_id);


        //dd($venta->cliente_juridico);
        return view('admin.cliente.notaEntrega.create')->with(compact('venta','empresas','fecha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $notaEntrega = new NotaEntrega($request->all());

        $notaEntrega->save();

        $this->downloadServer($notaEntrega->id);

        flash("Se ha creado la nota de entrega #".$notaEntrega->id." exitosamente")->success();
        return redirect()->route('notaEntrega.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notaEntrega = notaEntrega::find($id);
        //dd($notaEntrega->cliente_juridico);
        //dd($notaEntrega->cliente_natural);
        $pdf = \PDF::loadView('PDF.NotaEntregaPDF',['notaEntrega'=> $notaEntrega]);
        //return $pdf->download('presupuesto'.'#'.$presupuesto_id.'.pdf');


        return $pdf->stream('NotaEntrega'.'#'.$notaEntrega->id.'.pdf',array("Attachment" => 0));
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

    public function downloadServer($id){
        $notaEntrega = NotaEntrega::find($id);     
        $name = 'NotaEntrega#' . $notaEntrega->id  . '.pdf';
        $path = public_path() . '/notaEntrega/';   
        $pdf = \PDF::loadView('PDF.NotaEntregaPDF',['notaEntrega'=> $notaEntrega])->save( $path . $name );
    }

    public function download($id){//descarga para el usuario!!!
        
        $notaEntrega = notaEntrega::find($id);
        $pdf = \PDF::loadView('PDF.NotaEntregaPDF',['notaEntrega'=> $notaEntrega]);
        return $pdf->download('notaEntrega'.'#'.$notaEntrega->id.'.pdf');
    }

    public function enviarNotaEntrega($id){

        $NotaEntrega = NotaEntrega::find($id);
        $this->enviarNotaEntregaCliente($NotaEntrega,"Adjunto se encuentra la NotaEntrega#".$NotaEntrega->id." .Cualquier duda comunicarse con nosotros.");
        return redirect()->route('venta.index');
    }

    public function enviarNotaEntregaCliente($NotaEntrega,$mensaje){
        if ($NotaEntrega->venta->cliente_natural !== null) {
            foreach ($NotaEntrega->venta->cliente_natural->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDeNotaEntrega($mensaje,$NotaEntrega->id," NotaEntrega#".$NotaEntrega->id));
            }
            flash("Se ha realizado el envio del NotaEntrega#". $NotaEntrega->id." al cliente " . $NotaEntrega->venta->cliente_natural->cli_nat_nombre ." ".$NotaEntrega->venta->cliente_natural->cli_nat_nombre2." ".$NotaEntrega->venta->cliente_natural->cli_nat_apellido." ".$NotaEntrega->venta->cliente_natural->cli_nat_apellido2)->success();
        } else {
            foreach ($NotaEntrega->venta->cliente_juridico->contacto_correos as $correo) {
                \Mail::to($correo->con_cor_correo)->send(new EnvioDeNotaEntrega($mensaje,$NotaEntrega->id," NotaEntrega#".$NotaEntrega->id));
            }
            flash("Se ha realizado el envio del NotaEntrega#". $NotaEntrega->id." al cliente ". $NotaEntrega->venta->cliente_juridico->cli_jur_nombre)->success();
        }
    }

}
