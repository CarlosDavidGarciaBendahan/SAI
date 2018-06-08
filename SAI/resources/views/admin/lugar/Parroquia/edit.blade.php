@extends('admin.template.main2')

@section('title', 'Editar parroquia '. $parroquia->par_nombre)

@section('contenido-header-name', 'Parroquia')

@section('contenido-header-name2', 'edición de parroquia')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('parroquia.index') }}"> Parroquia</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => ['parroquia.update',$parroquia], 'method' => 'PUT' ]) !!}
					
					<!-- SELECT ESTADO-->
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm " name="estado" id="estado" required="true">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								@if ($parroquia->municipio->estado->id === $estado->id)
									
									<option value="{{ $estado->id }}" selected="true"> {{ $estado->est_nombre }}</option>
								@else

									<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
								@endif
							@endforeach
						</select>
					</div>
					<!-- SELECT MUNICIPIO-->
					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="par_fk_municipio" id="municipio" required="true">
							<option value=""> Seleccionar un municipio</option>
						</select>
					</div>
					<!-- NOMBRE PARROQUIA-->
					<div class="form-group"> 
						
						{!! Form::label('par_nombre','Nombre') !!}

						{!! Form::text('par_nombre',$parroquia->par_nombre,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre de la parroquia.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>
					
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('parroquia.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
	

@endsection
@section('scripts')
	
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/SeleccionarEstadoEnSelect.js') }}"></script>
	
@endsection