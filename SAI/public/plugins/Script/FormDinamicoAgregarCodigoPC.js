
		$(document).ready(function(){
			//var maxCorreo = 3;
			//var contador = 0;
			var btn = $('#add');
			var codigosPC = $('.codigoPC');
			var html = ""
			
			$(btn).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				//if(contador < maxCorreo){
					$(codigosPC).append("  <div> "+
						"<label class='col-sm'>Códigos</label>"+
						"<input class='form-control col-sm-9'  type='text' name='codigosPC[]' placeholder='B203040' required='true'>"+
						"<select class='form-control input-sm col-sm-2' name='estado[]' id='tipo_producto'>"+
								"<option value='B'>Bueno</option>"+
								"<option value='M'>Malo</option>"+
						"</select>"+
						" <a href='' class='remove btn btn-danger col-sm-1' > <span class='glyphicon glyphicon-remove-circle'></span></a>" +
						"</div>");
					//contador++;
				//}
			});

			$(codigosPC).on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				/*if(contador !== 0){
					contador--;
				}*/
			});
		});