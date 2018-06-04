$(document).ready(function(){
			var btn_ventasMensuales = $('#btn-ventasMensuales');
			var select_year = $('#year');
			var select_month = $('#month');
			var year=0;
			var month=0;
			select_year.change(function(){
				//alert(select_year.val());
				year = select_year.val();

				document.getElementById('year-text').value = year;

			});
			select_month.change(function(){
				//alert(select_month.val());
				month = select_month.val();
				document.getElementById('month-text').value = month;
			});

			$(btn_ventasMensuales).click(function(event){
				event.preventDefault();
				//console.log('valor del ano y mes '+ year + ' '+ month);

				//$.get('/admin/reportes/reporteventa/ventasMensuales/'+year+'/'+month);

				// Creación de la petición HTTP
					var req = new XMLHttpRequest();
					// Petición HTTP GET síncrona hacia el archivo fotos.json del servidor
					req.open("GET", '/admin/reportes/reporteventa/ventasMensuales/'+year+'/'+month, false);
					// Envío de la petición
					req.send(null);
					// Impresión por la consola de la respuesta recibida desde el servidor
					console.log(req.responseText);
			});

});