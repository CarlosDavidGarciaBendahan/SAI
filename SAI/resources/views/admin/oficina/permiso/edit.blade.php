@extends('admin.template.main')

@section('title', 'Editar permiso '. $permiso->perm_permiso)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['permiso.update',$permiso], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('perm_permiso','permiso') !!}

						{!! Form::text('perm_permiso',$permiso->perm_permiso,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection