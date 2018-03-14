@extends('admin.template.main')

@section('title', 'Crear usuario')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'users.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group ">
							<label>Estados </label>
							<select class="form-control input-sm" name="fk_personal" id="personal">
								<option value=""> Seleccionar un personal</option>
								@foreach ($personal as $persona)
									<option value="{{ $persona->id }}"> {{ $persona->per_nombre ." ". $persona->per_nombre2 ." ".$persona->per_apellido ." ".$persona->per_apellido2 }}</option>
								@endforeach 
							</select>
					</div>

					<div class="form-group"> 
						
						{!! Form::label('name','Nombre de usuario') !!}

						{!! Form::text('name',null,['class'=> 'form-control', 'placeholder'=>'nombre', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('password','Clave') !!}

						{!! Form::password('password',['class'=> 'form-control', 'placeholder'=>'*******', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('activa','Activado') !!}

						{!! Form::select('activa',[0=>'NO',1=>'SI'], '1', ['class'=>'form-control', 'required'] ) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection