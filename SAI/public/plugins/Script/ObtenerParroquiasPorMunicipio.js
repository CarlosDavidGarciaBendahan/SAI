$('#municipio').on('change',function(e){
	console.log(e);

	var mun_id = e.target.value;

	//ajax
	$.get('/ajax-ObtenerParroquiasPorMunicipio/' + mun_id, function(data){

		//succes data
		console.log(data);
					
		$('#parroquia').empty();
		$('#parroquia').append('<option value=""> Seleccione una parroquia</option>');
		
		$.each(data, function(index,subcatObj){

			$('#parroquia').append('<option value="'+subcatObj.id+'">'+subcatObj.par_nombre+' </option>');
		});
					
	});
});

