@extends('admin.template.main2')

@section('title', 'Editar personal '. $personal->per_identificador."-".$personal->per_cedula)

@section('contenido-header-name', 'Edición de personal')

@section('contenido-header-name2', 'editar  personal')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('personal.index') }}"> Personal</a></li>
        <li class="active">Editar</li>
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
				{!! Form::open(['route' => ['personal.update',$personal], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado" required="true">
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
						<select class="form-control input-sm" name="municipio" id="municipio" required="true">
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
						<select class="form-control input-sm" name="per_fk_parroquia" id="parroquia" required="true">
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
							{!! Form::text('per_direccion',$personal->per_direccion,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas, la coma (,), punto (.) y números de 0-9, min: 10 max: 250', 'placeholder'=>'dirección.', 'required', 'minlength'=>'10', 'maxlength' => '250', 'pattern'=>'[A-za-z0-9,. ]+']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('per_nombre','Nombre') !!}
							{!! Form::text('per_nombre',$personal->per_nombre,['class'=> 'form-control',  'title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 25', 'placeholder'=>'Nombre de la persona.', 'required', 'minlength'=>'3', 'maxlength' => '25', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_nombre2','Segundo nombre') !!}
							{!! Form::text('per_nombre2',$personal->per_nombre2,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 25', 'placeholder'=>'Segundo Nombre de la persona.', 'minlength'=>'3', 'maxlength' => '25', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido','Apellido') !!}
							{!! Form::text('per_apellido',$personal->per_apellido,['class'=> 'form-control',  'title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 25', 'placeholder'=>'apellido de la persona.', 'required', 'minlength'=>'3', 'maxlength' => '25', 'pattern'=>'[A-za-z]+']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('per_apellido2','Segundo apellido') !!}
							{!! Form::text('per_apellido2',$personal->per_apellido2,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas  min: 3 max: 25', 'placeholder'=>'Segundo apellido de la persona.', 'minlength'=>'3', 'maxlength' => '25', 'pattern'=>'[A-za-z]+']) !!}
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

							{!! Form::text('per_sueldo',$personal->per_sueldo,['class'=> 'form-control','title'=>'Solo numeros de 0-9, min: 1 max: 10, con 2 decimales', 'placeholder'=>'123456789.12', 'required', 'minlength'=>'1', 'maxlength' => '12', 'pattern'=>'[0-9][0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[\.]?[0-9]?{1,2}']) !!}
						</div>



					@if (sizeof($contacto_correos) < 3)
					<a href="{{ route('contacto_correo_personal.create', $personal) }}" class="btn btn-info">
						Registrar nuevo correo
					</a>
					@endif

					<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Correo</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($contacto_correos as $contacto_correo)
				  		<tr>
					      <th scope="row">{{ $contacto_correo->id }}</th>
					      <td>{{ $contacto_correo->con_cor_correo }}</td>
					      <td>						      
					      	<a href="{{ route('contacto_correo_personal.edit', [$contacto_correo->id,$personal]) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('contacto_correo.destroy', $contacto_correo->id) }}" onclick="return confirm('Eliminar el contacto_correo?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<!--
					      	<a href="{{ route('contacto_correo.show', $contacto_correo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	-->
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				
					
				
				@if (sizeof($contacto_telefonos) < 3)
					<a href="{{ route('contacto_telefono_personal.create', $personal) }}" class="btn btn-info">
						Registrar nuevo telefono
					</a>
				@endif
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>tipo</th>
				      <th>Telefono</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($contacto_telefonos as $contacto_telefono)
				  		<tr>
					      <th scope="row">{{ $contacto_telefono->id }}</th>
					      <td>{{ $contacto_telefono->con_tel_tipo }}</td>
					      <td>{{ $contacto_telefono->con_tel_codigo . "-" . $contacto_telefono->con_tel_numero }}</td>
					      <td>						      
					      	<a href="{{ route('contacto_telefono_personal.edit', [$contacto_telefono->id,$personal]) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('contacto_telefono.destroy', $contacto_telefono->id) }}" onclick="return confirm('Eliminar el contacto_telefono?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<!--
					      	<a href="{{ route('contacto_telefono.show', $contacto_telefono->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	-->
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
									<a href="{{ route('personal.index') }}" class="btn btn-danger">Calcelar</a>
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
  	<script src="{{ asset('plugins/Script/datepicker2.js') }}"></script>
@endsection

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection