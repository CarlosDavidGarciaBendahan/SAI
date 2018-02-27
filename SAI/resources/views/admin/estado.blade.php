@extends('admin.template.main')

@section('title', 'Estado '. $estado->est_nombre)


@section('body')
	{{-- expr --}}
 	
 	<section class="container">
 		<div class="row">
 			<div class="col-sm-10 offset-1 justify-content-center">
 				<h1> 
 					Estado {{ $estado->est_nombre }}
 				</h1>
	 			<div class="col-sm-10 offset-1 justify-content-center">
	 				<p>
	 					@foreach ($estado->Municipios as $municipio)
	 						Municipio {{ $municipio->mun_nombre }}
	 						<div class="col-sm-10 offset-1 justify-content-center">
	 							@foreach ($municipio->parroquias as $parroquia)
		 							<p>
		 								Parroquia {{ $parroquia->par_nombre }}
		 							</p>
	 							@endforeach
	 						</div>
	 					@endforeach
	 				</p>
	 				
	 			</div>
 			</div>
 		</div>	
 	</section>
@endsection