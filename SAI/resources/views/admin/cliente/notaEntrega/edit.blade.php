@extends('admin.template.main2')

@section('title', 'Modificar Nota de entrega')

@section('contenido-header-name', 'Nota de entrega')

@section('contenido-header-name2', 'edición de nota de entrega')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('notaEntrega.index') }}"> Nota de entrega</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['notaEntrega.update',$notaEntrega], 'method' => 'PUT']) !!}
					
				    <?php $subtotal = 0; ?>
					<div class="form-group">
						{!! Form::label('venta','Venta a que se le abona',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Venta #".$notaEntrega->venta->id." efectuada en la fecha: ".date("d/m/Y", strtotime($notaEntrega->venta->ven_fecha_compra)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('not_fk_venta',$notaEntrega->venta->id,['class'=> 'form-control', 'hidden'=>'true', 'required', 'readonly'=>'true']) !!}	
					</div>

					@if ($notaEntrega->venta->cliente_natural !== null)
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_nombre." ".$notaEntrega->venta->cliente_natural->cli_nat_nombre2 ." ".$notaEntrega->venta->cliente_natural->cli_nat_apellido." ".$notaEntrega->venta->cliente_natural->cli_nat_apellido2,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','C.I.') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_identificador."-".$notaEntrega->venta->cliente_natural->cli_nat_cedula,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_direccion.", ".$notaEntrega->venta->cliente_natural->parroquia->par_nombre.", ".$notaEntrega->venta->cliente_natural->parroquia->municipio->mun_nombre.", ".$notaEntrega->venta->cliente_natural->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@else
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','RIF') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_identificador."-".$notaEntrega->venta->cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_direccion.", ".$notaEntrega->venta->cliente_juridico->parroquia->par_nombre.", ".$notaEntrega->venta->cliente_juridico->parroquia->municipio->mun_nombre.", ".$notaEntrega->venta->cliente_juridico->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@endif

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Empresa') !!}
						{!! Form::select('not_fk_empresa',$empresas, $notaEntrega->not_fk_empresa, ['class'=>'form-control col-sm input-sm select-empresas', 'placeholder'=>'', 'required', 'id'=>'empresas'] ) !!}
					</div>
					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha') !!}

							{!! Form::text('not_fecha', date("d/m/Y", strtotime($notaEntrega->not_fecha)), array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
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

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($notaEntrega->venta->ventaPCs as $codigoPC)
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
				    	<?php $subtotal = $subtotal + $codigoPC->producto_computador->pro_com_precio; ?>
				  	@endforeach

				  </tbody>

				</table>
				</div>
				<div>
					<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Capacidad</th>
				      <th>Costo</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($notaEntrega->venta->ventaArticulos as $codigoArticulo)
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
				    	<?php $subtotal = $subtotal + $codigoArticulo->producto_articulo->pro_art_precio; ?>
				  	@endforeach

				  </tbody>

				</table>
				</div>

				<div class="form-group">
						{!! Form::label('venta','Observaciones',['class'=> '']) !!}
						{!! Form::textarea('not_observaciones',$notaEntrega->not_observaciones,['class'=> 'form-control', 'title'=>'debe tener min: 10 max: 200 caracteres', 'placeholder'=>'Observaciones', 'required', 'minlength'=>'10', 'maxlength' => '200']) !!}	
				</div>

				<div class="form-group">
						{!! Form::label('venta','Subtotal',['class'=> ' col-sm-1']) !!}
						{!! Form::text('not_subtotal',$subtotal,['class'=> 'form-control col-sm-10', 'placeholder'=>'0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('x',"Bs",['class'=> 'form-control col-sm-1', 'placeholder'=>'0', 'required', 'readonly'=>'true']) !!}
						{!! Form::label('venta','Total',['class'=> ' col-sm-1']) !!}
						{!! Form::text('x',$subtotal*1.12,['class'=> 'form-control col-sm-10', 'placeholder'=>'0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('x',"Bs",['class'=> 'form-control col-sm-1', 'placeholder'=>'0', 'required', 'readonly'=>'true']) !!}
						
				</div>
					<div class="form-group col-sm-12">
						{!! Form::submit('Editar',['class'=>'btn btn-primary col-sm']) !!}
						<a href="{{ route('notaentrega.index') }}" class="btn btn-danger">Calcelar</a>
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
