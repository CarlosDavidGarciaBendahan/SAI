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
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'solicitud.store', 'method' => 'GET' ]) !!}
					

					<div class="row"><!-- DATOS DE LA SOLICITUD-->
						
							<div class="col-sm-12">
								{!! Form::label('venta','Datos de la solicitud') !!}
							</div>
						
						<div class="col-sm-6">
							<div class="form-group col-sm-6">
								{!! Form::label('venta','Solicitud') !!}
								{!! Form::text('venta',"Solicitud #".$solicitud->id,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
							</div>
							<div class="form-group col-sm-6">
								{!! Form::label('venta','Tipo de solicitud') !!}
								@if ($solicitud->sol_tipo === 'cambio')
									{!! Form::text('venta',"Cambio de producto",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}
								@else
									{!! Form::text('venta',"Devolución de producto",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}

								@endif
									
							</div>
							<div class="form-group col-sm-6">
								{!! Form::label('venta','Fecha de solicitud') !!}
								{!! Form::text('venta',date("d/m/Y", strtotime($solicitud->sol_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
							</div>
							<div class="form-group col-sm-6">
								{!! Form::label('venta','Concepto de solicitud') !!}
								{!! Form::text('venta',$solicitud->sol_concepto,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
							</div>
							<div class="form-group col-sm-12">
								{!! Form::label('venta','Estado de solicitud') !!}
								@if ($solicitud->sol_aprobado === 'S')
									{!! Form::text('venta',"Aprobada",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}
								@else
									{!! Form::text('venta',"Rechazada",['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}

								@endif
									
							</div>
						</div>
						
						<div class="col-sm-6">
							
								{!! Form::label('venta','Observaciones') !!}
								{!! Form::textarea('sol_observaciones',$solicitud->sol_observaciones,['class'=> 'form-control','placeholder'=>'Observaciones', 'required', 'readonly'=>'true']) !!}	
							
						</div>
						
					</div><!-- FIN DATOS DE -->

					<div class="row"><!-- DATOS DE CLIENTE ASOCIADO -->
						<div class="col-sm-12">
								{!! Form::label('venta','Datos del cliente') !!}
						</div>
						@if ($solicitud->notaEntrega->venta->cliente_natural !== null)
							<div class="col-sm-12">
								<div class="form-group col-sm-2">
									{!! Form::label('cli_nat_nombre','Nombre') !!}
									{!! Form::text('cli_nat_nombre',$solicitud->notaEntrega->venta->cliente_natural->cli_nat_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required','readonly'=>'true']) !!}
								</div>
							
								<div class="form-group col-sm-2">
									{!! Form::label('cli_nat_nombre2','Segundo nombre') !!}
									{!! Form::text('cli_nat_nombre2',$solicitud->notaEntrega->venta->cliente_natural->cli_nat_nombre2,['class'=> 'form-control', 'placeholder'=>'Segundo nombre','readonly'=>'true']) !!}
								</div>
							
								<div class="form-group col-sm-2">
									{!! Form::label('cli_nat_apellido','Apellido') !!}
									{!! Form::text('cli_nat_apellido',$solicitud->notaEntrega->venta->cliente_natural->cli_nat_apellido,['class'=> 'form-control', 'placeholder'=>'Apellido', 'required','readonly'=>'true']) !!}
								</div>
							
								<div class="form-group col-sm-2">
									{!! Form::label('cli_nat_apellido2','Segundo apellido') !!}
									{!! Form::text('cli_nat_apellido2',$solicitud->notaEntrega->venta->cliente_natural->cli_nat_apellido2,['class'=> 'form-control', 'placeholder'=>'Segundo apellido','readonly'=>'true']) !!}
								</div>

								<div class="form-group col-sm-1">
									{!! Form::label('cli_nat_identificador','Identificador') !!}
									{!! Form::select('cli_nat_identificador',['V'=>'V','E'=>'E','P'=>'P'], $solicitud->notaEntrega->venta->cliente_natural->cli_nat_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required','disabled'] ) !!}
								</div>

								<div class="form-group col-sm-3"> 
								
									{!! Form::label('cli_nat_cedula','cedula') !!}

									{!! Form::text('cli_nat_cedula',$solicitud->notaEntrega->venta->cliente_natural->cli_nat_cedula,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
								</div>
							</div>
						@else
							<div class="col-sm-12">
								<div class="form-group col-sm-2">
									{!! Form::label('cli_nat_nombre','Nombre') !!}
									{!! Form::text('cli_nat_nombre',$solicitud->notaEntrega->venta->cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required','readonly'=>'true']) !!}
								</div>

								<div class="form-group col-sm-1">
									{!! Form::label('cli_jur_identificador','Identificador') !!}
									{!! Form::select('cli_jur_identificador',['V'=>'V','E'=>'E','P'=>'P'], $solicitud->notaEntrega->venta->cliente_juridico->cli_jur_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required','disabled'] ) !!}
								</div>

								<div class="form-group col-sm-3"> 
								
									{!! Form::label('cli_jur_cedula','cedula') !!}

									{!! Form::text('cli_jur_cedula',$solicitud->notaEntrega->venta->cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
								</div>
							</div>

						@endif
						
						
						
					</div><!-- FIN DATOS DE CLIENTE ASOCIADO -->

					<div class="row"><!-- DATOS DE nota de entrega-->
						<div class="col-sm-12">
								{!! Form::label('venta','Datos de la nota de entrega') !!}
						</div>
						<div class="col-sm-12">
							<div class="form-group col-sm-6">
								{!! Form::label('venta','Número de nota de entrega',['class'=> ' col-sm']) !!}
								{!! Form::text('venta',"Nota de entraga #".$solicitud->notaEntrega->id,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
							</div>

							<div class="form-group col-sm-6">
								{!! Form::label('venta','Fecha realizada',['class'=> ' col-sm']) !!}
								{!! Form::text('venta'," efectuada en la fecha: ".date("d/m/Y", strtotime($solicitud->notaEntrega->not_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
							</div>
						</div>

					</div><!-- FIN DATOS DE nota de entrega-->


					<div class="row"><!-- DATOS DE LOS PRODUCTOS-->
						{!! Form::label('venta','Datos de los productos',['class'=> ' col-sm-12']) !!}
						<div class="col-sm-12">
							
							<div class="col-sm-6">
								{!! Form::label('venta','Productos seleccionados en la solicitud',['class'=> ' col-sm']) !!}

								<div class="form-group">
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



							</div>
							<div class="col-sm-6">
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

							</div>
							
						</div>
					</div><!-- FIN DATOS DE LOS PRODUCTOS-->




					<div class="row"><!-- DATOS DE LA SOLICITUD-->
						
					</div><!-- FIN DATOS DE LA SOLICITUD-->
					
					

					

					

					

					


					

					

					


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
