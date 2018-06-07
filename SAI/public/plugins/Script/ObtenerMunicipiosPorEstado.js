

$(document).ready(function(){
	$('#estado').on('change',function(e){
		console.log(e);

		var estado_id = e.target.value;

		//ajax
		//$.get('/SAI/public/ajax-ObtenerMunicipiosPorEstado/' + estado_id, function(data){
		$.get('/ajax-ObtenerMunicipiosPorEstado/' + estado_id, function(data){

			//succes data
			console.log(data);
						
			$('#municipio').empty();
			$('#municipio').append('<option value="">Seleccionar un municipio</option>');
			$.each(data, function(index,subcatObj){

				$('#municipio').append('<option value="'+subcatObj.id+'">'+subcatObj.mun_nombre+' </option>');
			});
						
			$('#parroquia').empty();
			$('#parroquia').append('<option value="">Seleccionar una parroquia</option>');
		});
	});
});