<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    

    public function ImportarExcel(){

    	$path = public_path() . '/registroPago/';
    	$name = "registroPago1.xlsx";
    	//dd($columnas);
    	\Excel::selectSheets('registro')->load($path.$name, function($archivo){

    		//selecciono las columnas que necesito
    		$columnas = array('fecha_pagado','monto','moneda','concepto','forma','numero_referencia','banco_origen','banco_destino','numero_venta');

    		//agarro los resultados..
    		$resultados = $archivo->get($columnas);
    		//dd($resultados->all());
    		foreach ($resultados as $resultado) {
    			echo 	$resultado->fecha_pagado."<br>".
    					$resultado->monto." ".
    					$resultado->moneda."<br>".
    					$resultado->concepto."<br>".
    					$resultado->forma."<br>".
    					$resultado->numero_referencia."<br>".
    					$resultado->banco_origen."<br>".
    					$resultado->banco_destino."<br>".
    					$resultado->numero_venta."<br>"
    			;
    		}

    	})->get();

    }
}
