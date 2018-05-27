
		$(document).ready(function(){
			//var maxCorreo = 3;
			//var contador = 0;
			var btn = $('#add');
			var codigosArticulo = $('.codigoArticulo');
			var html = ""
			
			$(btn).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				//if(contador < maxCorreo){
					$(codigosArticulo).append("  <div> "+
						"<label class='col-sm'>Códigos</label>"+
						"<input class='form-control col-sm-9' title='Cantidad de caracteres max: 100' maxlength='100' type='text' name='codigosArticulo[]' placeholder='B203040' required='true'>"+
						"<select class='form-control input-sm col-sm-2' name='estado[]' id='tipo_producto' required='true'>"+
								"<option value='B'>Bueno</option>"+
								"<option value='M'>Malo</option>"+
						"</select>"+
						" <a href='' class='remove btn btn-danger col-sm-1' > <span class='glyphicon glyphicon-remove-circle'></span></a>" +
						"</div>");
					//contador++;
				//}
			});

			$(codigosArticulo).on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				/*if(contador !== 0){
					contador--;
				}*/
			});
		});