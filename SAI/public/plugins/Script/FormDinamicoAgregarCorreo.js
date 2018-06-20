
		$(document).ready(function(){
			var maxCorreo = 2;
			var contador = 0;
			var btn_correo = $('#addCorreo');
			var correos = $('.correos');
			var html = ""
			
			$(btn_correo).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				if(contador < maxCorreo){
					$(correos).append("  <div> "+
						"<label>Correo "+(contador+2)+" </label>"+
						"<input class='form-control'  type='email' name='correos[]' placeholder='correo@gmail.com' required='true' pattern='.+@[gG]?[mM]?[aA]?[iI]?[lL]?[hH]?[oO]?[tT]?[mM]?[aA]?[iI]?[lL]?[.][cC][oO][mM]' title='Solo se permiten cuentas GMAIL o HOTMAIL'>"+
						//" <a href='' class='remove btn btn-info'> <span class='glyphicon glyphicon-arrow-left'></span> quitar</a>" +
						" <a href='' class='remove btn btn-danger ' title='Quitar Tlf'> <span class='fa fa-close'></span></a>"+
						"</div>");
					contador++;
				}else{
					alert("No puede agregar más de 3 correos");
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