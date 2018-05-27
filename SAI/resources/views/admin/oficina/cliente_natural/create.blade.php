@extends('admin.template.main2')

@section('title', 'Crear cliente')

@section('contenido-header-name', 'Registro de persona')

@section('contenido-header-name2', 'crear persona')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_natural.index') }}"> Persona</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'cliente_natural.store', 'method' => 'POST' ]) !!}
					
					
						<div class="form-group ">
							<label>Estados </label>
							<select class="form-control input-sm" name="estado" id="estado" required="true">
								<option value=""> Seleccionar un estado</option>
								@foreach ($estados as $estado)
									<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group">
							<label>Municipios</label>
							<select class="form-control input-sm" name="municipio" id="municipio" required="true">
								<option value=""> Seleccionar un municipio</option>
							</select>
						</div>
					
						<div class="form-group">
							<label>Parroquias</label>
							<select class="form-control input-sm" name="cli_nat_fk_parroquia" id="parroquia" required="true">
								<option value=""> Seleccionar una parroquia</option>
							</select>
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_direccion','Direccion') !!}
							{!! Form::text('cli_nat_direccion',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas, la coma (,), punto (.) y números de 0-9, min: 10 max: 200', 'placeholder'=>'dirección.', 'required', 'minlength'=>'10', 'maxlength' => '200', 'pattern'=>'[A-za-z0-9,. ]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_nombre','Nombre') !!}
							{!! Form::text('cli_nat_nombre',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 20', 'placeholder'=>'Nombre de la persona.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_nombre2','Segundo nombre') !!}
							{!! Form::text('cli_nat_nombre2',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 20', 'placeholder'=>'Segundo nombre de la persona.', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido','Apellido') !!}
							{!! Form::text('cli_nat_apellido',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 20', 'placeholder'=>'Apellido de la persona.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido2','Segundo apellido') !!}
							{!! Form::text('cli_nat_apellido2',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 20', 'placeholder'=>'Segundo apellido de la persona.', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_identificador','Identificador') !!}
							{!! Form::select('cli_nat_identificador',['V'=>'V','E'=>'E','P'=>'P'], 'V', ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
						</div>
					
						<div class="form-group"> 
						
							{!! Form::label('cli_nat_cedula','cedula') !!}

							{!! Form::text('cli_nat_cedula',null,['class'=> 'form-control', 'title'=>'Solo numeros min: 6 max: 9', 'required'=>'true','placeholder'=>'123456789', 'minlength'=>'6', 'maxlength' => '9', 'pattern'=>'[0-9]+']) !!}
						</div>
					
					
						<div class="correos">
							<label>Correo 1</label>
							<input class='form-control'  type='email' name='correos[]' placeholder='correo@gmail.com' required='true' pattern=".+@[gG]?[mM]?[aA]?[iI]?[lL]?[hH]?[oO]?[tT]?[mM]?[aA]?[iI]?[lL]?[.][cC][oO][mM]" title="Solo se permiten cuentas de GMAIL o HOTMAIL">
						</div>
						<div class="form-group">
							{!! Form::submit('Agregar Correo',['class'=>'btn btn-primary', 'id' => 'addCorreo']) !!}
						</div>

						<div class="telefonos">
						<label>Telefono 1</label> <br> 

						<label>código</label>
						<input class='form-control'  type='text' name='codigos[]' placeholder='414' required='true' pattern="[0-9]+" minlength="3" maxlength="4" title="Solo números, min:3 y max:4">

						<label>número</label>
						<input class='form-control'  type='text' name='numeros[]' placeholder='1234567' required='true' pattern="[0-9]+" minlength="7" maxlength="7" title="Solo números, min:7 y max:7">

						<label>tipo</label>
						<select class='form-control input-sm' name='tipos[]' id='tipos[]' required='true'> 
							<option value='movil' select='true'> Movil </option>
							<option value='local'> Local </option>
							<option value='fax'> Fax </option>
						</select>
						</div>

						<div class="form-group">
							{!! Form::submit('Agregar Telefono',['class'=>'btn btn-primary', 'id' => 'addTelefono']) !!}
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
