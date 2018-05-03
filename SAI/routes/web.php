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



//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		LUGAR
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/lugar/')->group( function(){

	Route::resource('estado','EstadoController');

	//con esta ruta nos ahorramos crear un formulario para poder eliminar y facilitar el diseno...
	///////////////////////////////////////////////////
	////// 		ESTADO
	///////////////////////////////////////////////////
	Route::get('estado/{id}/destroy',[
		'uses'	=> 'EstadoController@destroy',
		'as'	=> 'estado.destroy'
	]);

	///////////////////////////////////////////////////
	////// 		MUNICIPIO
	///////////////////////////////////////////////////
	Route::resource('municipio','MunicipioController');
	Route::get('municipio/{id}/destroy',[
		'uses'	=> 'MunicipioController@destroy',
		'as'	=> 'municipio.destroy'
	]);
	///////////////////////////////////////////////////
	////// 		PARROQUIA
	///////////////////////////////////////////////////
	Route::resource('parroquia','ParroquiaController');
	Route::get('parroquia/{id}/destroy',[
		'uses'	=> 'ParroquiaController@destroy',
		'as'	=> 'parroquia.destroy'
	]);

});

Route::prefix('admin/producto/')->group( function(){
	///////////////////////////////////////////////////
	////// 		TIPO PRODUCTO	
	///////////////////////////////////////////////////
	Route::resource('tipo_producto','Tipo_ProductoController');
	Route::get('tipo_producto/{id}/destroy',[
		'uses'	=> 'Tipo_ProductoController@destroy',
		'as'	=> 'tipo_producto.destroy'
	]);
	///////////////////////////////////////////////////
	//////		MARCA 	
	///////////////////////////////////////////////////
	Route::resource('marca','MarcaController');
	Route::get('marca/{id}/destroy',[
		'uses'	=> 'MarcaController@destroy',
		'as'	=> 'marca.destroy'
	]);
	///////////////////////////////////////////////////
	//////		MODELO 	
	///////////////////////////////////////////////////
	Route::resource('modelo','ModeloController');
	Route::get('modelo/{id}/destroy',[
		'uses'	=> 'modeloController@destroy',
		'as'	=> 'modelo.destroy'
	]);
	///////////////////////////////////////////////////
	//////		UNIDAD DE MEDIDA 	
	///////////////////////////////////////////////////
	Route::resource('unidadmedida','UnidadMedidaController');
	Route::get('unidadmedida/{id}/destroy',[
		'uses'	=> 'UnidadMedidaController@destroy',
		'as'	=> 'unidadmedida.destroy'
	]);
	///////////////////////////////////////////////////
	//////		LOTE 	
	///////////////////////////////////////////////////
	Route::resource('lote','LoteController');
	Route::get('lote/{id}/destroy',[
		'uses'	=> 'LoteController@destroy',
		'as'	=> 'lote.destroy'
	]);
	///////////////////////////////////////////////////
	//////		PRODUCTO COMPUTADOR 	
	///////////////////////////////////////////////////
	Route::resource('producto_computador','Producto_ComputadorController');
	Route::get('producto_computador/{id}/destroy',[
		'uses'	=> 'Producto_ComputadorController@destroy',
		'as'	=> 'producto_computador.destroy'
	]);
		///////////////////////////////////////////////////
		//////		CODIGOPC	
		///////////////////////////////////////////////////
		Route::resource('codigoPC','codigoPCController');
		Route::get('codigoPC/{id}/destroy',[
			'uses'	=> 'codigoPCController@destroy',
			'as'	=> 'codigoPC.destroy'
		]);
		Route::get('codigoPC/{id}/create',[
			'uses'	=> 'codigoPCController@create',
			'as'	=> 'codigoPC.create'
		]);
	///////////////////////////////////////////////////
	//////		PRODUCTO ARTICULO 	
	///////////////////////////////////////////////////
	Route::resource('producto_articulo','Producto_ArticuloController');
	Route::get('producto_articulo/{id}/destroy',[
		'uses'	=> 'Producto_ArticuloController@destroy',
		'as'	=> 'producto_articulo.destroy'
	]);
		///////////////////////////////////////////////////
		//////		CODIGO ARTOCILO	
		///////////////////////////////////////////////////
		Route::resource('codigoArticulo','codigoArticuloController');
		Route::get('codigoArticulo/{id}/destroy',[
			'uses'	=> 'codigoArticuloController@destroy',
			'as'	=> 'codigoArticulo.destroy'
		]);
		Route::get('codigoArticulo/{id}/create',[
			'uses'	=> 'codigoArticuloController@create',
			'as'	=> 'codigoArticulo.create'
		]);
		Route::get('codigoArticulo/{articulo_id}/asignarPC/{pc_id}',[
			'uses'	=> 'codigoArticuloController@asignarPC',
			'as'	=> 'codigoArticulo.asignarPC'
		]);

		Route::get('codigoArticulo/{articulo_id}/quitarPC/{pc_id?}',[
			'uses'	=> 'codigoArticuloController@quitarPC',
			'as'	=> 'codigoArticulo.quitarPC'
		]);


});

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		OFICINA
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/oficina/')->group( function(){
	///////////////////////////////////////////////////
	////// 		OFICINA	
	///////////////////////////////////////////////////
	Route::resource('oficina','OficinaController');
	Route::get('oficina/{id}/destroy',[
		'uses'	=> 'OficinaController@destroy',
		'as'	=> 'oficina.destroy'
	]);
	///////////////////////////////////////////////////
	//////		SECTOR 	
	///////////////////////////////////////////////////
	Route::resource('sector','SectorController');
	Route::get('sector/{id}/destroy',[
		'uses'	=> 'SectorController@destroy',
		'as'	=> 'sector.destroy'
	]);
	///////////////////////////////////////////////////
	//////		CLIENTE NATURAL 	
	///////////////////////////////////////////////////
	Route::resource('cliente_natural','Cliente_NaturalController');
	Route::get('cliente_natural/{id}/destroy',[
		'uses'	=> 'Cliente_NaturalController@destroy',
		'as'	=> 'cliente_natural.destroy'
	]);
	///////////////////////////////////////////////////
	//////		CLIENTE JURIDICO 	
	///////////////////////////////////////////////////
	Route::resource('cliente_juridico','Cliente_JuridicoController');
	Route::get('cliente_juridico/{id}/destroy',[
		'uses'	=> 'Cliente_JuridicoController@destroy',
		'as'	=> 'cliente_juridico.destroy'
	]);
	///////////////////////////////////////////////////
	//////		EMPRESA 	
	///////////////////////////////////////////////////
	Route::resource('empresa','EmpresaController');
	Route::get('empresa/{id}/destroy',[
		'uses'	=> 'EmpresaController@destroy',
		'as'	=> 'empresa.destroy'
	]);
	///////////////////////////////////////////////////
	//////		ROL 	
	///////////////////////////////////////////////////
	Route::resource('rol','RolController');
	Route::get('rol/{id}/destroy',[
		'uses'	=> 'RolController@destroy',
		'as'	=> 'rol.destroy'
	]);
	///////////////////////////////////////////////////
	//////		PERMISO 	
	///////////////////////////////////////////////////
	Route::resource('permiso','PermisoController');
	Route::get('permiso/{id}/destroy',[
		'uses'	=> 'PermisoController@destroy',
		'as'	=> 'permiso.destroy'
	]);
	///////////////////////////////////////////////////
	//////		PERSONAL 	
	///////////////////////////////////////////////////
	Route::resource('personal','PersonalController');
	Route::get('personal/{id}/destroy',[
		'uses'	=> 'PersonalController@destroy',
		'as'	=> 'personal.destroy'
	]);
	///////////////////////////////////////////////////
	//////		USERS 	
	///////////////////////////////////////////////////
	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses'	=> 'UsersController@destroy',
		'as'	=> 'users.destroy'
	]);
	///////////////////////////////////////////////////
	////// 		CORREO
	///////////////////////////////////////////////////
	Route::resource('contacto_correo','Contacto_CorreoController');
	Route::get('contacto_correo/{id}/destroy',[
		'uses'	=> 'Contacto_CorreoController@destroy',
		'as'	=> 'contacto_correo.destroy'
	]);
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - EMPRESA
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/empresa/{empresa_id}',[
					'uses'	=> 'Contacto_CorreoController@editEmpresa',
					'as'	=> 'contacto_correo_empresa.edit'
				]);
				Route::get('contacto_correo/empresa/{empresa_id}',[
					'uses'	=> 'Contacto_CorreoController@createEmpresa',
					'as'	=> 'contacto_correo_empresa.create'
				]);
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - PERSONAL
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/personal/{personal_id}',[
					'uses'	=> 'Contacto_CorreoController@editPersonal',
					'as'	=> 'contacto_correo_personal.edit'
				]);
				Route::get('contacto_correo/personal/{personal_id}',[
					'uses'	=> 'Contacto_CorreoController@createPersonal',
					'as'	=> 'contacto_correo_personal.create'
				]);
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - CLIENTE JURIDICO
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/cliente_juridico/{cliente_juridico_id}',[
					'uses'	=> 'Contacto_CorreoController@editCliente_Juridico',
					'as'	=> 'contacto_correo_cliente_juridico.edit'
				]);
				Route::get('contacto_correo/cliente_juridico/{cliente_juridico_id}',[
					'uses'	=> 'Contacto_CorreoController@createCliente_Juridico',
					'as'	=> 'contacto_correo_cliente_juridico.create'
				]);
				///////////////////////////////////////////////////
				////// 		CORREO - CRUD - CLIENTE NATURAL
				///////////////////////////////////////////////////
				Route::get('contacto_correo/{id}/cliente_natural/{cliente_natural_id}',[
					'uses'	=> 'Contacto_CorreoController@editCliente_Natural',
					'as'	=> 'contacto_correo_cliente_natural.edit'
				]);
				Route::get('contacto_correo/cliente_natural/{cliente_natural_id}',[
					'uses'	=> 'Contacto_CorreoController@createCliente_Natural',
					'as'	=> 'contacto_correo_cliente_natural.create'
				]);
	///////////////////////////////////////////////////
	////// 		TELEFONO
	///////////////////////////////////////////////////
	Route::resource('contacto_telefono','Contacto_TelefonoController');
	Route::get('contacto_telefono/{id}/destroy',[
		'uses'	=> 'Contacto_TelefonoController@destroy',
		'as'	=> 'contacto_telefono.destroy'
	]);
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - EMPRESA
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/empresa/{empresa_id}',[
				'uses'	=> 'Contacto_TelefonoController@editEmpresa',
				'as'	=> 'contacto_telefono_empresa.edit'
			]);
			Route::get('contacto_telefono/empresa/{empresa_id}',[
				'uses'	=> 'Contacto_TelefonoController@createEmpresa',
				'as'	=> 'contacto_telefono_empresa.create'
			]);
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - PERSONAL
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/personal/{personal_id}',[
				'uses'	=> 'Contacto_TelefonoController@editPersonal',
				'as'	=> 'contacto_telefono_personal.edit'
			]);
			Route::get('contacto_telefono/personal/{personal_id}',[
				'uses'	=> 'Contacto_TelefonoController@createPersonal',
				'as'	=> 'contacto_telefono_personal.create'
			]);
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - CLIENTE JURIDICO
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/cliente_juridico/{cliente_juridico_id}',[
				'uses'	=> 'Contacto_TelefonoController@editCliente_Juridico',
				'as'	=> 'contacto_telefono_cliente_juridico.edit'
			]);
			Route::get('contacto_telefono/cliente_juridico/{cliente_juridico_id}',[
				'uses'	=> 'Contacto_TelefonoController@createCliente_Juridico',
				'as'	=> 'contacto_telefono_cliente_juridico.create'
			]);
			///////////////////////////////////////////////////
			////// 		TELEFONO - CRUD - CLIENTE NATURAL
			///////////////////////////////////////////////////
			Route::get('contacto_telefono/{id}/cliente_natural/{cliente_natural_id}',[
				'uses'	=> 'Contacto_TelefonoController@editCliente_Natural',
				'as'	=> 'contacto_telefono_cliente_natural.edit'
			]);
			Route::get('contacto_telefono/cliente_natural/{cliente_natural_id}',[
				'uses'	=> 'Contacto_TelefonoController@createCliente_Natural',
				'as'	=> 'contacto_telefono_cliente_natural.create'
			]);
	///////////////////////////////////////////////////
	////// 		PRESUPUESTO
	///////////////////////////////////////////////////
	Route::resource('presupuesto','PresupuestoController');
	Route::get('presupuesto/{id}/destroy',[
		'uses'	=> 'PresupuestoController@destroy',
		'as'	=> 'presupuesto.destroy'
	]);
	Route::get('presupuesto/{id}/download',[
		'uses'	=> 'PresupuestoController@download',
		'as'	=> 'presupuesto.download'
	]);
	Route::get('presupuesto/{id}/enviarPresupuesto',[
		'uses'	=> 'PresupuestoController@enviarPresupuesto',
		'as'	=> 'presupuesto.enviarPresupuesto'
	]);
	Route::get('presupuesto/{id}/CancelarPresupuesto',[
		'uses'	=> 'PresupuestoController@CancelarPresupuesto',
		'as'	=> 'presupuesto.CancelarPresupuesto'
	]);
});


