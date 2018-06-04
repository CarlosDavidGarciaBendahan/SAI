<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use Carbon\Carbon;
use App\Producto_Computador;
use App\Producto_Articulo;

class ReporteVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $anos = $this->AnosActivos();
        $meses = $this->Meses();

        //dd($meses);
        //$ventas = venta::where('ven_eliminada','=','0')->orderby('ven_fecha_compra','DESC')->get();
        
        return view('admin.reportes.ventas.index')->with(compact('ventas','anos','meses'));
        
    }

    public function AnosActivos(){

        $anos = array();
        //dd($anos);
        for ($i=2013; $i <= Carbon::now()->year ; $i++) { 
            $anos = array_add($anos,$i,$i);
        }

        return $anos;
    }

    public function Meses(){

        $meses = array(); 
        $meses = array_add($meses,1,'Enero');
        $meses = array_add($meses,2,'Febrero');
        $meses = array_add($meses,3,'Marzo');
        $meses = array_add($meses,4,'Abril');
        $meses = array_add($meses,5,'Mayo');
        $meses = array_add($meses,6,'Junio');
        $meses = array_add($meses,7,'Julio');
        $meses = array_add($meses,8,'Agosto');
        $meses = array_add($meses,9,'Septiembre');
        $meses = array_add($meses,10,'Octubre');
        $meses = array_add($meses,11,'Noviembre');
        $meses = array_add($meses,12,'Diciembre');       

        return $meses;
    }


    public function ventasMensuales(Request $request){


        //dd($request->all());
        $year = $request->year;
        $month = $request->month;

        $fechaI = Carbon::parse($year."-".$month."-1");
        $fechaF = Carbon::parse($year."-".$month."-1")->addMonth()->subDay();


        //arreglo con fecha inicio de cada semana del mes
        $array_inicioSemana = $this->NumeroSemanasMes($year,$month);
        //arreglo con la fecha fin de cada semana del mes
        $array_finSemana = $this->NumeroSemanasMes2($year,$month);

        $anos = $this->AnosActivos();
        $meses = $this->Meses();


        $productoPCs = producto_computador::orderby('pro_com_codigo','ASC')->get();
        $productoArticulos = producto_articulo::orderby('pro_art_codigo','ASC')->get();

        $ventas = venta::whereven_eliminada(0)->where('ven_fecha_compra','>=',$fechaI)->where('ven_fecha_compra','<=',$fechaF)->orderby('ven_fecha_compra','DESC')->get();

        $ingresoMensual = $this->CalculoDeIngresos($ventas);

        $cantidadPC = array();
        $cantidadIngresoPC = array();
        foreach ($productoPCs as $PC) {
            $total = $this->ContarPCenVentas($ventas,$PC->pro_com_codigo);

            $cantidadPC = array_add($cantidadPC,$PC->pro_com_codigo,$total);
            $cantidadIngresoPC = array_add($cantidadIngresoPC,$PC->pro_com_codigo,$this->IngresosPCenVentas($ventas,$PC->pro_com_codigo));
        }

        //dd($cantidadIngresoPC);
        $cantidadArticulo = array();

        $cantidadIngresoArticulo = array();
        foreach ($productoArticulos as $Articulo) {
            $total = $this->ContarArticuloenVentas($ventas,$Articulo->pro_art_codigo);

            $cantidadArticulo = array_add($cantidadArticulo,$Articulo->pro_art_codigo,$total);
            $cantidadIngresoArticulo = array_add($cantidadIngresoArticulo,$Articulo->pro_art_codigo,$this->IngresosArticuloenVentas($ventas,$Articulo->pro_art_codigo));
        }


        //dd($cantidadIngresoArticulo);
        //$ventas = venta::whereven_eliminada(0)->where('ven_fecha_compra','>=',$fechaI)->where('ven_fecha_compra','<=',$fechaF)->orderby('ven_fecha_compra','DESC')->paginate(5);

        return view('admin.reportes.ventas.ventasMensuales')->with(compact('year','month','anos','meses','ventas','productoPCs','productoArticulos','cantidadPC','cantidadArticulo','cantidadIngresoPC','cantidadIngresoArticulo','array_inicioSemana','array_finSemana','ingresoMensual'));
    }


    public function ventasSemanales(Request $request){


        //dd($request->all());
        $year = $request->year;
        $month = $request->month;
        $numeroSemana = $request->numeroSemana;
        //arreglo con fecha inicio de cada semana del mes
        $array_inicioSemana = $this->NumeroSemanasMes($year,$month);
        //arreglo con la fecha fin de cada semana del mes
        $array_finSemana = $this->NumeroSemanasMes2($year,$month);

        $anos = $this->AnosActivos();
        $meses = $this->Meses();


        $productoPCs = producto_computador::orderby('pro_com_codigo','ASC')->get();
        $productoArticulos = producto_articulo::orderby('pro_art_codigo','ASC')->get();

        $ventas = venta::whereven_eliminada(0)->where('ven_fecha_compra','>=',$array_inicioSemana[$numeroSemana])->where('ven_fecha_compra','<=',$array_finSemana[$numeroSemana])->orderby('ven_fecha_compra','DESC')->get();
        $ingresoMensual = $this->CalculoDeIngresos($ventas);
        //dd($ventas);

        $cantidadPC = array();
        $cantidadIngresoPC = array();
        foreach ($productoPCs as $PC) {
            $total = $this->ContarPCenVentas($ventas,$PC->pro_com_codigo);

            $cantidadPC = array_add($cantidadPC,$PC->pro_com_codigo,$total);
            $cantidadIngresoPC = array_add($cantidadIngresoPC,$PC->pro_com_codigo,$this->IngresosPCenVentas($ventas,$PC->pro_com_codigo));
        }

        //dd($cantidadIngresoPC);
        $cantidadArticulo = array();

        $cantidadIngresoArticulo = array();
        foreach ($productoArticulos as $Articulo) {
            $total = $this->ContarArticuloenVentas($ventas,$Articulo->pro_art_codigo);

            $cantidadArticulo = array_add($cantidadArticulo,$Articulo->pro_art_codigo,$total);
            $cantidadIngresoArticulo = array_add($cantidadIngresoArticulo,$Articulo->pro_art_codigo,$this->IngresosArticuloenVentas($ventas,$Articulo->pro_art_codigo));
        }

        //dd($cantidadIngresoArticulo);


        return view('admin.reportes.ventas.ventasSemanales')->with(compact('year','month','anos','meses','ventas','productoPCs','productoArticulos','cantidadPC','cantidadArticulo','cantidadIngresoPC','cantidadIngresoArticulo','array_inicioSemana','array_finSemana','ingresoMensual'));
    }

    public function ContarPCenVentas($ventas,$codigoPC){
        $contador = 0;

         //dd($solicitudes);
        foreach ($ventas as $venta) {
            foreach ($venta->ventaPCs as $PC) {
                if ($codigoPC === $PC->producto_computador->pro_com_codigo) {
                    $contador++;
                }
            }
        }

        return $contador;

    }

    public function ContarArticuloenVentas($ventas,$codigoArticulo){
        $contador = 0;

         //dd($solicitudes);
        foreach ($ventas as $venta) {
            foreach ($venta->ventaArticulos as $articulo) {
                if ($codigoArticulo === $articulo->producto_articulo->pro_art_codigo) {
                    $contador++;
                }
            }
        }

        return $contador;

    }

    public function IngresosPCenVentas($ventas,$codigoPC){
        $contador = 0;

         //dd($solicitudes);
        foreach ($ventas as $venta) {
            foreach ($venta->ventaPCs as $PC) {
                if ($codigoPC === $PC->producto_computador->pro_com_codigo) {
                    $contador = $contador + $PC->producto_computador->pro_com_precio;
                }
            }
        }

        return $contador;

    }

    public function IngresosArticuloenVentas($ventas,$codigoArticulo){
        $contador = 0;

         //dd($solicitudes);
        foreach ($ventas as $venta) {
            foreach ($venta->ventaArticulos as $articulo) {
                if ($codigoArticulo === $articulo->producto_articulo->pro_art_codigo) {
                    $contador = $contador + $articulo->producto_articulo->pro_art_precio;
                }
            }
        }

        return $contador;

    }

    public function NumeroSemanasMes($year,$month){

        $fechaI = Carbon::parse($year."-".$month."-1");
        //$fechaI2 = Carbon::parse($year."-".$month."-1");
        $fechaF = Carbon::parse($year."-".$month."-1")->addMonth()->subDay();

        $semanasI = array(); 
        //$semanasF = array(); 

        $i=$fechaI->day + 7;// comienzo a contar desde la segunda semana
        $numeroSemana=2;//dese la segunda semana

        $semanasI = array_add($semanasI,1,$fechaI->toDateString());    
        //$semanasF = array_add($semanasF,1,$fechaI2->addDay(6)->toDateString());   
        while ( $i <= $fechaF->day) {


            $semanasI = array_add($semanasI,$numeroSemana,$fechaI->addDay(7)->toDateString());//inicio semana

            //$semanasF = array_add($semanasF,$numeroSemana,$fechaI2->addDay(7)->toDateString());//fin de semana

            $numeroSemana++;
            $i=$i+7;
        }
           
             
        return $semanasI;
    }

    public function NumeroSemanasMes2($year,$month){

        $fechaI2 = Carbon::parse($year."-".$month."-1");
        $fechaF = Carbon::parse($year."-".$month."-1")->addMonth()->subDay();

        $semanasF = array(); 

        $i=Carbon::parse($year."-".$month."-1")->day + 7;// comienzo a contar desde la segunda semana
        $numeroSemana=2;//dese la segunda semana
    
        $semanasF = array_add($semanasF,1,$fechaI2->addDay(6)->toDateString());   
        while ( $i <= $fechaF->day) {
            $fecha = $fechaI2->addDay(7)->toDateString();

            if ($fecha > $fechaF) {
                
                $semanasF = array_add($semanasF,$numeroSemana,$fechaF);//fin de semana
            }else{
                $semanasF = array_add($semanasF,$numeroSemana,$fecha);//fin de semana
            }



            $numeroSemana++;
            $i=$i+7;
        }
           
             
        return $semanasF;
    }

    public function CalculoDeIngresos($ventas){
        $contador = 0;

         //dd($solicitudes);
        foreach ($ventas as $venta) {
            $contador = $contador + $venta->ven_monto_total;
        }

        return $contador;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
