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

/*Route::get('/', function () {
    return view('admin.login.login');
});*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('inicio');//->middleware('guest');

Route::get('/admin/home', function () {
    return view('admin.home');
})->name('admin.home')->middleware('auth');

/*Route::get('auth/login',[
			'uses'	=> 	'Auth\LoginController',
			'as'	=>	'auth.login']); //'Auth\AuthController@getLogin');
Route::post('auth/login',[
			'uses'	=> 	'Auth\LoginController',
			'as'	=>	'auth.login']); //'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');*/


/*Route::group(['prefix' => 'Lugar'], function(){

	Route::get('Estado/{id}',[
		'uses'	=>	'EstadoController@view',
		'as'	=>	'EstadoView'
	]);

});*/

/*Route::group(['prefix' => 'admin'], function(){

	Route::resource('estado','EstadoController');//1er para: Nombre para el grupo que creara  2do para: el controlador que tomara

});*/



//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		LUGAR
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/lugar/')->group( function(){

	Route::resource('estado','EstadoController')->middleware('auth');

	//con esta ruta nos ahorramos crear un formulario para poder eliminar y facilitar el diseno...
	///////////////////////////////////////////////////
	////// 		ESTADO
	///////////////////////////////////////////////////
	Route::get('estado/{id}/destroy',[
		'uses'	=> 'EstadoController@destroy',
		'as'	=> 'estado.destroy'
	])->middleware('auth');

	///////////////////////////////////////////////////
	////// 		MUNICIPIO
	///////////////////////////////////////////////////
	Route::resource('municipio','MunicipioController')->middleware('auth');
	Route::get('municipio/{id}/destroy',[
		'uses'	=> 'MunicipioController@destroy',
		'as'	=> 'municipio.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		PARROQUIA
	///////////////////////////////////////////////////
	Route::resource('parroquia','ParroquiaController')->middleware('auth');
	Route::get('parroquia/{id}/destroy',[
		'uses'	=> 'ParroquiaController@destroy',
		'as'	=> 'parroquia.destroy'
	])->middleware('auth');

});

