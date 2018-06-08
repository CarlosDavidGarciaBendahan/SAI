@extends('admin.template.main2')

@section('title', 'Editar usuario '. $user->name)

@section('contenido-header-name', 'Edición de usuario')

@section('contenido-header-name2', 'editar usuario')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('users.index') }}"> Usuario</a></li>
        <li class="active">Editar</li>
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
				{!! Form::open(['route' => ['users.update',$user], 'method' => 'PUT' ]) !!}
					<!-- QUITO EL SELECT... NO PERMITIRE CAMBIAR EL PERSONAL... SI SOLO PODRE DESACTIVAR O ACTIVAR
						O CAMBIAR LA CLAVE... NO PUEDO CAMBIAR NI EL NOMBRE DEL USUARIO NI EL PERSONAL A CUAL ESTA 
						ASIGNADO
					<div class="form-group ">
							<label>Estados </label>
							<select class="form-control input-sm" name="fk_personal" id="personal" required="true">
								<option value=""> Seleccionar un personal</option>
								foreach ($personal as $persona)
									if ($persona->id === $user->fk_personal)
										<option value=" $persona->id }}" selected="true" disabled="true">  $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
									else
										<option value=" $persona->id }}">  $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
									endif
								endforeach 
							</select>
					</div>
				-->
					<div class="form-group"> 
						
						{!! Form::label('fk_personal','Nombre del personal') !!}

						{!! Form::text('fk_personal',$user->personal->per_nombre." ".$user->personal->per_nombre2." ".$user->personal->per_apellido." ".$user->personal->per_apellido2,['class'=> 'form-control', 'placeholder'=>'nombre', 'required', 'readonly'=>'true']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('name','Nombre de usuario') !!}

						{!! Form::text('name',$user->name,['class'=> 'form-control', 'placeholder'=>'nombre', 'required', 'readonly'=>'true']) !!}
					</div>

					@if (auth()->user()->id === $user->id)
						<div class="form-group"> 
						
						{!! Form::label('password','Clave') !!}

						{!! Form::password('password',['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números min: 8 max: 20', 'placeholder'=>'********************', 'minlength'=>'8', 'maxlength' => '20', 'required', 'pattern'=>'[A-za-z0-9 ]+']) !!}
						</div>
					@endif
					
					@if (auth()->user()->id !== $user->id)
						<div class="form-group"> 
							
							{!! Form::label('activa','Activado') !!}

							{!! Form::select('activa',[0=>'NO',1=>'SI'], $user->activa, ['class'=>'form-control', 'required'] ) !!}
						</div>
					@endif

					@if (auth()->user()->id !== $user->id)
						<div class="form-group"> 
							
							{!! Form::label('roles','Roles') !!}

							{!! Form::select('fk_rol',$roles,$user->rol->id,['class'=> 'form-control select-roles', 'placeholder'=>'seleccionar roles', 'required']) !!}
						</div>
					@endif

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
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