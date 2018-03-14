@extends('admin.template.main')

@section('title', 'Crear articulo')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'producto_articulo.store', 'method' => 'POST' ]) !!}
					
					
						<div class="form-group ">
							<label>Oficina </label>
							<select class="form-control input-sm" name="oficina" id="oficina">
								<option value=""> Seleccionar oficina</option>
								@foreach ($oficinas as $oficina)
									<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Sector</label>
							<select class="form-control input-sm" name="pro_art_fk_sector" id="sector">
								<option value=""> Seleccionar sector</option>
							</select>
						</div>

						<div class="form-group ">
							<label>Marca </label>
							<select class="form-control input-sm" name="marca" id="marca">
								<option value=""> Seleccionar oficina</option>
								@foreach ($marcas as $marca)
									<option value="{{ $marca->id }}"> {{ $marca->mar_marca }}</option>
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Modelo</label>
							<select class="form-control input-sm" name="pro_art_fk_modelo" id="modelo">
								<option value=""> Seleccionar sector</option>
							</select>
						</div>
					
						<div class="form-group ">
							<label>Tipo de producto </label>
							<select class="form-control input-sm" name="pro_art_fk_tipo_producto" id="tipo_producto">
								<option value=""> Seleccionar un tipo</option>
								@foreach ($tipo_productos as $tipo)
									<option value="{{ $tipo->id }}"> {{ $tipo->tip_tipo }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group ">
							{!! Form::label('pro_art_codigo','Código') !!}
							{!! Form::text('pro_art_codigo',null,['class'=> 'form-control', 'placeholder'=>'B208802', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('pro_art_descripcion','Descripcion') !!}
							{!! Form::text('pro_art_descripcion',null,['class'=> 'form-control', 'placeholder'=>'articulo excelente para oficina', 'required']) !!}
						</div>
					


						<div class="form-group ">
							{!! Form::label('pro_art_precio','Precio') !!}
							{!! Form::text('pro_art_precio',null,['class'=> 'form-control', 'placeholder'=>'80', 'required']) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_moneda','Moneda') !!}
							{!! Form::select('pro_art_moneda',['$'=>'$','Bs'=>'Bs'], null, ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_cantidad','Cantidad del producto') !!}
							{!! Form::text('pro_art_cantidad',null,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('pro_art_catalogo','Publicado') !!}
							{!! Form::select('pro_art_catalogo',[0=>'NO',1=>'SI'], 1, ['class'=>'form-control', 'placeholder'=>'SI', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_capacidad','capacidad del producto') !!}
							{!! Form::text('pro_art_capacidad',null,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							<label>Unidad de medida </label>
							<select class="form-control input-sm" name="pro_art_fk_unidadmedida" id="unidadmedida">
								<option value=""> Seleccionar unidad de medida</option>
								@foreach ($unidadmedidas as $unidadmedida)
									<option value="{{ $unidadmedida->id }}"> {{ $unidadmedida->uni_medida }}</option>
								@endforeach
							</select>
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
	<script src="{{ asset('plugins/Script/ObtenerSectoresPorOficina.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerModelosPorMarca.js') }}"></script>
@endsection
