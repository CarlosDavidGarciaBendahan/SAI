@extends('admin.template.main2')

@section('title', 'Editar oficina '. $oficina->ofi_direccion)

@section('contenido-header-name', 'Edición de oficina')

@section('contenido-header-name2', 'editar oficina')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('oficina.index') }}"> Oficina</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['oficina.update',$oficina], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado" required="true">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="municipio" id="municipio" required="true">
							<option value=""> Seleccionar un municipio</option>
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="ofi_fk_parroquia" id="parroquia" required="true">
							<option value=""> Seleccionar una parroquia</option>
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('ofi_tipo','Tipo de oficina') !!}
						{!! Form::select('ofi_tipo',['local'=>'Local', 'almacen'=>'Almacen'], $oficina->ofi_tipo, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('ofi_direccion','Dirección') !!}

						{!! Form::text('ofi_direccion',$oficina->ofi_direccion,['class'=> 'form-control',  'title'=>'Solo letras mayúsculas, minúsculas, la coma (,), punto (.) y números de 0-9, min: 10 max: 250', 'placeholder'=>'dirección.', 'required', 'minlength'=>'10', 'maxlength' => '250', 'pattern'=>'[A-za-z0-9,. ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('oficina.index') }}" class="btn btn-danger">Calcelar</a>
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
