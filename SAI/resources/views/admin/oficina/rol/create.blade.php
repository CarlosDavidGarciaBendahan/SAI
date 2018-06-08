@extends('admin.template.main2')

@section('title', 'Crear rol')

@section('contenido-header-name', 'Registro de rol')

@section('contenido-header-name2', 'crear rol')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('rol.index') }}"> Rol</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'rol.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('rol_rol','Rol') !!}

						{!! Form::text('rol_rol',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números min: 3 max: 25', 'placeholder'=>'Nombre del rol.', 'required', 'minlength'=>'3', 'maxlength' => '25', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('permisos','Tipo de rol') !!}

						{!! Form::select('rol_tipo',['U'=>'Usuario','P'=>'Personal'],'U',['class'=> 'form-control select-permisos', 'placeholder'=>'seleccionar permisos','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('rol.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
@endsection