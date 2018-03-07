<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Categories</title>

	<link rel="stylesheet"  href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>
<body>

	<div class="container">
		<h1>Categories and Succategories AJAX, select drop down</h1>


		<div class="col-lg-4">
			{{ Form::open() }}

			<div class="form-group">
				<label>Categories </label>
				<select class="form-control input-sm" name="category" id="category">
					<option value=""> Selecciona una categoria</option>
					@foreach ($categories as $category)
						<option value="{{ $category->id }}"> {{ $category->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label>Subcategory</label>
				<select class="form-control input-sm" name="subcategory" id="subcategory">
					<option value=""> Selecciona una subcategoria</option>
				</select>
			</div>

			{{ Form::close() }}
		</div>

	</div>	

	<!--
	<script>
		$('#category').on('change',function(e){
			console.log(e);

			var cat_id = e.target.value;

			//ajax
			$.get('/ajax-subcat/' + cat_id, function(data){

				//succes data
				console.log(data);
				
				$('#subcategory').empty();
				$.each(data, function(index,subcatObj){

					$('#subcategory').append('<option value="'+subcatObj.id+'">'+subcatObj.name+' </option>');
				});
				
			});
		});
	</script>
	-->
	<script src="{{ asset('plugins/Script/SelectDinamico-prueba.js') }}"></script>

</body>
</html>