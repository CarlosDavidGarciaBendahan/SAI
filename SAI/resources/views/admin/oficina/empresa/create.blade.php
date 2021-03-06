@extends('admin.template.main2')

@section('title', 'Crear empresa')

@section('contenido-header-name', 'Registro de empresa')

@section('contenido-header-name2', 'crear registro de empresa')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('empresa.index') }}"> Empresa</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => 'empresa.store', 'method' => 'POST']) !!}
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group col-sm-4">
								<label>Estados </label>
								<select class="form-control input-sm" name="estado" id="estado" required="true">
									<option value=""> Seleccionar un estado</option>
									@foreach ($estados as $estado)
										<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group col-sm-4">
								<label>Municipios</label>
								<select class="form-control input-sm" name="municipio" id="municipio" required="true">
									<option value=""> Seleccionar un municipio</option>
								</select>
							</div>

							<div class="form-group col-sm-4">
								<label>Parroquias</label>
								<select class="form-control input-sm" name="emp_fk_parroquia" id="parroquia" required="true">
									<option value=""> Seleccionar una parroquia</option>
								</select>
							</div>

							<div class="form-group col-sm-12">
								{!! Form::label('emp_direccion','Direccion') !!}
								{!! Form::text('emp_direccion',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas, la coma (,), punto (.) y números de 0-9, min: 10 max: 200', 'placeholder'=>'dirección.', 'required', 'minlength'=>'10', 'maxlength' => '200', 'pattern'=>'[A-za-z0-9,. ]+']) !!}
							</div>


							<div class="form-group col-sm-4">
								{!! Form::label('emp_nombre','Nombre') !!}
								{!! Form::text('emp_nombre',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y números min: 3 max: 20', 'placeholder'=>'Nombre de la empresa.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
							</div>

							<div class="form-group col-sm-4">
								{!! Form::label('emp_identificador','Identificador') !!}
								{!! Form::select('emp_identificador',['J'=>'J','G'=>'G','C'=>'C'], 'J', ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
							</div>

							<div class="form-group col-sm-4"> 
								
								{!! Form::label('emp_rif','RIF') !!}

								{!! Form::text('emp_rif',null,['class'=> 'form-control', 'title'=>'Solo números min: 5 max: 10', 'placeholder'=>'1234567890', 'required', 'minlength'=>'5', 'maxlength' => '10', 'pattern'=>'[0-9]+']) !!}
							</div>


						</div>
						<div class="col-sm-6">
							<div class="correos">
								<label>Correo 1</label>
								<input class='form-control'  type='email' name='correos[]' placeholder='correo@gmail.com' required='true' pattern=".+@[gG]?[mM]?[aA]?[iI]?[lL]?[hH]?[oO]?[tT]?[mM]?[aA]?[iI]?[lL]?[.][cC][oO][mM]" title="Solo se permiten cuentas de GMAIL o HOTMAIL">
							</div>

							<div class="form-group">
								{!! Form::submit('Agregar Correo',['class'=>'btn btn-primary', 'id' => 'addCorreo']) !!}
							</div>
						</div>

						<div class="col-sm-6">
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
						</div>


					</div>
					

					

					

					

					

					

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('empresa.index') }}" class="btn btn-danger">Calcelar</a>
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
