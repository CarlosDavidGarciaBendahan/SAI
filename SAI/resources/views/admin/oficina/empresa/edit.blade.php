@extends('admin.template.main')

@section('title', 'Editar empresa '. $empresa->emp_identificador."-".$empresa->emp_rif)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['empresa.update',$empresa], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								@if ($estado->est_nombre === $empresa->parroquia->municipio->estado->est_nombre)
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

							@if ($municipio->estado->est_nombre === $empresa->parroquia->municipio->estado->est_nombre)
								@if ( $municipio->mun_nombre=== $empresa->parroquia->municipio->mun_nombre)
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
						<select class="form-control input-sm" name="emp_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
							@foreach ($parroquias as $parroquia)
								@if ($parroquia->municipio->mun_nombre === $empresa->parroquia->municipio->mun_nombre)
									@if ( $parroquia->par_nombre=== $empresa->parroquia->par_nombre)
										<option value="{{ $parroquia->id }}" selected="true"> {{ $parroquia->par_nombre }}</option>
									@else
										<option value="{{ $parroquia->id }}"> {{ $parroquia->par_nombre }}</option>
									@endif
								@endif
								
								
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('emp_direccion','Direccion') !!}
						{!! Form::text('emp_direccion',$empresa->emp_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('emp_nombre','Nombre') !!}
						{!! Form::text('emp_nombre',$empresa->emp_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('emp_identificador','Identificador') !!}
						{!! Form::select('emp_identificador',['J'=>'J','G'=>'G','C'=>'C'], $empresa->emp_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required', 'disabled'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('emp_rif','RIF') !!}

						{!! Form::text('emp_rif',$empresa->emp_rif,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
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
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
@endsection