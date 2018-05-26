@extends('admin.template.main2')

@section('title', 'Consultar venta')

@section('contenido-header-name', 'Observación de solicitud')

@section('contenido-header-name2', 'observar solicitud')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('solicitud.index') }}"> Solicitud</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'solicitud.store', 'method' => 'GET' ]) !!}
					
					
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
						@if ($solicitud->sol_tipo === 'cambio')
							{!! Form::text('venta',"Cambio de producto",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}
						@else
							{!! Form::text('venta',"Devolución de producto",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}

						@endif
							
					</div>

					<div class="form-group">
						{!! Form::label('venta','Fecha de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',date("d/m/Y", strtotime($solicitud->sol_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Concepto de solicitud',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',$solicitud->sol_concepto,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Estado de solicitud',['class'=> ' col-sm']) !!}
						@if ($solicitud->sol_aprobado === 'S')
							{!! Form::text('venta',"Aprobada",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}
						@else
							{!! Form::text('venta',"Rechazada",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}

						@endif
							
					</div>

					<div class="form-group">
						{!! Form::label('venta','Observaciones',['class'=> '']) !!}
						{!! Form::textarea('sol_observaciones',$solicitud->sol_observaciones,['class'=> 'form-control', 'placeholder'=>'Observaciones', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('venta','Productos elegidos',['class'=> '']) !!}
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

					<div class="form-group">
						@if (count($solicitud->CodigoPCsEntregado) !== 0 || count($solicitud->CodigoArticulosEntregado) !== 0)
							
							{!! Form::label('venta','Productos entregado por cambio',['class'=> '']) !!}
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
							    	</tr>
							  	
							  	@endforeach
							  </tbody>

							</table>
						@endif
					</div>


					<!--
					<div>
						<a href="{{ route('solicitud.index') }}" class="btn btn-info">
						    <span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					 	</a>
					</div>
					-->
						

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
