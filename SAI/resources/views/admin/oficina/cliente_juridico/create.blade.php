@extends('admin.template.main')

@section('title', 'Crear empresa cliente')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'cliente_juridico.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
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
						<select class="form-control input-sm" name="cli_jur_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_direccion','Direccion') !!}
						{!! Form::text('cli_jur_direccion',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_nombre','Nombre') !!}
						{!! Form::text('cli_jur_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('cli_jur_identificador','Identificador') !!}
						{!! Form::select('cli_jur_identificador',['J'=>'J','G'=>'G','C'=>'C'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('cli_jur_rif','RIF') !!}

						{!! Form::text('cli_jur_rif',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
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
@endsection
