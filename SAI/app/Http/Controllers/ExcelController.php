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

    		echo 	$resultados[0]->fecha_pagado." --- ".
    				$resultados[0]->monto." --- ".
    				$resultados[0]->moneda." --- ".
    				$resultados[0]->concepto." --- ".
    				$resultados[0]->forma." --- ".
    				$resultados[0]->numero_referencia." --- ".
    				$resultados[0]->banco_origen." --- ".
    				$resultados[0]->banco_destino." --- ".
    				$resultados[0]->numero_venta."<br>";
    		foreach ($resultados as $resultado) {
    			echo 	$resultado->fecha_pagado."<br>";
    					/*$resultado->monto." --- ".
    					$resultado->moneda." --- ".
    					$resultado->concepto." --- ".
    					$resultado->forma." --- ".
    					$resultado->numero_referencia." --- ".
    					$resultado->banco_origen." --- ".
    					$resultado->banco_destino." --- ".
    					$resultado->numero_venta."<br>"
    			;*/
    			//break;//ejecuto este codigo una sola vez y lo rompo
    		}
    	})->get();

    }
}
