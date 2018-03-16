@extends('admin.template.main')

@section('title', 'Crear cliente')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'cliente_natural.store', 'method' => 'POST' ]) !!}
					
					
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
							<select class="form-control input-sm" name="cli_nat_fk_parroquia" id="parroquia">
								<option value=""> Seleccionar una parroquia</option>
							</select>
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_direccion','Direccion') !!}
							{!! Form::text('cli_nat_direccion',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_nombre','Nombre') !!}
							{!! Form::text('cli_nat_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_nombre2','Segundo nombre') !!}
							{!! Form::text('cli_nat_nombre2',null,['class'=> 'form-control', 'placeholder'=>'Segundo nombre']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido','Apellido') !!}
							{!! Form::text('cli_nat_apellido',null,['class'=> 'form-control', 'placeholder'=>'Apellido', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido2','Segundo apellido') !!}
							{!! Form::text('cli_nat_apellido2',null,['class'=> 'form-control', 'placeholder'=>'Segundo apellido']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_identificador','Identificador') !!}
							{!! Form::select('cli_nat_identificador',['V'=>'V','E'=>'E','P'=>'P'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
						</div>
					
						<div class="form-group"> 
						
							{!! Form::label('cli_nat_cedula','cedula') !!}

							{!! Form::text('cli_nat_cedula',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
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
	<script src="{{ asset('plugins/Script/FormDinamicoAgregarCorreo.js') }}"></script>
	<script src="{{ asset('plugins/Script/FormDinamicoAgregarTelefono.js') }}"></script>
@endsection
