$(document).ready(function(){
			var maxCorreo = 2;
			var contador = 0;
			var btn_telefono = $('#addTelefono');
			var telefonos = $('.telefonos');
			var html = "<div class='form-group'> " +
						" <label>Telefono "+(contador+2)+"</label> <br>"+

						" <label>código</label>"+
						" <input class='form-control'  type='text' name='codigos[]' placeholder='414' required='true' pattern='[0-9]+' minlength='3' maxlength='4' title='Solo números, min:3 y max:4'>"+
						
						" <label>número</label>"+
						" <input class='form-control'  type='text' name='numeros[]' placeholder='1234567' required='true' pattern='[0-9]+' minlength='7' maxlength='7' title='Solo números, min:7 y max:7'>"+
						
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
				}else{
					alert("No puede agregar más de 3 telefonos");
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