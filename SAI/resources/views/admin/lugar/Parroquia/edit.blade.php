@extends('admin.template.main')

@section('title', 'Editar parroquia '. $parroquia->par_nombre)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['parroquia.update',$parroquia], 'method' => 'PUT' ]) !!}
					

					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm " name="estado" id="estado" required="true">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="par_fk_municipio" id="municipio" required="true">
							<option value=""> Seleccionar un municipio</option>
						</select>
					</div>

					<div class="form-group"> 
						
						{!! Form::label('par_nombre','Nombre') !!}

						{!! Form::text('par_nombre',$parroquia->par_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre de la parroquia', 'required']) !!}
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
	<script src="{{ asset('plugins/Script/SeleccionarEstadoEnSelect.js') }}"></script>
	
@endsection