//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		ADMIN
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/')->group( function(){
	///////////////////////////////////////////////////
	////// 		BANCO
	///////////////////////////////////////////////////
	Route::resource('banco','BancoController');
	Route::get('banco/{id}/destroy',[
		'uses'	=> 'BancoController@destroy',
		'as'	=> 'banco.destroy'
	]);
});

//////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// 		CLIENTE
//////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('admin/cliente/')->group( function(){
	///////////////////////////////////////////////////
	////// 		VENTA
	///////////////////////////////////////////////////
	Route::resource('venta','VentaController');
	Route::get('venta/{id}/destroy',[
		'uses'	=> 'ventaController@destroy',
		'as'	=> 'venta.destroy'
	]);
	Route::get('venta/{id}/eliminarProducto/{producto_id}/{tipo_producto}',[
		'uses'	=> 'ventaController@eliminarProducto',
		'as'	=> 'venta.eliminarProducto'
	]);
	///////////////////////////////////////////////////
	////// 		REGISTRO DE PAGO
	///////////////////////////////////////////////////
	Route::resource('registroPago','registroPagoController');
	Route::get('registroPago/{id}/destroy',[
		'uses'	=> 'registroPagoController@destroy',
		'as'	=> 'registroPago.destroy'
	]);
	Route::get('registroPago/{id}/create',[
		'uses'	=> 'registroPagoController@create',
		'as'	=> 'registroPago.create'
	]);
	Route::get('registroPago/{id}/index',[
		'uses'	=> 'registroPagoController@index',
		'as'	=> 'registroPago.index'
	]);
	///////////////////////////////////////////////////
	////// 		NOTA DE ENTREGA
	///////////////////////////////////////////////////
	Route::resource('notaEntrega','notaEntregaController');
	Route::get('notaEntrega/{id}/destroy',[
		'uses'	=> 'notaEntregaController@destroy',
		'as'	=> 'notaEntrega.destroy'
	]);
	Route::get('notaEntrega/{id}/create',[
		'uses'	=> 'notaEntregaController@create',
		'as'	=> 'notaEntrega.create'
	]);
	Route::get('notaEntrega/{id}/download',[
		'uses'	=> 'notaEntregaController@download',
		'as'	=> 'notaEntrega.download'
	]);
	Route::get('notaEntrega/{id}/enviarNotaEntrega',[
		'uses'	=> 'notaEntregaController@enviarNotaEntrega',
		'as'	=> 'notaEntrega.enviarNotaEntrega'
	]);
	Route::get('notaEntrega/{id}/CancelarnotaEntrega',[
		'uses'	=> 'notaEntregaController@CancelarnotaEntrega',
		'as'	=> 'notaEntrega.CancelarnotaEntrega'
	]);
	///////////////////////////////////////////////////
	////// 		SOLICITUD
	///////////////////////////////////////////////////
	Route::resource('solicitud','solicitudController');
	Route::get('solicitud/{id}/destroy',[
		'uses'	=> 'solicitudController@destroy',
		'as'	=> 'solicitud.destroy'
	]);
	Route::get('solicitud/{id}/create',[
		'uses'	=> 'solicitudController@create',
		'as'	=> 'solicitud.create'
	]);
	/*Route::get('solicitud/{id}/createSolicitud',[
		'uses'	=> 'solicitudController@createSolicitud',
		'as'	=> 'solicitud.createSolicitud'
	]);*/
	Route::get('solicitud/{id}/seleccionarProductos',[
		'uses'	=> 'solicitudController@seleccionarProductos',
		'as'	=> 'solicitud.seleccionarProductos'
	]);
	Route::get('solicitud/{id}/eliminarProducto/{producto_id}/{tipo_producto}',[
		'uses'	=> 'solicitudController@eliminarProducto',
		'as'	=> 'solicitud.eliminarProducto'
	]);
	Route::get('solicitud/{id}/agregarProducto/{producto_id}/{tipo_producto}',[
		'uses'	=> 'solicitudController@agregarProducto',
		'as'	=> 'solicitud.agregarProducto'
	]);
	Route::post('solicitud/storeAgregarProductos',[
		'uses'	=> 'solicitudController@storeAgregarProductos',
		'as'	=> 'solicitud.storeAgregarProductos'
	]);
	Route::get('solicitud/listarNotas/{id}',[
		'uses'	=> 'solicitudController@listarNotas',
		'as'	=> 'solicitud.listarNotas'
	]);
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
});

