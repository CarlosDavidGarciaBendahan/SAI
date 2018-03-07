//<script>
		//Si queremos por su value
		// En este ejemplo se seleccionará el option que su valor es 3
		$('#estado option[value={{ $parroquia->municipio->estado->id }}]').prop('selected', true);
		$('#estado').change();
		//$('#municipio option[value={{ $parroquia->municipio->id }}]').prop('selected', true);

//</script>