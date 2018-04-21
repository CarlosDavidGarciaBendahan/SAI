$(document).ready(function(){

	var PC_id = new Array();
	var select = $('#select-codigosPC');// se localiza por ID y se utiliza el #

	$(select).change(function(event){
		console.log(event.target.value);

		PC_id.push(event.target.value);

		/*for (var i = 0; i < PC_id.length; i++) {
		    console.log("codigo "+ i +": " + PC_id[i]);
		 }*/

	});


	

			/*var btn = $('#add');
			var codigosArticulo = $('.codigoArticulo');
			var html = ""
			
			$(btn).click(function(event){
				event.preventDefault();
				//console.log('preciono button agregar correo');
				//if(contador < maxCorreo){
					$(codigosArticulo).append("  <div> "+
						"<label class='col-sm'>Códigos</label>"+
						"<input class='form-control col-sm-9'  type='text' name='codigosArticulo[]' placeholder='B203040' required='true'>"+
						"<select class='form-control input-sm col-sm-2' name='estado[]' id='tipo_producto'>"+
								"<option value='B'>Bueno</option>"+
								"<option value='M'>Malo</option>"+
						"</select>"+
						" <a href='' class='remove btn btn-danger col-sm-1' > <span class='glyphicon glyphicon-remove-circle'></span></a>" +
						"</div>");
						
					//contador++;
				//}
			});

			/*$(codigosArticulo).on('click','.remove',function(event){
				event.preventDefault();
				//console.log('preciono button Eliminar correo');
				$(this).parent().remove();
				if(contador !== 0){
					contador--;
				}
			});*/
})