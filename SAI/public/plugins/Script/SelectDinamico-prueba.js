
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