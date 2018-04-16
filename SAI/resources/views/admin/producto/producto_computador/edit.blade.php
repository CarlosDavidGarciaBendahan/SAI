@extends('admin.template.main')

@section('title', 'Modificar computador')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['producto_computador.update',$producto_computador], 'method' => 'PUT' ]) !!}
					
					
						<div class="form-group ">
							<label>Oficina </label>
							<select class="form-control input-sm" name="oficina" id="oficina">
								<option value=""> Seleccionar oficina</option>
								@foreach ($oficinas as $oficina)

									@if ($producto_computador->sector->oficina->id === $oficina->id)
										<option value="{{ $oficina->id }}" selected="true"> {{ $oficina->ofi_direccion }}</option>
									@else
										<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
									@endif

									
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Sector</label>
							<select class="form-control input-sm" name="pro_com_fk_sector" id="sector">
								@foreach ($sectores as $sector)

								@if ($sector->oficina->id === $producto_computador->sector->oficina->id )
									@if ($producto_computador->sector->id === $sector->id)
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

									@if ($producto_computador->modelo->marca->id === $marca->id)
										<option value="{{ $marca->id }}" selected="true"> {{ $marca->mar_marca }}</option>
									@else
										<option value="{{ $marca->id }}"> {{ $marca->mar_marca }}</option>
									@endif

									
								@endforeach
							</select>
						</div>
					
						<div class="form-group ">
							<label>Modelo</label>
							<select class="form-control input-sm" name="pro_com_fk_modelo" id="modelo">
								@foreach ($modelos as $modelo)

								@if ($modelo->marca->id === $producto_computador->modelo->marca->id)
									@if ($producto_computador->modelo->id === $modelo->id)
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
							<select class="form-control input-sm" name="pro_com_fk_tipo_producto" id="tipo_producto">
								@foreach ($tipo_productos as $tipo)

									@if ($producto_computador->tipo_producto->id === $tipo->id)
										<option value="{{ $tipo->id }}" selected="true"> {{ $tipo->tip_tipo }}</option>
									@else
										<option value="{{ $tipo->id }}"> {{ $tipo->tip_tipo }}</option>
									@endif

									
								@endforeach>
							</select>
						</div>

						<div class="form-group ">
							{!! Form::label('pro_com_codigo','Código') !!}
							{!! Form::text('pro_com_codigo',$producto_computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('pro_com_descripcion','Descripcion') !!}
							{!! Form::text('pro_com_descripcion',$producto_computador->pro_com_descripcion,['class'=> 'form-control', 'placeholder'=>'computador excelente para oficina', 'required']) !!}
						</div>
					


						<div class="form-group ">
							{!! Form::label('pro_com_precio','Precio') !!}
							{!! Form::text('pro_com_precio',$producto_computador->pro_com_precio,['class'=> 'form-control', 'placeholder'=>'80', 'required']) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_com_moneda','Moneda') !!}
							{!! Form::select('pro_com_moneda',['$'=>'$','Bs'=>'Bs'], $producto_computador->pro_com_moneda, ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_com_cantidad','Cantidad del producto') !!}
							{!! Form::text('pro_com_cantidad',$producto_computador->pro_com_cantidad,['class'=> 'form-control', 'placeholder'=>'0', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('pro_com_catalogo','Publicado') !!}
							{!! Form::select('pro_com_catalogo',[0=>'NO',1=>'SI'], $producto_computador->pro_com_catalogo, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
					
						<div class="form-group"> 
						
						{!! Form::label('Componentes','Componentes') !!}

						{!! Form::select('componentes[]',$producto_articulos,$producto_computador->articulos->pluck('id'),['class'=> 'form-control select-componentes', 'placeholder'=>'seleccionar componentes', 'multiple','required']) !!}
						</div>

						<table class="table table-inverse">
						<thead>
						    <tr>
						      <th>Código</th>
						      <th>Estado</th>
						    </tr>
						</thead>
						<tbody>

					  	@foreach ($codigosPC as $codigoPC)
					  		<tr>
						      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
						      <td>
						      	@if ($codigoPC->cod_pc_estado === 'B')
						      		Bueno
						      	@else
						      		Malo
						      	@endif

						      </td>	
						     
					     
					      
					      	
					      <td>
					      	
					      	<a href="{{ route('codigoPC.edit', $codigoPC->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	<!--
					      	<a href="{{ route('codigoPC.destroy', $codigoPC->id) }}" onclick="return confirm('Eliminar el codigoPC?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('codigoPC.show', $codigoPC->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>

					      	<a href="{{ route('codigoPC.create', $codigoPC->id) }}" class="btn btn-success" title="Agregar PCs">
					      		<span class="glyphicon glyphicon-plus-sign"></span>
					      	</a>
					      	-->
					      </td>
					 		 
				    	</tr>
					  	@endforeach

					  	</tbody>

					</table>
					{{ $codigosPC->links() }}		
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerSectoresPorOficina.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerModelosPorMarca.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelectorComponentes.js') }}"></script>
@endsection
