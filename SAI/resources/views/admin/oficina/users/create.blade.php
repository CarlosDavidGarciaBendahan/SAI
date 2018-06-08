@extends('admin.template.main2')

@section('title', 'Crear usuario')

@section('contenido-header-name', 'Registro de usuario')

@section('contenido-header-name2', 'crear usuario')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('users.index') }}"> Usuario</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">

				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif


				{!! Form::open(['route' => 'users.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group ">
							<label>Personal </label>
							<select class="form-control input-sm required" name="fk_personal" id="personal" required="true">
								<option value=""> Seleccionar un personal</option>
								@foreach ($personal as $persona)
									<option value="{{ $persona->id }}"> {{ $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
								@endforeach 
							</select>
					</div>

					<div class="form-group"> 
						
						{!! Form::label('name','Nombre de usuario') !!}

						{!! Form::text('name',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números min: 3 max: 20', 'placeholder'=>'Nombre de usuario.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9]+']) !!}
					</div>

					<!--
					<div class="form-group"> 
						
						{!! Form::label('password','Clave') !!}

						{!! Form::password('password',['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números min: 8 max: 20', 'placeholder'=>'********************', 'required', 'minlength'=>'8', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>
					-->
					<div class="form-group"> 
						
						{!! Form::label('activa','Activado') !!}

						{!! Form::select('activa',[0=>'NO',1=>'SI'], '1', ['class'=>'form-control', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('roles','Roles') !!}

						{!! Form::select('fk_rol',$roles,null,['class'=> 'form-control select-roles', 'placeholder'=>'seleccionar roles', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('users.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelectorRoles.js') }}"></script>
@endsection