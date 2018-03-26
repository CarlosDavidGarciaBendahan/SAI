$(document).ready(function(){
	$('#clientes_juridicos').on('change',function(e){
		console.log(e);
		
		var cliente_juridico = $('#cliente_juridico'); //etique donde voy a pegar el html con los  datos de la cliente_juridico
		var cliente_juridico_id = e.target.value; // el valor value="" que devuelve el selector cliente_juridico
		// html que será insertado en $('cliente_juridico')
		var html =  ""; 

		//ajax
		//ruta que que retornará los datos de la cliente_juridico seleccionada.
		$.get('/ajax-ObtenerDatosclientes_juridicos/' + cliente_juridico_id, function(data){

			console.log(data);
			
			cliente_juridico.empty();
				html =  ""+
					"<label  class='col-sm'>RIF</label>"+
					"<input  class='form-control col-sm-1' type='text' name='cli_jur_identificador'  value='"+data.cli_jur_identificador+"'>"+
					"<input  class='form-control col-sm-11' type='text' name='cli_jur_rif'  value='"+data.cli_jur_rif+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+data.cli_jur_direccion+
					", Par. "+data.parroquia.par_nombre+", Mun. "+data.parroquia.municipio.mun_nombre+
					", Edo. "+data.parroquia.municipio.estado.est_nombre+"'>"+
					"" 
				cliente_juridico.append(html);
		});
	});
});