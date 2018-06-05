$(document).ready(function(){
	$('#oficina').on('change',function(e){
	//console.log(e);

	var oficina_id = e.target.value;

	//ajax
	$.get('/SAI/public/ajax-ObtenerSectoresPorOficina/' + oficina_id, function(data){

			//succes data
			//console.log(data);
						
			$('#sector').empty();
			$('#sector').append('<option value="">Seleccionar sector</option>');
			$.each(data, function(index,subcatObj){

				$('#sector').append('<option value="'+subcatObj.id+'">'+subcatObj.sec_sector+' </option>');
			});
					
		});
	});
});




