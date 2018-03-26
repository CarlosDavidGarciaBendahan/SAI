$(document).ready(function(){
	$('#empresas').on('change',function(e){
		console.log(e);
		
		var empresa = $('#empresa'); //etique donde voy a pegar el html con los  datos de la empresa
		var empresa_id = e.target.value; // el valor value="" que devuelve el selector empresas
		// html que será insertado en $('empresa')
		var html =  ""; 

		//ajax
		//ruta que que retornará los datos de la empresa seleccionada.
		$.get('/ajax-ObtenerDatosEmpresa2/' + empresa_id, function(data){

			console.log(data);
			
			empresa.empty();
				html =  ""+
					"<label  class='col-sm'>RIF</label>"+
					"<input  class='form-control col-sm-1' type='text' name='emp_identificador'  value='"+data.emp_identificador+"'>"+
					"<input  class='form-control col-sm-11' type='text' name='emp_rif'  value='"+data.emp_rif+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+data.emp_direccion+
					", Par. "+data.parroquia.par_nombre+", Mun. "+data.parroquia.municipio.mun_nombre+
					", Edo. "+data.parroquia.municipio.estado.est_nombre+"'>"+
					"" 
				empresa.append(html);
		});
	});
});