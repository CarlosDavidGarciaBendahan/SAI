@extends('admin.template.main2')

@section('title', 'Modificar artículo')

@section('contenido-header-name', 'Edición de artículo')

@section('contenido-header-name2', 'editar artículo')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Artículo</a></li>
        <li class="active">Editar</li>
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
				{!! Form::open(['route' => ['producto_articulo.update',$producto_articulo], 'method' => 'PUT', 'files' => 'true'  ]) !!}
					
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group ">
									<label>Oficina </label>
									<select class="form-control input-sm" name="oficina" id="oficina" required="true">
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
									<select class="form-control input-sm" name="pro_art_fk_sector" id="sector" required="true">
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
									<select class="form-control input-sm" name="marca" id="marca" required="true">
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
									<select class="form-control input-sm" name="pro_art_fk_modelo" id="modelo" required="true">
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
									<select class="form-control input-sm" name="pro_art_fk_tipo_producto" id="tipo_producto" required="true">
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
									{!! Form::text('pro_art_codigo',$producto_articulo->pro_art_codigo,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 3 max: 100', 'placeholder'=>'B201223.', 'required', 'minlength'=>'3', 'maxlength' => '100', 'pattern'=>'[A-za-z0-9]+']) !!}
								</div>
								<div class="form-group ">
									{!! Form::label('pro_art_descripcion','Descripcion') !!}
									{!! Form::text('pro_art_descripcion',$producto_articulo->pro_art_descripcion,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 10 max: 100', 'placeholder'=>'B201223.', 'required', 'minlength'=>'10', 'maxlength' => '100', 'pattern'=>'[A-za-z0-9 ]+']) !!}
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group ">
							{!! Form::label('pro_art_precio','Precio') !!}
							{!! Form::text('pro_art_precio',$producto_articulo->pro_art_precio,['class'=> 'form-control', 'title'=>'Solo números de 0-9,  max: 10, con 2 decimales', 'placeholder'=>'352.25', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+[.]?[0-9]?[0-9]?']) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_moneda','Moneda') !!}
							{!! Form::select('pro_art_moneda',['$'=>'$','Bs'=>'Bs'], $producto_articulo->pro_art_moneda, ['class'=>'form-control', 'placeholder'=>'$', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_cantidad','Cantidad del producto') !!}
							{!! Form::text('pro_art_cantidad',$producto_articulo->pro_art_cantidad,['class'=> 'form-control',  'title'=>'Solo números de 0-9,  max: 10', 'placeholder'=>'1542.', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('pro_art_catalogo','Publicado') !!}
							{!! Form::select('pro_art_catalogo',[0=>'NO',1=>'SI'], $producto_articulo->pro_art_catalogo, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
					
						<div class="form-group ">
							{!! Form::label('pro_art_capacidad','capacidad del producto') !!}
							{!! Form::text('pro_art_capacidad',$producto_articulo->pro_art_capacidad,['class'=> 'form-control', 'title'=>'Solo números de 0-9,  max: 10. maximo 2 decimales', 'placeholder'=>'2.53', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+[.]?[0-9]?[0-9]?']) !!}
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

						
							</div>

							<div class="col-sm-12">
								<table class="table table-inverse">
						<thead>
						    <tr>
						      <th>Código</th>
						      <th>Estado</th>
						    </tr>
						</thead>
						<tbody>

					  	@foreach ($codigosArticulo as $codigoArticulo)
					  		<tr>
						      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
						      <td>
						      	@if ($codigoArticulo->cod_art_estado === 'B')
						      		Bueno
						      	@else
						      		Malo
						      	@endif

						      </td>		
						     
					     
					      <!--
					      	
					      <td>
					      	<a href="{{ route('codigoArticulo.edit', $codigoArticulo->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('codigoArticulo.destroy', $codigoArticulo->id) }}" onclick="return confirm('Eliminar el codigoArticulo?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('codigoArticulo.show', $codigoArticulo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>

					      	<a href="{{ route('codigoArticulo.create', $codigoArticulo->id) }}" class="btn btn-success" title="Agregar PCs">
					      		<span class="glyphicon glyphicon-plus-sign"></span>
					      	</a>
					      </td>
					 		 -->
				    	</tr>
					  	@endforeach

					  	</tbody>

					</table>
					{{ $codigosArticulo->links() }}


					<div class="form-group col-sm-12"> 
						
							{!! Form::label('ima','Imagen') !!}

						    {!! Form::file('imagen',['class'=>'col-sm-12','id'=>'file', 'onchange'=>'return fileValidation()'])!!}

							<!-- File input field 
							<input class="col-sm-12" type="file" name="imagen" id="file" onchange="return fileValidation()"/>
							--><br>
							<!-- Image preview -->
							
								
							<div class="" id="imagePreview">
								
							</div>
							

					</div>
							</div>
						</div>
					
						
					


						
					<div class="form-group col-sm-12"> 
						<div class="form-group">
							{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
							<a href="{{ route('producto_articulo.index') }}" class="btn btn-danger">Calcelar</a>
						</div>
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
