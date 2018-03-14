@extends('admin.template.main')

@section('title', 'Crear computador')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'producto_computador.store', 'method' => 'POST' ]) !!}
					
					
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
							<select class="form-control input-sm" name="pro_com_fk_sector" id="sector">
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
							<select class="form-control input-sm" name="pro_com_fk_modelo" id="modelo">
								<option value=""> Seleccionar sector</option>
							</select>
						</div>
					
						<div class="form-group ">
							<label>Tipo de producto </label>
							<select class="form-control input-sm" name="pro_com_fk_tipo_producto" id="tipo_producto">
								<option value=""> Seleccionar un tipo</option>
								@foreach ($tipo_productos as $tipo)
									<option value="{{ $tipo->id }}"> {{ $tipo->tip_tipo }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group ">
							{!! Form::label('pro_com_codigo','Código') !!}
							{!! Form::text('pro_com_codigo',null,['class'=> 'form-control', 'placeholder'=>'B208802', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('pro_com_descripcion','Descripcion') !!}
							{!! Form::text('pro_com_descripcion',null,['class'=> 'form-control', 'placeholder'=>'computador excelente para oficina', 'required']) !!}
						</div>
					


						<div class="form-group ">
							{!! Form::label('pro_com_precio','Precio') !!}
							{!! Form::text('pro_com_precio',null,['class'=> 'form-control', 'placeholder'=>'80', 'required']) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_com_moneda','Moneda') !!}
							{!! Form::select('pro_com_moneda',['$'=>'$','Bs'=>'Bs'], null, ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_com_cantidad','Cantidad del producto') !!}
							{!! Form::text('pro_com_cantidad',null,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('pro_com_catalogo','Publicado') !!}
							{!! Form::select('pro_com_catalogo',[0=>'NO',1=>'SI'], 1, ['class'=>'form-control', 'placeholder'=>'SI', 'required'] ) !!}
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
