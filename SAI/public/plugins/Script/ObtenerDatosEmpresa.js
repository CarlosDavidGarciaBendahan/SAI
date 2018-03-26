$(document).ready(function(){
	$('#empresas').on('change',function(e){
		console.log(e);
		
		var empresa = $('#empresa'); //etique donde voy a pegar el html con los  datos de la empresa
		var empresa_id = e.target.value; // el valor value="" que devuelve el selector empresas
		// html que será insertado en $('empresa')
		var html =  ""; 

		//ajax
		//ruta que que retornará los datos de la empresa seleccionada.
		$.get('/ajax-ObtenerDatosEmpresa/' + empresa_id, function(data){

			//succes data
			//var emp = new App\Empresa();
			
			console.log(data);

			html =  ""+
						"<label  >Nombre Empresa </label>"+
						"<input  class='form-control' type='text' id='' name='emp_nombre'  value='"+data.id+"'>"+
					"" 
			
			empresa.empty();

			$.each(data, function(index,emp){

				//$('#municipio').append('<option value="'+subcatObj.id+'">'+subcatObj.mun_nombre+' </option>');
				html =  ""+
					//"<label  class='col-sm'>$empresa->emp_nombre</label>"+
					"<label  class='col-sm'>RIF</label>"+
					"<input  class='form-control col-sm-1' type='text' name='emp_identificador'  value='"+emp.emp_identificador+"'>"+
					"<input  class='form-control col-sm-11' type='text' name='emp_rif'  value='"+emp.emp_rif+"'>"+

					"<label  class='col-sm'>Dirección</label>"+
					"<input  class='form-control' type='text' name='emp_direccion'  value='"+emp.emp_direccion+"'>"+
					"" 
				empresa.append(html);
			});
			//empresa.append(html);
			/*$('#municipio').empty();
			$('#municipio').append('<option value="">Seleccionar un municipio</option>');
			$.each(data, function(index,subcatObj){

				$('#municipio').append('<option value="'+subcatObj.id+'">'+subcatObj.mun_nombre+' </option>');
			});
						
			$('#parroquia').empty();
			$('#parroquia').append('<option value="">Seleccionar una parroquia</option>');*/
		});
	});
});