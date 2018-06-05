$(document).ready(function(){
	$('#marca').on('change',function(e){
	//console.log(e);

	var marca_id = e.target.value;

	//ajax
	$.get('/SAI/public/ajax-ObtenerModelosPorMarca/' + marca_id, function(data){

			//succes data
			//console.log(data);
						
			$('#modelo').empty();
			$('#modelo').append('<option value="">Seleccionar modelo</option>');
			$.each(data, function(index,subcatObj){

				$('#modelo').append('<option value="'+subcatObj.id+'">'+subcatObj.mod_modelo+' </option>');
			});
					
		});
	});
});