Route::get('/ajax-ObtenerParroquiasPorMunicipio/{municipio_id}',function($municipio_id){
	
	$parroquias = DB::table('parroquia')->select('*')->where('par_fk_municipio','=',$municipio_id)->get();
	
	return Response::json($parroquias);
});

Route::get('/ajax-ObtenerSectoresPorOficina/{oficina_id}',function($oficina_id){
	
	$sectores = DB::table('sector')->select('*')->where('sec_fk_oficina','=',$oficina_id)->get();

	return Response::json($sectores);
});

Route::get('/ajax-ObtenerModelosPorMarca/{marca_id}',function($marca_id){
	
	$modelos = DB::table('modelo')->select('*')->where('mod_fk_marca','=',$marca_id)->get();

	return Response::json($modelos);
});


Route::get('/ajax-ObtenerDatosEmpresa2/{empresa_id}','EmpresaController@BuscarEmpresa');

Route::get('/ajax-ObtenerDatosclientes_naturales/{cliente_natural_id}','Cliente_NaturalController@BuscarCliente');

Route::get('/ajax-ObtenerDatosclientes_juridicos/{cliente_juridico_id}','Cliente_JuridicoController@BuscarCliente');

Route::get('/ajax-ObtenerDatosProducto_Computador/{computador_id}','Producto_ComputadorController@BuscarComputador');

Route::get('/ajax-ObtenerDatosProducto_Articulo/{Articulo_id}','Producto_ArticuloController@BuscarArticulo');


///////////////////////////////////////////////////
////// 		Rutas para el manejo de los PDF
///////////////////////////////////////////////////

Route::get('PDF-ejemplo/{presupuesto_id}',function($presupuesto_id){
	$pdf = PDF::loadView('vistaPDF',['id'=> $presupuesto_id]);
	//return $pdf->download('presupuesto'.'#'.$presupuesto_id.'.pdf');
	return $pdf->stream('presupuesto'.'#'.$presupuesto_id.'.pdf');
});