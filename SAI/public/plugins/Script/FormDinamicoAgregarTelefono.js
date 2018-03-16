$(document).ready(function(){
			var maxCorreo = 3;
			var contador = 0;
			var btn_telefono = $('#addTelefono');
			var telefonos = $('.telefonos');
			var html = "<div class='form-group'> " +
						" <label>Telefono</label> <br>"+ 
						" <label>código</label>"+
						" <input class='form-control'  type='text' name='codigos[]' placeholder='414' required='true'>"+
						" <label>número</label>"+
						" <input class='form-control'  type='text' name='numeros[]' placeholder='1234567' required='true'>"+
						" <label>tipo</label>"+
						" <select class='form-control input-sm' name='tipos[]' id='tipos[]' required='true'> "+
							" <option value='movil' select='true'> Movil </option>" +
							" <option value='local'> Local </option>" +
							" <option value='fax'> Fax </option>" +
						" </select>" +
						" <a href='' class='remove btn btn-info'> <span class='glyphicon glyphicon-arrow-left'></span> quitar</a>"+
						"</div>";
			
			$(btn_telefono).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				if(contador < maxCorreo){
					$(telefonos).append(html);
					contador++;
				}
			});

			$(telefonos).on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				if(contador !== 0){
					contador--;
				}
			});
		});