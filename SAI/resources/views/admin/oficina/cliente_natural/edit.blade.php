@extends('admin.template.main2')

@section('title', 'Editar cliente natural '. $cliente_natural->cli_nat_identificador."-".$cliente_natural->cli_nat_cedula)

@section('contenido-header-name', 'Edición de persona')

@section('contenido-header-name2', 'editar persona')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_natural.index') }}"> Persona</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['cliente_natural.update',$cliente_natural], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								@if ($estado->est_nombre === $cliente_natural->parroquia->municipio->estado->est_nombre)
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

							@if ($municipio->estado->est_nombre === $cliente_natural->parroquia->municipio->estado->est_nombre)
								@if ( $municipio->mun_nombre=== $cliente_natural->parroquia->municipio->mun_nombre)
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
						<select class="form-control input-sm" name="cli_nat_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
							@foreach ($parroquias as $parroquia)
								@if ($parroquia->municipio->mun_nombre === $cliente_natural->parroquia->municipio->mun_nombre)
									@if ( $parroquia->par_nombre=== $cliente_natural->parroquia->par_nombre)
										<option value="{{ $parroquia->id }}" selected="true"> {{ $parroquia->par_nombre }}</option>
									@else
										<option value="{{ $parroquia->id }}"> {{ $parroquia->par_nombre }}</option>
									@endif
								@endif
								
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
							{!! Form::label('cli_nat_direccion','Direccion') !!}
							{!! Form::text('cli_nat_direccion',$cliente_natural->cli_nat_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
						</div>

						<div class="form-group">
							{!! Form::label('cli_nat_nombre','Nombre') !!}
							{!! Form::text('cli_nat_nombre',$cliente_natural->cli_nat_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_nombre2','Segundo nombre') !!}
							{!! Form::text('cli_nat_nombre2',$cliente_natural->cli_nat_nombre2,['class'=> 'form-control', 'placeholder'=>'Segundo nombre']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido','Apellido') !!}
							{!! Form::text('cli_nat_apellido',$cliente_natural->cli_nat_apellido,['class'=> 'form-control', 'placeholder'=>'Apellido', 'required']) !!}
						</div>
					
						<div class="form-group">
							{!! Form::label('cli_nat_apellido2','Segundo apellido') !!}
							{!! Form::text('cli_nat_apellido2',$cliente_natural->cli_nat_apellido2,['class'=> 'form-control', 'placeholder'=>'Segundo apellido']) !!}
						</div>
					
					

					
						<div class="form-group">
							{!! Form::label('cli_nat_identificador','Identificador') !!}
							{!! Form::select('cli_nat_identificador',['V'=>'V','E'=>'E','P'=>'P'], $cliente_natural->cli_nat_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required','disabled'] ) !!}
						</div>
					
					
					
						<div class="form-group"> 
						
							{!! Form::label('cli_nat_cedula','cedula') !!}

							{!! Form::text('cli_nat_cedula',$cliente_natural->cli_nat_cedula,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
						</div>



						@if (sizeof($contacto_correos) < 3)
					<a href="{{ route('contacto_correo_cliente_natural.create', $cliente_natural) }}" class="btn btn-info">
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
					      	<a href="{{ route('contacto_correo_cliente_natural.edit', [$contacto_correo->id,$cliente_natural]) }}" class="btn btn-warning">
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
					<a href="{{ route('contacto_telefono_cliente_natural.create', $cliente_natural) }}" class="btn btn-info">
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
					      	<a href="{{ route('contacto_telefono_cliente_natural.edit', [$contacto_telefono->id,$cliente_natural]) }}" class="btn btn-warning">
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
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
@endsection
