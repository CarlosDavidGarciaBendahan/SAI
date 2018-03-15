
		$(document).ready(function(){
			var maxCorreo = 3;
			var contador = 0;
			var btn_correo = $('#addCorreo');
			var correos = $('.correos');
			var html = ""
			
			$(btn_correo).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				if(contador < maxCorreo){
					$(correos).append("  <div> <label>Correo</label> <input class='form-control'  type='email' name='correos[]' placeholder='correo@gmail.com' required='true'> <a href='' class='remove btn btn-info'> <span class='glyphicon glyphicon-arrow-left'></span> quitar</a> </div>");
					contador++;
				}
			});

			$(correos).on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				if(contador !== 0){
					contador--;
				}
			});
		});