@extends('admin.template.main')

@section('title', 'Mostrar personal '. $personal->per_identificador."-".$personal->per_cedula)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'personal.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								@if ($estado->est_nombre === $personal->parroquia->municipio->estado->est_nombre)
									<option value="{{ $estado->id }}" selected="true"> {{ $estado->est_nombre }}</option>
								@else
									<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
								@endif
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="municipio" id="municipio">
							<option value=""> Seleccionar un municipio</option>
							
							@foreach ($municipios as $municipio)

							@if ($municipio->estado->est_nombre === $personal->parroquia->municipio->estado->est_nombre)
								@if ( $municipio->mun_nombre=== $personal->parroquia->municipio->mun_nombre)
									<option value="{{ $municipio->id }}" selected="true"> {{ $municipio->mun_nombre }}</option>
								@else
									<option value="{{ $municipio->id }}"> {{ $municipio->mun_nombre }}</option>
								@endif
							@endif
								
								
							@endforeach

						</select>
					</div>

					<div class="form-group">
						<label>Parroquias</label>
						<select class="form-control input-sm" name="per_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
							@foreach ($parroquias as $parroquia)
								@if ($parroquia->municipio->mun_nombre === $personal->parroquia->municipio->mun_nombre)
									@if ( $parroquia->par_nombre=== $personal->parroquia->par_nombre)
										<option value="{{ $parroquia->id }}" selected="true"> {{ $parroquia->par_nombre }}</option>
									@else
										<option value="{{ $parroquia->id }}"> {{ $parroquia->par_nombre }}</option>
									@endif
								@endif
								
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
							{!! Form::label('per_direccion','Direccion') !!}
							{!! Form::text('per_direccion',$personal->per_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('per_nombre','Nombre') !!}
							{!! Form::text('per_nombre',$personal->per_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_nombre2','Segundo nombre') !!}
							{!! Form::text('per_nombre2',$personal->per_nombre2,['class'=> 'form-control', 'placeholder'=>'Segundo nombre']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido','Apellido') !!}
							{!! Form::text('per_apellido',$personal->per_apellido,['class'=> 'form-control', 'placeholder'=>'Apellido', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido2','Segundo apellido') !!}
							{!! Form::text('per_apellido2',$personal->per_apellido2,['class'=> 'form-control', 'placeholder'=>'Segundo apellido']) !!}
						</div>
					
					

					
						<div class="form-group">
							{!! Form::label('per_identificador','Identificador') !!}
							{!! Form::select('per_identificador',['V'=>'V','E'=>'E','P'=>'P'], $personal->per_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required','disabled'] ) !!}
						</div>
					
					
					
						<div class="form-group"> 
						
							{!! Form::label('per_cedula','cedula') !!}

							{!! Form::text('per_cedula',$personal->per_cedula,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
						</div>

						<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha recibido') !!}

							{!! Form::text('per_fecha_nacimiento', $personal->per_fecha_nacimiento, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('per_fk_oficina','oficina') !!}
							{!! Form::select('per_fk_oficina',$oficinas, $personal->per_fk_oficina, ['class'=>'form-control', 'placeholder'=>'Elegir un rol', 'required'] ) !!}
						</div>

						<div class="form-group">
							{!! Form::label('per_fk_rol','Rol') !!}
							{!! Form::select('per_fk_rol',$roles, $personal->per_fk_rol, ['class'=>'form-control', 'placeholder'=>'Elegir un rol', 'required'] ) !!}
						</div>

						<div class="form-group"> 
						
							{!! Form::label('per_sueldo','sueldo') !!}

							{!! Form::text('per_sueldo',$personal->per_sueldo,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>
					<div>
						<a href="{{ route('personal.index') }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					     </a>
					</div>

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection