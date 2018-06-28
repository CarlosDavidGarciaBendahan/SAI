@extends('admin.template.main2')

@section('title', 'Modificar Venta')

@section('contenido-header-name', 'Edición de solicitud')

@section('contenido-header-name2', 'editar la solicitud')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('solicitud.index') }}"> Solicitud</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['solicitud.update',$solicitud], 'method' => 'PUT']) !!}
					
					<div class="form-group">
						{!! Form::label('venta','Nota de entrega asociada',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Nota de entraga #".$solicitud->notaEntrega->id." efectuada en la fecha: ".date("d/m/Y", strtotime($solicitud->notaEntrega->not_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Solicitud',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Solicitud #".$solicitud->id,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Tipo de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::select('sol_tipo',['cambio'=>'Cambio de producto','devolucion' => 'Devolución del producto'], $solicitud->sol_tipo, ['class'=>'form-control col-sm input-sm ', 'placeholder'=>'', 'required'] ) !!}
							
					</div>

					<div class="form-group">
						{!! Form::label('venta','Fecha de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',date("d/m/Y", strtotime($solicitud->sol_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Concepto de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',$solicitud->sol_concepto,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y numeros de 0-9, min: 10 max: 50', 'placeholder'=>'Concepto.', 'required', 'minlength'=>'10', 'maxlength' => '50', 'pattern'=>'[A-za-z0-9 ]+']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Estado de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::select('sol_aprobado',['S'=>'Aprobar la solicitud','N' => 'Rechazar solicutd'], $solicitud->sol_aprobado, ['class'=>'form-control input-sm ', 'placeholder'=>'', 'required'] ) !!}
							
					</div>

					<div class="form-group">
						{!! Form::label('venta','Observaciones',['class'=> '']) !!}
						{!! Form::textarea('sol_observaciones',$solicitud->sol_observaciones,['class'=> 'form-control',  'title'=>'Solo letras mayúsculas o minúsculas, min: 10 max: 200', 'placeholder'=>'Observaciones', 'required', 'minlength'=>'10', 'maxlength' => '200', 'required']) !!}	
					</div>

					<!-- VERIFICAR... PORQUE CREO QUE LOS PRODUCTOS MOSTRADOS DEBEN ESTAR EN LA SOLICITUD!! NO EN LA NOTA DE ENTREGA... O VERIFICAR LA CONDICIONES DE ABAJO!!!-->
					<div>	
						{!! Form::label('venta','Elegir productos a cambiar',['class'=> '']) !!}
						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>Código</th>
						      <th>Marca/Modelo</th>
						      <th>Tipo</th>
						      <th>Componentes</th>
						      <th>Costo</th>
						      <th>Agregar/Quitar</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($solicitud->notaEntrega->venta->ventaPCs as $codigoPC)
						  	
						  		<tr>
							      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
							      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
							      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
							      	
							      <td>
							      	@foreach ($codigoPC->CodigoArticulos as $componente)
							      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
							      	@endforeach
							  	  </td>	
							  	  <td>
							  	  	{{ $codigoPC->producto_computador->pro_com_precio." ".$codigoPC->producto_computador->pro_com_moneda }}
							  	  </td>
							  	  <!--<td>
							  	  	@ if ($CodigoPCs->contains($codigoPC)) 
							  	  		
							  	  		@ if (count($codigoPC->solicitudes)===0)
							  	  			<a href=" { { route('solicitud.agregarProducto', [$solicitud->id,$codigoPC->id,'pc',true]) }}" onclick="return confirm('Seguro que desea agregar este computador de la solicitud?')" class="btn btn-success" title="Agregar producto de esta solicitud">
									      		<span class="class glyphicon glyphicon-ok"></span>
								      		</a> 
								      	@ else
								      		@ foreach ($codigoPC->solicitudes as $sol)
								  	  			@ if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
									  	  			@ if ($solicitud->id >= $sol->id)

									  	  				<a href=" { { route('solicitud.eliminarProducto', [$solicitud->id,$codigoPC->id,'pc',true]) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
												      		<span class="class glyphicon glyphicon-remove-circle"></span>
											      		</a> 
											      	@ else
											      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
												      		<span class="class glyphicon glyphicon-thumbs-down"></span>
											      		</a> 
									  	  			@ endif

								  	  			@ endif
								  	  		@ endforeach
							  	  		@ endif
							      		
							  	  	
							  	  	@ else
							  	  		@ foreach ($codigoPC->solicitudes as $sol)
							  	  			@ if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
								  	  			@ if ($solicitud->id >= $sol->id)
								  	  				<a href=" { { route('solicitud.eliminarProducto', [$solicitud->id,$codigoPC->id,'pc',true]) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
											      		<span class="class glyphicon glyphicon-remove-circle"></span>
										      		</a> 
										      	@ else
										      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
											      		<span class="class glyphicon glyphicon-thumbs-down"></span>
										      		</a> 
								  	  			@ endif
							  	  			@ endif

							  	  		@ endforeach
							  	  	@ endif
							  	  </td>
							  	-->
							  	<td>
					  	  	@if ($CodigoPCs->contains($codigoPC)) 
					  	  		
					  	  		@if (count($codigoPC->solicitudes)===0)
					  	  			<a href="{{ route('solicitud.agregarProducto', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea agregar este computador de la solicitud?')" class="btn btn-success" title="Agregar producto de esta solicitud">
							      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a> 
						      	@else
						      		@foreach ($codigoPC->solicitudes as $sol)
						  	  			@if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
							  	  			@if ($solicitud->id <= $sol->id)
							  	  				<a href="{{ route('solicitud.eliminarProducto', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
										      		<span class="class glyphicon glyphicon-remove-circle"></span>
									      		</a> 
									      	@else
									      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
										      		<span class="class glyphicon glyphicon-thumbs-down"></span>
									      		</a> 
							  	  			@endif
						  	  			@endif

						  	  		@endforeach
					  	  		@endif
					      		
					  	  	
					  	  	@else
					  	  		@foreach ($codigoPC->solicitudes as $sol)
					  	  			@if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
						  	  			@if ($solicitud->id <= $sol->id)
						  	  				<a href="{{ route('solicitud.eliminarProducto', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
									      		<span class="class glyphicon glyphicon-remove-circle"></span>
								      		</a> 
								      	@else
								      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
									      		<span class="class glyphicon glyphicon-thumbs-down"></span>
								      		</a> 
						  	  			@endif
					  	  			@endif

					  	  		@endforeach
					  	  	@endif
					  	  </td>
							  	  
						    	</tr>
						  	
						  		
						  	@endforeach
<!-- ************************************************************************************************-->
@foreach ($solicitud->notaEntrega->solicitudes as $solicitud)
	@foreach ($solicitud->CodigoPCsEntregado as $codigoPC)
						  	
						  		<tr>
							      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
							      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
							      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
							      	
							      <td>
							      	@foreach ($codigoPC->CodigoArticulos as $componente)
							      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
							      	@endforeach
							  	  </td>	
							  	  <td>
							  	  	{{ $codigoPC->producto_computador->pro_com_precio." ".$codigoPC->producto_computador->pro_com_moneda }}
							  	  </td>
	<td>
					  	  	
					  	  		
					  	  		@if (count($codigoPC->solicitudes)===0)
					  	  			<a href="{{ route('solicitud.agregarProducto', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea agregar este computador de la solicitud?')" class="btn btn-success" title="Agregar producto de esta solicitud">
							      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a> 
						      	@else
						      		@foreach ($codigoPC->solicitudes as $sol)
						  	  			@if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
							  	  			@if ($solicitud->id <= $sol->id)
							  	  				<a href="{{ route('solicitud.eliminarProducto', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
										      		<span class="class glyphicon glyphicon-remove-circle"></span>
									      		</a> 
									      	@else
									      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
										      		<span class="class glyphicon glyphicon-thumbs-down"></span>
									      		</a> 
							  	  			@endif
						  	  			@endif

						  	  		@endforeach
					  	  		@endif
					      		
					  	  	
					  	  	
					  	  </td>
							  	  
						    	</tr>
						  	
						  		
						  	@endforeach
@endforeach
<!-- ************************************************************************************************-->

						  	@foreach ($solicitud->notaEntrega->venta->ventaArticulos as  $codigoArticulo)
						  	
						  		<tr>
							      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
							      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
							      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
							     <td>
							  	  	{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}
							  	  </td>
							      <td>
							  	  	{{ $codigoArticulo->producto_articulo->pro_art_precio." ".$codigoArticulo->producto_articulo->pro_art_moneda }}
							  	  </td>
							  	  <td>
							  	  	@if ($CodigoArticulos->contains($codigoArticulo)) 
							  	  		@if (count($codigoArticulo->solicitudes)===0)
							  	  			<a href="{{ route('solicitud.agregarProducto', [$solicitud->id,$codigoArticulo->id,'articulo',true]) }}" onclick="return confirm('Seguro que desea agregar este artículo de la solicitud?')" class="btn btn-success" title="Agregar producto de esta solicitud">
									      		<span class="class glyphicon glyphicon-ok"></span>
								      		</a> 
								      	@else
								      		@foreach ($codigoArticulo->solicitudes as $sol)
								  	  			@if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
									  	  			@if ($solicitud->id >= $sol->id)
									  	  				<a href="{{ route('solicitud.eliminarProducto', [$solicitud->id,$codigoArticulo->id,'articulo',true]) }}" onclick="return confirm('Seguro que desea quitar este artículo de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
												      		<span class="class glyphicon glyphicon-remove-circle"></span>
											      		</a> 
											      	@else
											      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
												      		<span class="class glyphicon glyphicon-thumbs-down"></span>
											      		</a> 
									  	  			@endif
								  	  			@endif

								  	  		@endforeach
							  	  		@endif
							  	  		
							  	  	@else
							  	  		@foreach ($codigoArticulo->solicitudes as $sol)
							  	  			@if ($sol->sol_aprobado === 'S'  && $solicitud->sol_fecha >= $sol->sol_fecha )					  	  		
								  	  			@if ($solicitud->id >= $sol->id)
								  	  				<a href="{{ route('solicitud.eliminarProducto', [$solicitud->id,$codigoArticulo->id,'articulo',true]) }}" onclick="return confirm('Seguro que desea quitar este artículo de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
											      		<span class="class glyphicon glyphicon-remove-circle"></span>
										      		</a> 
										      	@else
										      		<a  class="btn btn-default" title="Producto NO disponible para esta solicitud. Ya ha sido ingresado en una solicitud anterior.">
											      		<span class="class glyphicon glyphicon-thumbs-down"></span>
										      		</a> 
								  	  			@endif
							  	  			@endif

							  	  		@endforeach
							  	  		
							  	  	@endif
							  	  </td>
							        
						    	</tr>
						  	
						  	@endforeach
						  </tbody>

						</table>
				</div>


				<div>
					@if ($solicitud->sol_tipo === 'cambio')
						{{-- expr --}}
					
						@if (count($solicitud->CodigoPCsEntregado) !== 0)
						{!! Form::label('venta','Productos que se entregarán por cambio',['class'=> ' col-sm']) !!}
						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>Código</th>
						      <th>Marca/Modelo</th>
						      <th>Tipo</th>
						      <th>Componentes</th>
						      <th>Costo</th>
						      <th>Quitar</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($solicitud->CodigoPCsEntregado as $codigoPC)
						  	
						  		<tr>
							      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
							      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
							      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
							      	
							      <td>
							      	@foreach ($codigoPC->CodigoArticulos as $componente)
							      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
							      	@endforeach
							  	  </td>	
							  	  <td>
							  	  	{{ $codigoPC->producto_computador->pro_com_precio." ".$codigoPC->producto_computador->pro_com_moneda }}
							  	  </td>
							  	  <td>
							  	  	<a href="{{ route('solicitud.eliminarProductoCambio', [$solicitud->id,$codigoPC->id,'pc',true]) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
										<span class="class glyphicon glyphicon-remove-circle"></span>
									</a> 
							  	  </td>
						    	</tr>
						  	
						  		
						  	@endforeach
						  	@foreach ($solicitud->CodigoArticulosEntregado as  $codigoArticulo)
						  	
						  		<tr>
							      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
							      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
							      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
							     <td>
							  	  	{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}
							  	  </td>
							      <td>
							  	  	{{ $codigoArticulo->producto_articulo->pro_art_precio." ".$codigoArticulo->producto_articulo->pro_art_moneda }}
							  	  </td>
							  	  <td>
							  	  	<a href="{{ route('solicitud.eliminarProductoCambio', [$solicitud->id,$codigoPC->id,'articulo',true]) }}" onclick="return confirm('Seguro que desea quitar este artículo de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
										<span class="class glyphicon glyphicon-remove-circle"></span>
								</a>
							  	  </td>
						    	</tr>
						  	
						  	@endforeach
						  </tbody>

						</table>
						@endif
						@endif
					</div>



					<div>	
					@if ($solicitud->sol_tipo === 'cambio')
						{!! Form::label('venta','Productos disponibles para cambiar',['class'=> ' col-sm']) !!}
					<table class="table table-inverse">
					  <thead>
					    <tr>
					      <th>Código</th>
					      <th>Marca/Modelo</th>
					      <th>Tipo</th>
					      <th>Componentes</th>
					      <th>Costo</th>
					      <th>Agregar/Quitar</th>
					    </tr>
					  </thead>
					  <tbody>

					  	@foreach ($codigoPCsCambio as $codigoPC)
					  	
					  		<tr>
						      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
						      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
						      	
						      <td>
						      	@foreach ($codigoPC->CodigoArticulos as $componente)
						      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
						      	@endforeach
						  	  </td>	
						  	  <td>
						  	  	{{ $codigoPC->producto_computador->pro_com_precio." ".$codigoPC->producto_computador->pro_com_moneda }}
						  	  </td>
						  	  <td>
						  	  	@if (count($solicitud->CodigoPCsEntregado) < count($solicitud->CodigoPCs))
						  	  		<a href="{{ route('solicitud.agregarProductoCambio', [$solicitud->id,$codigoPC->id,'pc',true]) }}" onclick="return confirm('Seguro que desea agregar este computador de la solicitud?')" class="btn btn-primary" title="Agregar producto de esta solicitud">
								      	<span class="class glyphicon glyphicon-ok"></span>
							      	</a> 
						  	  	@else
						  	  		<a  class="btn btn-default" title="Se alcanzo el liminte de PCs a cambiar.">
											      		<span class="class glyphicon glyphicon-thumbs-down"></span>
									</a> 
						  	  	@endif
						  	  	
								
						  	  </td>
						  	  
					    	</tr>
					  	
					  		
					  	@endforeach
					  	@foreach ($codigoArticulosCambio as  $codigoArticulo)
					  	
					  		<tr>
						      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
						      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
						     <td>
						  	  	{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}
						  	  </td>
						      <td>
						  	  	{{ $codigoArticulo->producto_articulo->pro_art_precio." ".$codigoArticulo->producto_articulo->pro_art_moneda }}
						  	  </td>
						  	  <td>
						  	  	@if (count($solicitud->CodigoArticulosEntregado) < count($solicitud->CodigoArticulos))
									<a href="{{ route('solicitud.agregarProductoCambio', [$solicitud->id,$codigoPC->id,'articulo',true]) }}" onclick="return confirm('Seguro que desea agregar este artículo de la solicitud?')" class="btn btn-info" title="Agregar producto de esta solicitud">
								      	<span class="class glyphicon glyphicon-ok"></span>
							      		</a> 
								@else
						  	  		<a  class="btn btn-default" title="Se alcanzo el limite de artículos a cambiar.">
											      		<span class="class glyphicon glyphicon-thumbs-down"></span>
									</a> 
						  	  	@endif

						  	  	
								
						  	  </td>
						        
					    	</tr>
					  	
					  	@endforeach
					  </tbody>

					</table>
					@endif

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
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
@endsection
