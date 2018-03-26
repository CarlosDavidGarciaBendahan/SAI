$(document).ready(function(){
	$('#clientes_naturales').on('change',function(e){
		console.log(e);
		
		var cliente_natural = $('#cliente_natural'); //etique donde voy a pegar el html con los  datos de la cliente_natural
		var cliente_natural_id = e.target.value; // el valor value="" que devuelve el selector cliente_natural
		// html que será insertado en $('cliente_natural')
		var html =  ""; 

		//ajax
		//ruta que que retornará los datos de la cliente_natural seleccionada.
		$.get('/ajax-ObtenerDatosclientes_naturales/' + cliente_natural_id, function(data){

			console.log(data);
			
			cliente_natural.empty();
				html =  ""+
					"<label  class='col-sm'>RIF</label>"+
					"<input  class='form-control col-sm-1' type='text' name='cli_nat_identificador'  value='"+data.cli_nat_identificador+"'>"+
					"<input  class='form-control col-sm-11' type='text' name='cli_nat_cedula'  value='"+data.cli_nat_cedula+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+data.cli_nat_direccion+
					", Par. "+data.parroquia.par_nombre+", Mun. "+data.parroquia.municipio.mun_nombre+
					", Edo. "+data.parroquia.municipio.estado.est_nombre+"'>"+
					"" 
				cliente_natural.append(html);
		});
	});
});