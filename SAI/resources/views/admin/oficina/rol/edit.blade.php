@extends('admin.template.main')

@section('title', 'Editar rol '. $rol->rol_rol)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['rol.update',$rol], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('rol_rol','rol') !!}

						{!! Form::text('rol_rol',$rol->rol_rol,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection