<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::group(['prefix' => 'Lugar'], function(){

	Route::get('Estado/{id}',[
		'uses'	=>	'EstadoController@view',
		'as'	=>	'EstadoView'
	]);

});*/

/*Route::group(['prefix' => 'admin'], function(){

	Route::resource('estado','EstadoController');//1er para: Nombre para el grupo que creara  2do para: el controlador que tomara

});*/

Route::prefix('admin/lugar/')->group( function(){

	Route::resource('estado','EstadoController');

	//con esta ruta nos ahorramos crear un formulario para poder eliminar y facilitar el diseno...
	Route::get('estado/{id}/destroy',[
		'uses'	=> 'EstadoController@destroy',
		'as'	=> 'estado.destroy'
	]);


	Route::resource('municipio','MunicipioController');
	Route::get('municipio/{id}/destroy',[
		'uses'	=> 'MunicipioController@destroy',
		'as'	=> 'municipio.destroy'
	]);

	Route::resource('parroquia','ParroquiaController');
	Route::get('parroquia/{id}/destroy',[
		'uses'	=> 'ParroquiaController@destroy',
		'as'	=> 'parroquia.destroy'
	]);

});

Route::prefix('admin/producto/')->group( function(){

	Route::resource('tipo_producto','Tipo_ProductoController');
	Route::get('tipo_producto/{id}/destroy',[
		'uses'	=> 'Tipo_ProductoController@destroy',
		'as'	=> 'tipo_producto.destroy'
	]);

	Route::resource('marca','MarcaController');
	Route::get('marca/{id}/destroy',[
		'uses'	=> 'MarcaController@destroy',
		'as'	=> 'marca.destroy'
	]);

	Route::resource('modelo','ModeloController');
	Route::get('modelo/{id}/destroy',[
		'uses'	=> 'modeloController@destroy',
		'as'	=> 'modelo.destroy'
	]);

	Route::resource('unidadmedida','UnidadMedidaController');
	Route::get('unidadmedida/{id}/destroy',[
		'uses'	=> 'UnidadMedidaController@destroy',
		'as'	=> 'unidadmedida.destroy'
	]);

	Route::resource('lote','LoteController');
	Route::get('lote/{id}/destroy',[
		'uses'	=> 'LoteController@destroy',
		'as'	=> 'lote.destroy'
	]);


});

//Esta ruta es llamda por el SCRIPT para pedir informacion de las sub clase
Route::get('/ajax-ObtenerMunicipiosPorEstado/{estado_id}',function($estado_id){
	
	$municipios = DB::table('municipio')->select('*')->where('mun_fk_estado','=',$estado_id)->get();
	
	return Response::json($municipios);
});
