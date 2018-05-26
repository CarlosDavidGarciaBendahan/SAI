@extends('admin.template.main2')

@section('title', 'Crear Solicitud')

@section('contenido-header-name', 'Registro de solicitud')

@section('contenido-header-name2', 'registro de productos para cambiar')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('solicitud.index') }}"> Solicitud</a></li>
        <li class="active"><a href="{{ route('solicitud.listarNotas',0) }}"> Notas de entrega</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'solicitud.index', 'method' => 'GET' ]) !!}
					

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Tipo de solicitud') !!}
						{!! Form::select('sol_tipo',['cambio'=>'Cambio de producto','devolucion' => 'Devolución del producto'], $solicitud->sol_tipo, ['class'=>'form-control col-sm input-sm ', 'placeholder'=>'', 'required','enable'=>'false'] ) !!}
					</div>
					<div class="form-group col-sm-12"> 
						
						{!! Form::text('id',$solicitud->id,['class'=> 'form-control', 'placeholder'=>'', 'required', 'readonly'=>'true','hidden'=>'true']) !!}
					</div>
					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha') !!}

							{!! Form::text('sol_fecha',date("d/m/Y", strtotime($solicitud->sol_fecha)), array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control','readonly'=>'true')) !!}
					</div>
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Aprobación de la solicitud') !!}
						{!! Form::select('sol_aprobado',['S'=>'Aprobar la solicitud','N' => 'Rechazar solicutd'], $solicitud->sol_aprobado, ['class'=>'form-control input-sm ', 'placeholder'=>'', 'required'] ) !!}
					</div>
					<div class="form-group">
						{!! Form::label('venta','Concepto',['class'=> ' col-sm']) !!}
						{!! Form::text('sol_concepto',$solicitud->sol_concepto,['class'=> 'form-control', 'placeholder'=>'El computador no arranca', 'required','readonly'=>'true']) !!}	
					</div>

					<div>
						{!! Form::label('venta','Productos a cambiar',['class'=> ' col-sm']) !!}
						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>Código</th>
						      <th>Marca/Modelo</th>
						      <th>Tipo</th>
						      <th>Componentes</th>
						      <th>Costo</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($solicitud->CodigoPCs as $codigoPC)
						  	
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
						    	</tr>
						  	
						  		
						  	@endforeach
						  	@foreach ($solicitud->CodigoArticulos as  $codigoArticulo)
						  	
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
							  	  
						    	</tr>
						  	
						  	@endforeach
						  </tbody>

						</table>
					</div>



					<div>
						@if (count($solicitud->CodigoPCsEntregado) !== 0)
							{!! Form::label('venta','Productos Elegidos',['class'=> ' col-sm']) !!}
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
							  	  	<a href="{{ route('solicitud.eliminarProductoCambio', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea quitar este computador de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
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
							  	  	<a href="{{ route('solicitud.eliminarProductoCambio', [$solicitud->id,$codigoPC->id,'articulo']) }}" onclick="return confirm('Seguro que desea quitar este artículo de la solicitud?')" class="btn btn-danger" title="Quitar producto de esta solicitud">
										<span class="class glyphicon glyphicon-remove-circle"></span>
								</a>
							  	  </td>
						    	</tr>
						  	
						  	@endforeach
						  </tbody>

						</table>
						@endif
						
					</div>



					<div>	
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

				  	@foreach ($codigoPCs as $codigoPC)
				  	
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
					  	  		<a href="{{ route('solicitud.agregarProductoCambio', [$solicitud->id,$codigoPC->id,'pc']) }}" onclick="return confirm('Seguro que desea agregar este computador de la solicitud?')" class="btn btn-primary" title="Agregar producto de esta solicitud">
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
				  	@foreach ($codigoArticulos as  $codigoArticulo)
				  	
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
								<a href="{{ route('solicitud.agregarProductoCambio', [$solicitud->id,$codigoPC->id,'articulo']) }}" onclick="return confirm('Seguro que desea agregar este artículo de la solicitud?')" class="btn btn-info" title="Agregar producto de esta solicitud">
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
				</div>



				
				

				<div class="form-group">
						{!! Form::label('venta','Observaciones',['class'=> '']) !!}
						{!! Form::textarea('sol_observaciones',$solicitud->sol_observaciones,['class'=> 'form-control', 'placeholder'=>'Observaciones', 'required']) !!}	
				</div>

					<div class="form-group col-sm-12">
						<a href="{{ route('solicitud.index') }}" class="btn btn-primary" title="Ir al listado de solicitudes">
							Regresar al listado <span class="class "></span>
						</a> 
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

@section('scripts')
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  	<script src="{{ asset('plugins/Script/datepicker.js') }}"></script>
@endsection

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection
