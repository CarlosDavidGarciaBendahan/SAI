@extends('admin.template.main')

@section('title', 'Crear empresa')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'empresa.store', 'method' => 'POST']) !!}
					
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
						<select class="form-control input-sm" name="emp_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('emp_direccion','Direccion') !!}
						{!! Form::text('emp_direccion',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('emp_nombre','Nombre') !!}
						{!! Form::text('emp_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('emp_identificador','Identificador') !!}
						{!! Form::select('emp_identificador',['J'=>'J','G'=>'G','C'=>'C'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('emp_rif','RIF') !!}

						{!! Form::text('emp_rif',null,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Agregar Correo',['class'=>'btn btn-primary', 'id' => 'addCorreo']) !!}
					</div>

					<div class="correos">
						
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

	<script>
		$(document).ready(function(){
			var btn_correo = $('#addCorreo');
			var correos = $('.correos');
			var html = ""
			
			$(btn_correo).click(function(event){
				event.preventDefault();
				console.log('preciono button agregar correo');

				$(correos).append(" <div> <p> Test  <a href='' class='remove btn btn-info'> <span class='glyphicon glyphicon-arrow-left'></span> quitar</a> </p> </div>");
			});

			$(correos).on('click','.remove',function(event){
				event.preventDefault();
				console.log('preciono button Eliminar correo');

				$(this).parent().remove();
			});
		});
	</script>

@endsection
