@extends('admin.template.main2')

@section('title', 'Crear articulo')

@section('contenido-header-name', 'Registro de artículo')

@section('contenido-header-name2', 'crear artículo')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Artículo</a></li>
        <li class="active">Crear</li>
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
				{!! Form::open(['route' => 'producto_articulo.store', 'method' => 'POST', 'files' => 'true' ]) !!}
					
					
						<div class="form-group col-sm-6">
							<label>Oficina </label>
							<select class="form-control input-sm" name="oficina" id="oficina" required="true">
								<option value=""> Seleccionar oficina</option>
								@foreach ($oficinas as $oficina)
									<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group col-sm-6">
							<label>Sector</label>
							<select class="form-control input-sm" name="pro_art_fk_sector" id="sector" required="true">
								<option value=""> Seleccionar sector</option>
							</select>
						</div>

						<div class="form-group col-sm-6">
							<label>Marca </label>
							<select class="form-control input-sm" name="marca" id="marca" required="true">
								<option value=""> Seleccionar oficina</option>
								@foreach ($marcas as $marca)
									<option value="{{ $marca->id }}"> {{ $marca->mar_marca }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group col-sm-6">
							<label>Modelo</label>
							<select class="form-control input-sm" name="pro_art_fk_modelo" id="modelo" required="true">
								<option value=""> Seleccionar sector</option>
							</select>
						</div>
					
						<div class="form-group col-sm-6">
							<label>Tipo de producto </label>
							<select class="form-control input-sm" name="pro_art_fk_tipo_producto" id="tipo_producto" required="true">
								<option value=""> Seleccionar un tipo</option>
								@foreach ($tipo_productos as $tipo)
									<option value="{{ $tipo->id }}"> {{ $tipo->tip_tipo }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group col-sm-6">
							{!! Form::label('pro_art_codigo','Código') !!}
							{!! Form::text('pro_art_codigo',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 3 max: 100', 'placeholder'=>'B201223.', 'required', 'minlength'=>'3', 'maxlength' => '100', 'pattern'=>'[A-za-z0-9]+']) !!}
						</div>
						<div class="form-group col-sm-12">
							{!! Form::label('pro_art_descripcion','Descripcion') !!}
							{!! Form::text('pro_art_descripcion',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 10 max: 100', 'placeholder'=>'B201223.', 'required', 'minlength'=>'10', 'maxlength' => '100', 'pattern'=>'[A-za-z0-9 ]+']) !!}
						</div>
					


						<div class="form-group col-sm-6">
							{!! Form::label('pro_art_precio','Precio') !!}
							{!! Form::text('pro_art_precio',null,['class'=> 'form-control', 'title'=>'Solo números de 0-9,  max: 10, con 2 decimales', 'placeholder'=>'352.25', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+[.]?[0-9]?[0-9]?']) !!}
						</div>
					
						<div class="form-group col-sm-6">
							{!! Form::label('pro_art_moneda','Moneda') !!}
							{!! Form::select('pro_art_moneda',['$'=>'$'], '$', ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						

						
						<div class="form-group col-sm-6">
							{!! Form::label('pro_art_capacidad','capacidad del producto') !!}
							{!! Form::text('pro_art_capacidad',null,['class'=> 'form-control', 'title'=>'Solo números de 0-9,  max: 10. maximo 2 decimales', 'placeholder'=>'2.53', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+[.]?[0-9]?[0-9]?']) !!}
						</div>

						<div class="form-group col-sm-6">
							<label>Unidad de medida </label>
							<select class="form-control input-sm" name="pro_art_fk_unidadmedida" id="unidadmedida" required="true">
								<option value=""> Seleccionar unidad de medida</option>
								@foreach ($unidadmedidas as $unidadmedida)
									<option value="{{ $unidadmedida->id }}"> {{ $unidadmedida->uni_medida }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-sm-6">
							{!! Form::label('pro_art_catalogo','Publicado') !!}
							{!! Form::select('pro_art_catalogo',[0=>'NO',1=>'SI'], 1, ['class'=>'form-control', 'placeholder'=>'SI', 'required'] ) !!}
						</div>
						<div class="form-group col-sm-6 ">
							{!! Form::label('cantidad_minima','Cantidad mínima del producto') !!}
							{!! Form::text('cantidad_minima',null,['class'=> 'form-control', 'placeholder'=>'0', 'required', 'maxlength' => '5', 'pattern'=>'[0-9]+']) !!}
						</div>
						<div class="form-group col-sm-6"> 
						
							{!! Form::label('ima','Imagen') !!}

						    {!! Form::file('imagen',['class'=>'col-sm-12', 'required'=>'true','id'=>'file', 'onchange'=>'return fileValidation()'])!!}

							<!-- File input field 
							<input class="col-sm-12" type="file" name="imagen" id="file" onchange="return fileValidation()"/>
							--><br>
							<!-- Image preview -->
							
								
							<div class="" id="imagePreview">
								
							</div>
							

						</div>

						<div class="form-group col-sm-6">
							{{-- !! Form::label('pro_art_cantidad','Cantidad del producto') !!--}}
							{!! Form::text('pro_art_cantidad','0',['class'=> 'form-control hidden', 'readonly'=>'true','title'=>'Solo números de 0-9,  max: 10', 'placeholder'=>'1542.', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+']) !!}
						</div>


					<div class="form-group col-sm-12">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('producto_articulo.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerSectoresPorOficina.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerModelosPorMarca.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ValidarImage.js') }}"></script>
@endsection
