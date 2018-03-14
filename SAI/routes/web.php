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

Route::prefix('admin/oficina/')->group( function(){

	Route::resource('oficina','OficinaController');
	Route::get('oficina/{id}/destroy',[
		'uses'	=> 'OficinaController@destroy',
		'as'	=> 'oficina.destroy'
	]);

	Route::resource('sector','SectorController');
	Route::get('sector/{id}/destroy',[
		'uses'	=> 'SectorController@destroy',
		'as'	=> 'sector.destroy'
	]);

	Route::resource('cliente_natural','Cliente_NaturalController');
	Route::get('cliente_natural/{id}/destroy',[
		'uses'	=> 'Cliente_NaturalController@destroy',
		'as'	=> 'cliente_natural.destroy'
	]);

	Route::resource('cliente_juridico','Cliente_JuridicoController');
	Route::get('cliente_juridico/{id}/destroy',[
		'uses'	=> 'Cliente_JuridicoController@destroy',
		'as'	=> 'cliente_juridico.destroy'
	]);

	Route::resource('empresa','EmpresaController');
	Route::get('empresa/{id}/destroy',[
		'uses'	=> 'EmpresaController@destroy',
		'as'	=> 'empresa.destroy'
	]);

	Route::resource('rol','RolController');
	Route::get('rol/{id}/destroy',[
		'uses'	=> 'RolController@destroy',
		'as'	=> 'rol.destroy'
	]);

	Route::resource('permiso','PermisoController');
	Route::get('permiso/{id}/destroy',[
		'uses'	=> 'PermisoController@destroy',
		'as'	=> 'permiso.destroy'
	]);

	Route::resource('personal','PersonalController');
	Route::get('personal/{id}/destroy',[
		'uses'	=> 'PersonalController@destroy',
		'as'	=> 'personal.destroy'
	]);

	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses'	=> 'UsersController@destroy',
		'as'	=> 'users.destroy'
	]);
});

Route::prefix('admin/')->group( function(){

	Route::resource('banco','BancoController');
	Route::get('banco/{id}/destroy',[
		'uses'	=> 'BancoController@destroy',
		'as'	=> 'banco.destroy'
	]);
});
//Esta ruta es llamda por el SCRIPT para pedir informacion de las sub clase
Route::get('/ajax-ObtenerMunicipiosPorEstado/{estado_id}',function($estado_id){
	
	$municipios = DB::table('municipio')->select('*')->where('mun_fk_estado','=',$estado_id)->get();
	
	return Response::json($municipios);
});

Route::get('/ajax-ObtenerParroquiasPorMunicipio/{municipio_id}',function($municipio_id){
	
	$parroquias = DB::table('parroquia')->select('*')->where('par_fk_municipio','=',$municipio_id)->get();
	
	return Response::json($parroquias);
});
