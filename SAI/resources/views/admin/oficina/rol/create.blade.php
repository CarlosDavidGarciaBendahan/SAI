@extends('admin.template.main')

@section('title', 'Crear rol')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'rol.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('rol_rol','Rol') !!}

						{!! Form::text('rol_rol',null,['class'=> 'form-control', 'placeholder'=>'Rol', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('permisos','Permisos') !!}

						{!! Form::select('permisos[]',$permisos,null,['class'=> 'form-control select-permisos', 'placeholder'=>'seleccionar permisos', 'multiple','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
@endsection