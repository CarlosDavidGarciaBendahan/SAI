@extends('admin.template.main2')

@section('title', 'Consultar venta')

@section('contenido-header-name', 'Observación de venta')

@section('contenido-header-name2', 'observar venta')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('venta.index') }}"> Venta</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'venta.store', 'method' => 'GET' ]) !!}
					
					
					<div class="form-group ">
						{!! Form::label('id','Número de venta') !!}
						{!! Form::text('id',$venta->id,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
					</div>

					<div class="form-group ">
						{!! Form::label('fecha_venta','Fecha de la venta') !!}
						{!! Form::text('ven_fecha_compra', date("d/m/Y", strtotime($venta->ven_fecha_compra)),['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
					</div>
						
					<div class="form-group ">
						{!! Form::label('Monto','Monto total',['class'=>'col-sm']) !!}
						{!! Form::text('ven_fecha_compra',$venta->ven_monto_total,['class'=> 'form-control col-sm-10', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						{!! Form::text('ven_fecha_compra',$venta->ven_moneda,['class'=> 'form-control col-sm-2', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
					</div>

					@if ($venta->cliente_natural !== null)
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_natural->cli_nat_nombre." ".$venta->cliente_natural->cli_nat_nombre2 ." ".$venta->cliente_natural->cli_nat_apellido." ".$venta->cliente_natural->cli_nat_apellido2,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','C.I.') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_natural->cli_nat_identificador."-".$venta->cliente_natural->cli_nat_cedula,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_natural->cli_nat_direccion.", ".$venta->cliente_natural->parroquia->par_nombre.", ".$venta->cliente_natural->parroquia->municipio->mun_nombre.", ".$venta->cliente_natural->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@else
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','C.I.') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_juridico->cli_jur_identificador."-".$venta->cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $venta->cliente_juridico->cli_jur_direccion.", ".$venta->cliente_juridico->parroquia->par_nombre.", ".$venta->cliente_juridico->parroquia->municipio->mun_nombre.", ".$venta->cliente_juridico->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@endif
							
					<div class="form-group ">
					{!! Form::label('Productos','Lista de computadoras') !!}
					</div>	
					<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Componentes</th>
				      <th>Precio</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($venta->VentaPCs as $codigoPC)
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
					  	  	{{ $codigoPC->producto_computador->pro_com_precio }}
					  	  </td>
					  	  
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>


						
				<div class="form-group ">
					{!! Form::label('Productos','Lista de artículos') !!}
				</div>		
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código del articulo</th>
				      <th>Descripcion</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Capacidad</th>
				      <th>precio</th>

				    </tr>
				  </thead>
				  <tbody>
				  	@foreach ($venta->ventaArticulos as $codigoArticulo)
					  		<tr>
						      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
						      <td>{{ $codigoArticulo->producto_articulo->pro_art_descripcion  }}</td>
						      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
						      <td>{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}</td>
						      <td>
						  	  	{{ $codigoArticulo->producto_articulo->pro_art_precio }}
						  	  </td>
					    	</tr>
					@endforeach
					  </tbody>

					</table>

						<div>
							<a href="{{ route('venta.index') }}" class="btn btn-info">
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
