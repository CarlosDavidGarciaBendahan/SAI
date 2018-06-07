$(document).ready(function(){
	$('#select-computadoras').on('change',function(e){
		console.log(e);
		
		//var cliente_natural = $('#cliente_natural'); //etique donde voy a pegar el html con los  datos de la cliente_natural
		var producto_computador_id = e.target.value; // el valor value="" que devuelve el selector cliente_natural
		// html que será insertado en $('cliente_natural')
		//var html =  ""; 
		var computadoras = $('#presupuesto-computador');
		var cantidad;
		//ajax
		//ruta que que retornará los datos de la cliente_natural seleccionada.
		//$.get('/SAI/public/ajax-ObtenerDatosProducto_Computador/' + producto_computador_id, function(data){
		$.get('/ajax-ObtenerDatosProducto_Computador/' + producto_computador_id, function(data){

			console.log(data);
			cantidad =prompt('Ingrese la cantidad de producto:','');
			html =  "<div class='form-group computadores'>"+
					""+
					"<input  class='form-control col-sm-1' type='text' name='computador_id[]'  value='"+data.id+"'>"+
					"<input  class='form-control col-sm-3' type='text' name='tipo_producto'  value='"+data.tipo_producto.tip_tipo+
					", "+data.pro_com_descripcion+"'>"+
					"<input  class='form-control col-sm-2' type='text' name='codigo'  value='"+data.pro_com_codigo+"'>"+
					//"<input  class='form-control col-sm-2' type='text' name='descripcion'  value='"+data.pro_com_descripcion+"'>"+
					"<input  class='form-control col-sm-1' type='text' name='precio'  value='"+data.pro_com_precio+"'>"+
					"<input  class='form-control col-sm-1' type='text' name='moneda'  value='"+data.pro_com_moneda+"'>"+
					"<input  class='form-control col-sm-1' type='text' name='cantidad_computador[]'  value='"+cantidad+"'>"+
					"<input  class='form-control col-sm-2' type='text' name='total_computador[]'  value='"+data.pro_com_precio * cantidad+"'>"+
					" <a href='' class='remove btn btn-danger col-sm-1'> <span class='class glyphicon glyphicon-remove-circle'></span></a>" +
					/*"<input  class='form-control col-sm-11' type='text' name='cli_nat_cedula'  value='"+data.cli_nat_cedula+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+data.cli_nat_direccion+
					", Par. "+data.parroquia.par_nombre+", Mun. "+data.parroquia.municipio.mun_nombre+
					", Edo. "+data.parroquia.municipio.estado.est_nombre+"'>"+*/
					"</div>" ;
		
					$(computadoras).append(html);
			/*cliente_natural.empty();
				html =  ""+
					"<label  class='col-sm'>RIF</label>"+
					"<input  class='form-control col-sm-1' type='text' name='cli_nat_identificador'  value='"+data.cli_nat_identificador+"'>"+
					"<input  class='form-control col-sm-11' type='text' name='cli_nat_cedula'  value='"+data.cli_nat_cedula+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+data.cli_nat_direccion+
					", Par. "+data.parroquia.par_nombre+", Mun. "+data.parroquia.municipio.mun_nombre+
					", Edo. "+data.parroquia.municipio.estado.est_nombre+"'>"+
					"" 
				cliente_natural.append(html);*/
		});
	});
	$('.presupuesto-computador').on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				
	});

	$('.computadores').on('click','.cantidad',function(event){
				event.preventDefault();
				console.log(event);
	});


});