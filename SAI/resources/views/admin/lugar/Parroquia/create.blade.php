@extends('admin.template.main2')

@section('title', 'Crear parroquia')

@section('contenido-header-name', 'Parroquia')

@section('contenido-header-name2', 'registro de parroquia')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('parroquia.index') }}"> Parroquia</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'parroquia.store', 'method' => 'POST' ]) !!}
					
					<!-- SELECT ESTADO-->
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
							@endforeach
						</select>
					</div>

					<!-- SELECT MUNICIPIO-->
					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="par_fk_municipio" id="municipio">
							<option value=""> Seleccionar un municipio</option>
						</select>
					</div>

					<!-- NOMBRE PARROQUIA-->
					<div class="form-group"> 
						
						{!! Form::label('par_nombre','Nombre') !!}

						{!! Form::text('par_nombre',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre de la parroquia.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
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
@endsection
