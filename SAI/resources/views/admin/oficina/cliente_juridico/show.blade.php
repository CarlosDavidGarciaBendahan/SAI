@extends('admin.template.main2')

@section('title', 'Mostrar cliente juridico '. $cliente_juridico->cli_jur_identificador."-".$cliente_juridico->cli_jur_rif)

@section('contenido-header-name', 'Observación de empresa')

@section('contenido-header-name2', 'observar empresa')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_juridico.index') }}"> Empresa</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'cliente_juridico.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							
							@foreach ($estados as $estado)
								@if ($estado->est_nombre === $cliente_juridico->parroquia->municipio->estado->est_nombre)
									<option value="{{ $estado->id }}" selected="true"> {{ $estado->est_nombre }}</option>
								@endif
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="municipio" id="municipio">
							
							
							@foreach ($municipios as $municipio)

							@if ($municipio->estado->est_nombre === $cliente_juridico->parroquia->municipio->estado->est_nombre)
								@if ( $municipio->mun_nombre=== $cliente_juridico->parroquia->municipio->mun_nombre)
									<option value="{{ $municipio->id }}" selected="true"> {{ $municipio->mun_nombre }}</option>
								@endif
							@endif
								
								
							@endforeach

						</select>
					</div>

					<div class="form-group">
						<label>Parroquias</label>
						<select class="form-control input-sm" name="cli_jur_fk_parroquia" id="parroquia">
							
							@foreach ($parroquias as $parroquia)
								@if ($parroquia->municipio->mun_nombre === $cliente_juridico->parroquia->municipio->mun_nombre)
									@if ( $parroquia->par_nombre=== $cliente_juridico->parroquia->par_nombre)
										<option value="{{ $parroquia->id }}" selected="true"> {{ $parroquia->par_nombre }}</option>
									@endif
								@endif
								
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_direccion','Direccion') !!}
						{!! Form::text('cli_jur_direccion',$cliente_juridico->cli_jur_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required', 'readonly'=>'true']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_nombre','Nombre') !!}
						{!! Form::text('cli_jur_nombre',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required', 'readonly'=>'true']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_identificador','Identificador') !!}
						{!! Form::select('cli_jur_identificador',['J'=>'J','G'=>'G','C'=>'C'], $cliente_juridico->cli_jur_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required', 'disabled'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('cli_jur_rif','RIF') !!}

						{!! Form::text('cli_jur_rif',$cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
					</div>

					<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Correo</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($cliente_juridico->Contacto_Correos as $contacto_correo)
				  		<tr>
					      <th scope="row">{{ $contacto_correo->id }}</th>
					      <td>{{ $contacto_correo->con_cor_correo }}</td>
					      
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>tipo</th>
				      <th>Telefono</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($cliente_juridico->Contacto_Telefonos  as $contacto_telefono)
				  		<tr>
					      <th scope="row">{{ $contacto_telefono->id }}</th>
					      <td>{{ $contacto_telefono->con_tel_tipo }}</td>
					      <td>{{ $contacto_telefono->con_tel_codigo . "-" . $contacto_telefono->con_tel_numero }}</td>
					      
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
@endsection