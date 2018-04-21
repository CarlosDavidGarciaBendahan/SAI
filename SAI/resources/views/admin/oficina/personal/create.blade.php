@extends('admin.template.main')

@section('title', 'Crear personal')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'personal.store', 'method' => 'POST' ]) !!}
					
					
						<div class="form-group ">
							<label>Estados </label>
							<select class="form-control input-sm" name="estado" id="estado">
								<option value=""> Seleccionar un estado</option>
								@foreach ($estados as $estado)
									<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group">
							<label>Municipios</label>
							<select class="form-control input-sm" name="municipio" id="municipio">
								<option value=""> Seleccionar un municipio</option>
							</select>
						</div>
					
						<div class="form-group">
							<label>Parroquias</label>
							<select class="form-control input-sm" name="per_fk_parroquia" id="parroquia">
								<option value=""> Seleccionar una parroquia</option>
							</select>
						</div>
					
						<div class="form-group">
							{!! Form::label('per_direccion','Direccion') !!}
							{!! Form::text('per_direccion',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_nombre','Nombre') !!}
							{!! Form::text('per_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_nombre2','Segundo nombre') !!}
							{!! Form::text('per_nombre2',null,['class'=> 'form-control', 'placeholder'=>'Segundo nombre']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido','Apellido') !!}
							{!! Form::text('per_apellido',null,['class'=> 'form-control', 'placeholder'=>'Apellido', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido2','Segundo apellido') !!}
							{!! Form::text('per_apellido2',null,['class'=> 'form-control', 'placeholder'=>'Segundo apellido']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_identificador','Identificador') !!}
							{!! Form::select('per_identificador',['V'=>'V','E'=>'E','P'=>'P'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
						</div>
					
						<div class="form-group"> 
						
							{!! Form::label('per_cedula','cedula') !!}

							{!! Form::text('per_cedula',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>
					
					
						

						<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha de nacimiento') !!}

							{!! Form::text('per_fecha_nacimiento', '', array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('per_fk_oficina','oficina') !!}
							{!! Form::select('per_fk_oficina',$oficinas, null, ['class'=>'form-control', 'placeholder'=>'Elegir un rol', 'required'] ) !!}
						</div>


						<div class="form-group">
							{!! Form::label('per_fk_rol','Rol') !!}
							{!! Form::select('per_fk_rol',$roles, null, ['class'=>'form-control', 'placeholder'=>'Elegir un rol', 'required'] ) !!}
						</div>


						<div class="form-group"> 
						
							{!! Form::label('per_sueldo','sueldo') !!}

							{!! Form::text('per_sueldo',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>


						<div class="form-group">
						{!! Form::submit('Agregar Correo',['class'=>'btn btn-primary', 'id' => 'addCorreo']) !!}
					</div>

					<div class="correos">
						
					</div>

					<div class="form-group">
						{!! Form::submit('Agregar Telefono',['class'=>'btn btn-primary', 'id' => 'addTelefono']) !!}
					</div>

					
					<div class="telefonos">
						
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
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  	<script src="{{ asset('plugins/Script/datepicker.js') }}"></script>
	<script src="{{ asset('plugins/Script/FormDinamicoAgregarCorreo.js') }}"></script>
	<script src="{{ asset('plugins/Script/FormDinamicoAgregarTelefono.js') }}"></script>
@endsection

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection
