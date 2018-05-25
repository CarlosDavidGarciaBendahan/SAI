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
					
					<div class="form-group ">
							<label>Estados </label>
							<select class="form-control input-sm" name="fk_personal" id="personal">
								<option value=""> Seleccionar un personal</option>
								@foreach ($personal as $persona)
									@if ($persona->id === $user->fk_personal)
										<option value="{{ $persona->id }}" selected="true" disabled="true"> {{ $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
									@else
										<option value="{{ $persona->id }}"> {{ $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
									@endif
								@endforeach 
							</select>
					</div>

					<div class="form-group"> 
						
						{!! Form::label('name','Nombre de usuario') !!}

						{!! Form::text('name',$user->name,['class'=> 'form-control', 'placeholder'=>'nombre', 'required', 'readonly'=>'true']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('password','Clave') !!}

						{!! Form::password('password',['class'=> 'form-control', 'placeholder'=>'*******', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('activa','Activado') !!}

						{!! Form::select('activa',[0=>'NO',1=>'SI'], $user->activa, ['class'=>'form-control', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('roles','Roles') !!}

						{!! Form::select('roles[]',$roles,$user->roles->pluck('id'),['class'=> 'form-control select-roles', 'placeholder'=>'seleccionar roles', 'multiple','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelectorRoles.js') }}"></script>
@endsection