Route::prefix('admin/producto/')->group( function(){
	///////////////////////////////////////////////////
	////// 		TIPO PRODUCTO	
	///////////////////////////////////////////////////
	Route::resource('tipo_producto','Tipo_ProductoController')->middleware('auth');
	Route::get('tipo_producto/{id}/destroy',[
		'uses'	=> 'Tipo_ProductoController@destroy',
		'as'	=> 'tipo_producto.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		MARCA 	
	///////////////////////////////////////////////////
	Route::resource('marca','MarcaController')->middleware('auth');
	Route::get('marca/{id}/destroy',[
		'uses'	=> 'MarcaController@destroy',
		'as'	=> 'marca.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		MODELO 	
	///////////////////////////////////////////////////
	Route::resource('modelo','ModeloController')->middleware('auth');
	Route::get('modelo/{id}/destroy',[
		'uses'	=> 'modeloController@destroy',
		'as'	=> 'modelo.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		UNIDAD DE MEDIDA 	
	///////////////////////////////////////////////////
	Route::resource('unidadmedida','UnidadMedidaController')->middleware('auth');
	Route::get('unidadmedida/{id}/destroy',[
		'uses'	=> 'UnidadMedidaController@destroy',
		'as'	=> 'unidadmedida.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		LOTE 	
	///////////////////////////////////////////////////
	Route::resource('lote','LoteController')->middleware('auth');
	Route::get('lote/{id}/destroy',[
		'uses'	=> 'LoteController@destroy',
		'as'	=> 'lote.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		PRODUCTO COMPUTADOR 	
	///////////////////////////////////////////////////
	Route::resource('producto_computador','Producto_ComputadorController')->middleware('auth');
	Route::get('producto_computador/{id}/destroy',[
		'uses'	=> 'Producto_ComputadorController@destroy',
		'as'	=> 'producto_computador.destroy'
	])->middleware('auth');
		///////////////////////////////////////////////////
		//////		CODIGOPC	
		///////////////////////////////////////////////////
		Route::resource('codigoPC','codigoPCController')->middleware('auth');
		Route::get('codigoPC/{id}/destroy',[
			'uses'	=> 'codigoPCController@destroy',
			'as'	=> 'codigoPC.destroy'
		])->middleware('auth');
		Route::get('codigoPC/{id}/create',[
			'uses'	=> 'codigoPCController@create',
			'as'	=> 'codigoPC.create'
		])->middleware('auth');
	///////////////////////////////////////////////////
	//////		PRODUCTO ARTICULO 	
	///////////////////////////////////////////////////
	Route::resource('producto_articulo','Producto_ArticuloController')->middleware('auth');
	Route::get('producto_articulo/{id}/destroy',[
		'uses'	=> 'Producto_ArticuloController@destroy',
		'as'	=> 'producto_articulo.destroy'
	])->middleware('auth');
		///////////////////////////////////////////////////
		//////		CODIGO ARTOCILO	
		///////////////////////////////////////////////////
		Route::resource('codigoArticulo','codigoArticuloController')->middleware('auth');
		Route::get('codigoArticulo/{id}/destroy',[
			'uses'	=> 'codigoArticuloController@destroy',
			'as'	=> 'codigoArticulo.destroy'
		])->middleware('auth');
		Route::get('codigoArticulo/{id}/create',[
			'uses'	=> 'codigoArticuloController@create',
			'as'	=> 'codigoArticulo.create'
		])->middleware('auth');
		Route::get('codigoArticulo/{articulo_id}/asignarPC/{pc_id}',[
			'uses'	=> 'codigoArticuloController@asignarPC',
			'as'	=> 'codigoArticulo.asignarPC'
		])->middleware('auth');

		Route::get('codigoArticulo/{articulo_id}/quitarPC/{pc_id?}',[
			'uses'	=> 'codigoArticuloController@quitarPC',
			'as'	=> 'codigoArticulo.quitarPC'
		])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		TIPO PRODUCTO	
	///////////////////////////////////////////////////
	//Route::resource('producto_computador','producto_computadorController')->middleware('auth');
	Route::get('catalogo',[
		'uses'	=> 'producto_computadorController@catalogo',
		'as'	=> 'catalogo'
	])->middleware('auth');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		OFICINA
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/oficina/')->group( function(){
	///////////////////////////////////////////////////
	////// 		OFICINA	
	///////////////////////////////////////////////////
	Route::resource('oficina','OficinaController')->middleware('auth');
	Route::get('oficina/{id}/destroy',[
		'uses'	=> 'OficinaController@destroy',
		'as'	=> 'oficina.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		SECTOR 	
	///////////////////////////////////////////////////
	Route::resource('sector','SectorController')->middleware('auth');
	Route::get('sector/{id}/destroy',[
		'uses'	=> 'SectorController@destroy',
		'as'	=> 'sector.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		CLIENTE NATURAL 	
	///////////////////////////////////////////////////
	Route::resource('cliente_natural','Cliente_NaturalController')->middleware('auth');
	Route::get('cliente_natural/{id}/destroy',[
		'uses'	=> 'Cliente_NaturalController@destroy',
		'as'	=> 'cliente_natural.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		CLIENTE JURIDICO 	
	///////////////////////////////////////////////////
	Route::resource('cliente_juridico','Cliente_JuridicoController')->middleware('auth');
	Route::get('cliente_juridico/{id}/destroy',[
		'uses'	=> 'Cliente_JuridicoController@destroy',
		'as'	=> 'cliente_juridico.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		EMPRESA 	
	///////////////////////////////////////////////////
	Route::resource('empresa','EmpresaController')->middleware('auth');
	Route::get('empresa/{id}/destroy',[
		'uses'	=> 'EmpresaController@destroy',
		'as'	=> 'empresa.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		ROL 	
	///////////////////////////////////////////////////
	Route::resource('rol','RolController')->middleware('auth');
	Route::get('rol/{id}/destroy',[
		'uses'	=> 'RolController@destroy',
		'as'	=> 'rol.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		PERMISO 	
	///////////////////////////////////////////////////
	Route::resource('permiso','PermisoController')->middleware('auth');
	Route::get('permiso/{id}/destroy',[
		'uses'	=> 'PermisoController@destroy',
		'as'	=> 'permiso.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		PERSONAL 	
	///////////////////////////////////////////////////
	Route::resource('personal','PersonalController')->middleware('auth');
	Route::get('personal/{id}/destroy',[
		'uses'	=> 'PersonalController@destroy',
		'as'	=> 'personal.destroy'
	])->middleware('auth');
	///////////////////////////////////////////////////
	//////		USERS 	
	///////////////////////////////////////////////////
	Route::resource('users','UsersController')->middleware('auth');
	Route::get('users/{id}/destroy',[
		'uses'	=> 'UsersController@destroy',
		'as'	=> 'users.destroy'
	])->middleware('auth');
	Route::get('users/{id}/destroy',[
		'uses'	=> 'UsersController@destroy',
		'as'	=> 'users.destroy'
	])->middleware('auth');
	Route::get('users/{id}/EnviarClave',[
		'uses'	=> 'UsersController@EnviarClave',
		'as'	=> 'users.EnviarClave'
	])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		CORREO
	///////////////////////////////////////////////////
	Route::resource('contacto_correo','Contacto_CorreoController')->middleware('auth');
	Route::get('contacto_correo/{id}/destroy',[
		'uses'	=> 'Contacto_CorreoController@destroy',
		'as'	=> 'contacto_correo.destroy'
	])->middleware('auth');
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - EMPRESA
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/empresa/{empresa_id}',[
					'uses'	=> 'Contacto_CorreoController@editEmpresa',
					'as'	=> 'contacto_correo_empresa.edit'
				])->middleware('auth');
				Route::get('contacto_correo/empresa/{empresa_id}',[
					'uses'	=> 'Contacto_CorreoController@createEmpresa',
					'as'	=> 'contacto_correo_empresa.create'
				])->middleware('auth');
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - PERSONAL
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/personal/{personal_id}',[
					'uses'	=> 'Contacto_CorreoController@editPersonal',
					'as'	=> 'contacto_correo_personal.edit'
				])->middleware('auth');
				Route::get('contacto_correo/personal/{personal_id}',[
					'uses'	=> 'Contacto_CorreoController@createPersonal',
					'as'	=> 'contacto_correo_personal.create'
				])->middleware('auth');
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - CLIENTE JURIDICO
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/cliente_juridico/{cliente_juridico_id}',[
					'uses'	=> 'Contacto_CorreoController@editCliente_Juridico',
					'as'	=> 'contacto_correo_cliente_juridico.edit'
				])->middleware('auth');
				Route::get('contacto_correo/cliente_juridico/{cliente_juridico_id}',[
					'uses'	=> 'Contacto_CorreoController@createCliente_Juridico',
					'as'	=> 'contacto_correo_cliente_juridico.create'
				])->middleware('auth');
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - CLIENTE NATURAL
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/cliente_natural/{cliente_natural_id}',[
					'uses'	=> 'Contacto_CorreoController@editCliente_Natural',
					'as'	=> 'contacto_correo_cliente_natural.edit'
				])->middleware('auth');
				Route::get('contacto_correo/cliente_natural/{cliente_natural_id}',[
					'uses'	=> 'Contacto_CorreoController@createCliente_Natural',
					'as'	=> 'contacto_correo_cliente_natural.create'
				])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		TELEFONO
	///////////////////////////////////////////////////
	Route::resource('contacto_telefono','Contacto_TelefonoController')->middleware('auth');
	Route::get('contacto_telefono/{id}/destroy',[
		'uses'	=> 'Contacto_TelefonoController@destroy',
		'as'	=> 'contacto_telefono.destroy'
	])->middleware('auth');
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - EMPRESA
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/empresa/{empresa_id}',[
				'uses'	=> 'Contacto_TelefonoController@editEmpresa',
				'as'	=> 'contacto_telefono_empresa.edit'
			])->middleware('auth');
			Route::get('contacto_telefono/empresa/{empresa_id}',[
				'uses'	=> 'Contacto_TelefonoController@createEmpresa',
				'as'	=> 'contacto_telefono_empresa.create'
			])->middleware('auth');
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - PERSONAL
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/personal/{personal_id}',[
				'uses'	=> 'Contacto_TelefonoController@editPersonal',
				'as'	=> 'contacto_telefono_personal.edit'
			])->middleware('auth');
			Route::get('contacto_telefono/personal/{personal_id}',[
				'uses'	=> 'Contacto_TelefonoController@createPersonal',
				'as'	=> 'contacto_telefono_personal.create'
			])->middleware('auth');
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - CLIENTE JURIDICO
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/cliente_juridico/{cliente_juridico_id}',[
				'uses'	=> 'Contacto_TelefonoController@editCliente_Juridico',
				'as'	=> 'contacto_telefono_cliente_juridico.edit'
			])->middleware('auth');
			Route::get('contacto_telefono/cliente_juridico/{cliente_juridico_id}',[
				'uses'	=> 'Contacto_TelefonoController@createCliente_Juridico',
				'as'	=> 'contacto_telefono_cliente_juridico.create'
			])->middleware('auth');
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - CLIENTE NATURAL
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/cliente_natural/{cliente_natural_id}',[
				'uses'	=> 'Contacto_TelefonoController@editCliente_Natural',
				'as'	=> 'contacto_telefono_cliente_natural.edit'
			])->middleware('auth');
			Route::get('contacto_telefono/cliente_natural/{cliente_natural_id}',[
				'uses'	=> 'Contacto_TelefonoController@createCliente_Natural',
				'as'	=> 'contacto_telefono_cliente_natural.create'
			])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		PRESUPUESTO
	///////////////////////////////////////////////////
	Route::resource('presupuesto','PresupuestoController')->middleware('auth');
	Route::get('presupuesto/{id}/destroy',[
		'uses'	=> 'PresupuestoController@destroy',
		'as'	=> 'presupuesto.destroy'
	])->middleware('auth');
	Route::get('presupuesto/{id}/download',[
		'uses'	=> 'PresupuestoController@download',
		'as'	=> 'presupuesto.download'
	])->middleware('auth');
	Route::get('presupuesto/{id}/enviarPresupuesto',[
		'uses'	=> 'PresupuestoController@enviarPresupuesto',
		'as'	=> 'presupuesto.enviarPresupuesto'
	])->middleware('auth');
	Route::get('presupuesto/{id}/CancelarPresupuesto',[
		'uses'	=> 'PresupuestoController@CancelarPresupuesto',
		'as'	=> 'presupuesto.CancelarPresupuesto'
	])->middleware('auth');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		ADMIN
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/')->group( function(){
	///////////////////////////////////////////////////
	////// 		BANCO
	///////////////////////////////////////////////////
	Route::resource('banco','BancoController')->middleware('auth');
	Route::get('banco/{id}/destroy',[
		'uses'	=> 'BancoController@destroy',
		'as'	=> 'banco.destroy'
	])->middleware('auth');


});

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		CLIENTE
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/cliente/')->group( function(){
	///////////////////////////////////////////////////
	////// 		VENTA
	///////////////////////////////////////////////////
	Route::resource('venta','VentaController')->middleware('auth');
	Route::get('venta/{id}/destroy',[
		'uses'	=> 'ventaController@destroy',
		'as'	=> 'venta.destroy'
	])->middleware('auth');
	Route::get('venta/{id}/eliminarProducto/{producto_id}/{tipo_producto}',[
		'uses'	=> 'ventaController@eliminarProducto',
		'as'	=> 'venta.eliminarProducto'
	])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		REGISTRO DE PAGO
	///////////////////////////////////////////////////
	Route::resource('registroPago','registroPagoController')->middleware('auth');
	Route::get('registroPago/{id}/destroy',[
		'uses'	=> 'registroPagoController@destroy',
		'as'	=> 'registroPago.destroy'
	])->middleware('auth');
	Route::get('registroPago/{id}/create',[
		'uses'	=> 'registroPagoController@create',
		'as'	=> 'registroPago.create'
	])->middleware('auth');
	Route::get('registroPago/{id}/index',[
		'uses'	=> 'registroPagoController@index',
		'as'	=> 'registroPago.index'
	])->middleware('auth');
	Route::get('registroPago/listarRegistroPago/{x?}',[//NO ENTIENDO PORQUE AJURO DEBO LLAMAR A LA RUTA CON UN ARGUMENTO, SI NO, ME MUESTRA UNA PAGINA EN BLANDO, PREGUNTAR!!!
		'uses'	=> 'registroPagoController@listarRegistroPago',
		'as'	=> 'registroPago.listarRegistroPago'
	])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		NOTA DE ENTREGA
	///////////////////////////////////////////////////
	Route::resource('notaEntrega','notaEntregaController')->middleware('auth');
	Route::get('notaEntrega/{id}/destroy',[
		'uses'	=> 'notaEntregaController@destroy',
		'as'	=> 'notaEntrega.destroy'
	])->middleware('auth');
	Route::get('notaEntrega/{id}/create',[
		'uses'	=> 'notaEntregaController@create',
		'as'	=> 'notaEntrega.create'
	])->middleware('auth');
	Route::get('notaEntrega/{id}/download',[
		'uses'	=> 'notaEntregaController@download',
		'as'	=> 'notaEntrega.download'
	])->middleware('auth');
	Route::get('notaEntrega/{id}/enviarNotaEntrega',[
		'uses'	=> 'notaEntregaController@enviarNotaEntrega',
		'as'	=> 'notaEntrega.enviarNotaEntrega'
	])->middleware('auth');
	Route::get('notaEntrega/{id}/CancelarnotaEntrega',[
		'uses'	=> 'notaEntregaController@CancelarnotaEntrega',
		'as'	=> 'notaEntrega.CancelarnotaEntrega'
	])->middleware('auth');
	///////////////////////////////////////////////////
	////// 		SOLICITUD
	///////////////////////////////////////////////////
	Route::resource('solicitud','solicitudController')->middleware('auth');
	Route::get('solicitud/{id}/destroy',[
		'uses'	=> 'solicitudController@destroy',
		'as'	=> 'solicitud.destroy'
	])->middleware('auth');
	Route::get('solicitud/{id}/create',[
		'uses'	=> 'solicitudController@create',
		'as'	=> 'solicitud.create'
	])->middleware('auth');
	/*Route::get('solicitud/{id}/createSolicitud',[
		'uses'	=> 'solicitudController@createSolicitud',
		'as'	=> 'solicitud.createSolicitud'
	])->middleware('auth');*/
	Route::get('solicitud/{id}/seleccionarProductos',[
		'uses'	=> 'solicitudController@seleccionarProductos',
		'as'	=> 'solicitud.seleccionarProductos'
	])->middleware('auth');
	Route::get('solicitud/{id}/eliminarProducto/{producto_id}/{tipo_producto}/{editar?}',[
		'uses'	=> 'solicitudController@eliminarProducto',
		'as'	=> 'solicitud.eliminarProducto'
	])->middleware('auth');
	Route::get('solicitud/{id}/agregarProducto/{producto_id}/{tipo_producto}/{editar?}',[
		'uses'	=> 'solicitudController@agregarProducto',
		'as'	=> 'solicitud.agregarProducto'
	])->middleware('auth');
	Route::post('solicitud/storeAgregarProductos',[
		'uses'	=> 'solicitudController@storeAgregarProductos',
		'as'	=> 'solicitud.storeAgregarProductos'
	])->middleware('auth');
	Route::get('solicitud/listarNotas/{id}',[
		'uses'	=> 'solicitudController@listarNotas',
		'as'	=> 'solicitud.listarNotas'
	])->middleware('auth');
	Route::get('solicitud/{id}/eliminarProductoCambio/{producto_id}/{tipo_producto}/{editar?}',[
		'uses'	=> 'solicitudController@eliminarProductoCambio',
		'as'	=> 'solicitud.eliminarProductoCambio'
	])->middleware('auth');
	Route::get('solicitud/{id}/agregarProductoCambio/{producto_id}/{tipo_producto}/{editar?}',[
		'uses'	=> 'solicitudController@agregarProductoCambio',
		'as'	=> 'solicitud.agregarProductoCambio'
	])->middleware('auth');
	Route::get('solicitud/elegirProductosACambiar/{id}',[
		'uses'	=> 'solicitudController@elegirProductosACambiar',
		'as'	=> 'solicitud.elegirProductosACambiar'
	])->middleware('auth');
});


//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		SCRIPTS
//////////////////////////////////////////////////////////////////////////////////////////////////////
//Esta ruta es llamda por el SCRIPT para pedir informacion de las sub clase
///////////////////////////////////////////////////
////// 		Rutas para el uso de los scrips para busqueda de información de los objetos
///////////////////////////////////////////////////
Route::get('/ajax-ObtenerMunicipiosPorEstado/{estado_id}',function($estado_id){
	
	$municipios = DB::table('municipio')->select('*')->where('mun_fk_estado','=',$estado_id)->get();
	
	return Response::json($municipios);
})->middleware('auth');

Route::get('/ajax-ObtenerParroquiasPorMunicipio/{municipio_id}',function($municipio_id){
	
	$parroquias = DB::table('parroquia')->select('*')->where('par_fk_municipio','=',$municipio_id)->get();
	
	return Response::json($parroquias);
})->middleware('auth');

Route::get('/ajax-ObtenerSectoresPorOficina/{oficina_id}',function($oficina_id){
	
	$sectores = DB::table('sector')->select('*')->where('sec_fk_oficina','=',$oficina_id)->get();

	return Response::json($sectores);
})->middleware('auth');

Route::get('/ajax-ObtenerModelosPorMarca/{marca_id}',function($marca_id){
	
	$modelos = DB::table('modelo')->select('*')->where('mod_fk_marca','=',$marca_id)->get();

	return Response::json($modelos);
})->middleware('auth');


Route::get('/ajax-ObtenerDatosEmpresa2/{empresa_id}','EmpresaController@BuscarEmpresa')->middleware('auth');

Route::get('/ajax-ObtenerDatosclientes_naturales/{cliente_natural_id}','Cliente_NaturalController@BuscarCliente')->middleware('auth');

Route::get('/ajax-ObtenerDatosclientes_juridicos/{cliente_juridico_id}','Cliente_JuridicoController@BuscarCliente')->middleware('auth');

Route::get('/ajax-ObtenerDatosProducto_Computador/{computador_id}','Producto_ComputadorController@BuscarComputador')->middleware('auth');

Route::get('/ajax-ObtenerDatosProducto_Articulo/{Articulo_id}','Producto_ArticuloController@BuscarArticulo')->middleware('auth');


///////////////////////////////////////////////////
////// 		Rutas para el manejo de los PDF
///////////////////////////////////////////////////

Route::get('PDF-ejemplo/{presupuesto_id}',function($presupuesto_id){
	$pdf = PDF::loadView('vistaPDF',['id'=> $presupuesto_id]);
	//return $pdf->download('presupuesto'.'#'.$presupuesto_id.'.pdf');
	return $pdf->stream('presupuesto'.'#'.$presupuesto_id.'.pdf');
})->middleware('auth');




//CREADO POR EL COMANDO MAK":AUTH

//para buscar todas las rutas que me crea Auth::routes() hacemos los siguientes pasos en sublime
// 1- ctrl+p 
// 2- escribimos: illuminate\Router.php
// 3- crtl+p
// 4- escribimos @auth para ubicar al metodo
// 5- copiamos las rutas 
//Auth::routes(); 

// Authentication Routes...
        /*Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Registration Routes...
        //Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        //Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('/home', 'HomeController@index')->name('home');*/
//FIN  CREADO POR EL COMANDO MAK":AUTH

//ruta para login
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('reset', 'UsersController@reset')->name('reset')->middleware('guest');
Route::post('resetClave', 'UsersController@resetClave')->name('resetClave')->middleware('guest');
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');