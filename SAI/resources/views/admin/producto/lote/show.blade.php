@extends('admin.template.main2')

@section('title', 'Información de Lote')

@section('contenido-header-name', 'Observación de lote')

@section('contenido-header-name2', 'oberservar lote')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('lote.index') }}"> Lote</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'lote.store', 'method' => 'POST' ]) !!}
					<div class="row">
						
						<div class="col-sm-12">
							<div class="form-group"> 
						
								{!! Form::label('lot_nombre','Nombre del lote') !!}

								{!! Form::text('lot_nombre',$lote->lot_nombre,['class'=> 'form-control', 'placeholder'=>'nombre', 'required', 'readonly'=>'true']) !!}
							</div>

							<div class="form-group"> 
								
								{!! Form::label('lot_fecha_recibido','Fecha recibido') !!}

								{!! Form::text('lot_fecha_recibido', $lote->lot_fecha_recibido, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control', 'readonly'=>'true')) !!}
							</div>
						</div>	


					</div>
					<div class="row">
						<div class="col-sm-6">
							<table class="table table-inverse">
							  <thead>
							    <tr>
							      <th>Código</th>
							      <th>Marca/Modelo</th>
							      <th>Tipo</th>
							      <th>Ubicación</th>
							      <th>Componentes</th>
							      {{--<th>Disponible</th>--}}

							    </tr>
							  </thead>
							  <tbody>

							  	@foreach ($lote->codigoPCs as $codigoPC)
							  		<tr>
								      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
								      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
								      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
								      
								      <td>{{ $codigoPC->producto_computador->sector->sec_sector ." Ofi: ".$codigoPC->producto_computador->sector->oficina->ofi_direccion }}</td>	
								      <td>
								      	@foreach ($codigoPC->CodigoArticulos as $componente)
								      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
								      	@endforeach
								  	  </td>	
							    	</tr>
							  	@endforeach

							  </tbody>

							</table>
						</div>

						<div class="col-sm-6">
							<table class="table table-inverse">
							  <thead>
							    <tr>
							      <th>Código</th>
							      <th>Marca/Modelo</th>
							      <th>Tipo</th>
							      <th>Ubicación</th>
							      <th>Componente del computador</th>

							    </tr>
							  </thead>
							  <tbody>

							  	@foreach ($lote->codigoArticulos as $codigoArticulo)
							  		<tr>
								      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
								      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
								      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
								      
								      <td>{{ $codigoArticulo->producto_articulo->sector->sec_sector ." Ofi: ".$codigoArticulo->producto_articulo->sector->oficina->ofi_direccion }}</td>	
								      
								  	  
								      


								        @if ($codigoArticulo->cod_art_fk_pc !== null)
									  	  	
									  	  	<td>
									  	  		<a  class="btn btn-danger" title="Asignado">
									      		{{$codigoArticulo->codigopc->cod_pc_codigo }}<span class="class glyphicon glyphicon-ban-circle"></span>
									      		</a>
									  	  	</td>
									  	  @else
									  	  	<td>
									  	  		<a  class="btn btn-success" title="No esta asignado a ninguna PC">
									      		<span class="class glyphicon glyphicon-ok"></span>
									      		</a>
									  	  	</td>
									  	@endif

									  	

							    	</tr>
							  	@endforeach

							  </tbody>

							</table>
						</div>




					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

