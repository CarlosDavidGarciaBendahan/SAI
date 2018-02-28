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

Route::prefix('admin')->group( function(){

	Route::resource('estado','EstadoController');

	//con esta ruta nos ahorramos crear un formulario para poder eliminar y facilitar el diseno...
	Route::get('estado/{id}/destroy',[
		'uses'	=> 'EstadoController@destroy',
		'as'	=> 'estado.destroy'
	]);
});
