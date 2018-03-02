<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Permite que funcione en los navegadores de explorer-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Permite que se vea en todos los dispositivos	-->
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	

		
		<link rel="stylesheet" type="text/css" href="{{ asset('plugins/Bootstrap/css/bootstrap.min.css') }}">

		<title>@yield('title','default') | Admin</title>

	</head>
	<body>

		<section class="container-fluid">
			<div class="row">
				<div class="col-sm-8 offset-2">
					@include('admin.template.partials.nav')
				</div>
			</div>
		</section>
		
		
		
		<section>
			<section class="container-fluid">
				<div class="row">
				<div class="col-sm-8 offset-2">
					@include('flash::message')
				</div>
			</div>
			</section>
			
			
			@yield('body')
		</section>	

		<footer>
			@include('admin.template.partials.footer')
		</footer>
			


	<!-- SCRIPTS-->	
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="{{ asset('plugins/Bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugins/JQuery/js/jquery-3.3.1.min.js') }}"></script>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<section>
		@yield('scripts');
	</section>
	
	</body>
</html>