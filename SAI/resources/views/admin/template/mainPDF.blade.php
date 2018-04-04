<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Permite que funcione en los navegadores de explorer-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Permite que se vea en todos los dispositivos	-->
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	

    	<link rel="stylesheet" type="text/css" href="plugins/css/stylePDF.css">

		<title>@yield('title','default') | PDF</title>

	</head>
	<body>

		<!-- Datos de la empresa-->	
		<section id="section-empresa">
			@yield('empresa')
		</section>

		<!-- Datos de la cliente-->	
		<section id="section-cliente">
			@yield('cliente')
		</section>

		<!-- Datos del presupuesto-->	
		<section id="section-presupuesto">
			@yield('presupuesto')
		</section>


		<!-- Datos de los productos-->	
		<section id="section-productos">
			@yield('productos')
		</section>


		<footer>
			@yield('footer')
		</footer>
	<!-- SCRIPTS-->	

	
	</body>
</html>