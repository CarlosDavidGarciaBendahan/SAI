@extends('admin.template.main')

@section('title', 'Consultar articulo')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'producto_articulo.store', 'method' => 'GET' ]) !!}
					
					
						<div class="form-group ">
							<label>Oficina </label>
							<select class="form-control input-sm" name="oficina" id="oficina">
								<option value=""> Seleccionar oficina</option>
								@foreach ($oficinas as $oficina)

									@if ($producto_articulo->sector->oficina->id === $oficina->id)
										<option value="{{ $oficina->id }}" selected="true"> {{ $oficina->ofi_direccion }}</option>
									@else
										<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
									@endif

									
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Sector</label>
							<select class="form-control input-sm" name="pro_art_fk_sector" id="sector">
								@foreach ($sectores as $sector)

								@if ($sector->oficina->id === $producto_articulo->sector->oficina->id )
									@if ($producto_articulo->sector->id === $sector->id)
										<option value="{{ $sector->id }}" selected="true"> {{ $sector->sec_sector }}</option>
									@else
										<option value="{{ $sector->id }}"> {{ $sector->sec_sector }}</option>
									@endif
								@endif
									

									
								@endforeach
							</select>
						</div>

						<div class="form-group ">
							<label>Marca </label>
							<select class="form-control input-sm" name="marca" id="marca">
								<option value=""> Seleccionar oficina</option>
								@foreach ($marcas as $marca)

									@if ($producto_articulo->modelo->marca->id === $marca->id)
										<option value="{{ $marca->id }}" selected="true"> {{ $marca->mar_marca }}</option>
									@else
										<option value="{{ $marca->id }}"> {{ $marca->mar_marca }}</option>
									@endif

									
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Modelo</label>
							<select class="form-control input-sm" name="pro_art_fk_modelo" id="modelo">
								@foreach ($modelos as $modelo)

								@if ($modelo->marca->id === $producto_articulo->modelo->marca->id)
									@if ($producto_articulo->modelo->id === $modelo->id)
										<option value="{{ $modelo->id }}" selected="true"> {{ $modelo->mod_modelo }}</option>
									@else
										<option value="{{ $modelo->id }}"> {{ $modelo->mod_modelo }}</option>
									@endif
								@endif
									

									
								@endforeach>
							</select>
						</div>
					
						<div class="form-group ">
							<label>Tipo de producto </label>
							<select class="form-control input-sm" name="pro_art_fk_tipo_producto" id="tipo_producto">
								@foreach ($tipo_productos as $tipo)

									@if ($producto_articulo->tipo_producto->id === $tipo->id)
										<option value="{{ $tipo->id }}" selected="true"> {{ $tipo->tip_tipo }}</option>
									@else
										<option value="{{ $tipo->id }}"> {{ $tipo->tip_tipo }}</option>
									@endif

									
								@endforeach>
							</select>
						</div>

						<div class="form-group ">
							{!! Form::label('pro_art_codigo','Código') !!}
							{!! Form::text('pro_art_codigo',$producto_articulo->pro_art_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('pro_art_descripcion','Descripcion') !!}
							{!! Form::text('pro_art_descripcion',$producto_articulo->pro_art_descripcion,['class'=> 'form-control', 'placeholder'=>'computador excelente para oficina', 'required']) !!}
						</div>
					


						<div class="form-group ">
							{!! Form::label('pro_art_precio','Precio') !!}
							{!! Form::text('pro_art_precio',$producto_articulo->pro_art_precio,['class'=> 'form-control', 'placeholder'=>'80', 'required']) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_moneda','Moneda') !!}
							{!! Form::select('pro_art_moneda',['$'=>'$','Bs'=>'Bs'], $producto_articulo->pro_art_moneda, ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_cantidad','Cantidad del producto') !!}
							{!! Form::text('pro_art_cantidad',$producto_articulo->pro_art_cantidad,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('pro_art_catalogo','Publicado') !!}
							{!! Form::select('pro_art_catalogo',[0=>'NO',1=>'SI'], $producto_articulo->pro_art_catalogo, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_capacidad','capacidad del producto') !!}
							{!! Form::text('pro_art_capacidad',$producto_articulo->pro_art_capacidad,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							<label>Unidad de medida </label>
							<select class="form-control input-sm" name="pro_art_fk_unidadmedida" id="unidadmedida">
								<option value=""> Seleccionar unidad de medida</option>
								@foreach ($unidadmedidas as $unidadmedida)
									@if ($unidadmedida->id === $producto_articulo->unidadmedida->id)
										<option value="{{ $unidadmedida->id }}" selected="true"> {{ $unidadmedida->uni_medida }}</option>
									@else
										<option value="{{ $unidadmedida->id }}"> {{ $unidadmedida->uni_medida }}</option>
									@endif
									
								@endforeach
							</select>
						</div>
						<div>
							<a href="{{ route('producto_articulo.index') }}" class="btn btn-info">
						      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
						     </a>
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