$('#estado').on('change',function(e){
	console.log(e);

	var estado_id = e.target.value;

	//ajax
	$.get('/ajax-ObtenerMunicipiosPorEstado/' + estado_id, function(data){

		//succes data
		console.log(data);
					
		$('#municipio').empty();
		$.each(data, function(index,subcatObj){

			$('#municipio').append('<option value="'+subcatObj.id+'">'+subcatObj.mun_nombre+' </option>');
		});
					
	});
});