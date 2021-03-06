@extends('admin.template.main2')

@section('title', 'Consultar articulo')

@section('contenido-header-name', 'Obsevación de producto')

@section('contenido-header-name2', 'observar producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_computador.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoPC.index') }}"> Producto detallado</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'producto_articulo.store', 'method' => 'GET' ]) !!}
					
					<!--DATOS GENERALES -->
					<div class="row">

						<div class="col-sm-12">
							{!! Form::label('x','DATOS GENERALES DEL PRODUCTO') !!}
						</div>
						<div class="col-sm-4">

							{!! Form::label('x','Codigo general del producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						
						</div>
						<div class="col-sm-4">
							{!! Form::label('x','Descripcion del producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_descripcion,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						
						</div>
						<div class="col-sm-4">

							{!! Form::label('x','Precio  del producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_precio." $",['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							
						</div>
					</div>
					<br>
					<!--DATOS MARCA -->
					<div class="row">
						<div class="col-sm-4">
							{!! Form::label('cod_pc_fk_producto_computador','Marca') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->modelo->marca->mar_marca ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="col-sm-4">
							{!! Form::label('cod_pc_fk_producto_computador','Modelo') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->modelo->mod_modelo ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="col-sm-4">
							{!! Form::label('cod_pc_fk_producto_computador','Tipo de producto') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->tipo_producto->tip_tipo ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					</div>
					<br>
					<!--DATOS OFICINA -->
					<div class="row">
						<div class="col-sm-6">
							{!! Form::label('cod_pc_fk_producto_computador','Oficina') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->sector->oficina->ofi_direccion ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="col-sm-6">
							
							{!! Form::label('cod_pc_fk_producto_computador','Sector') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->sector->sec_sector ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					</div>
					<br>
					<!--DATOS ESPECIFICOS -->
					<div class="row">
						<div class="col-sm-12">
							{!! Form::label('x','DATOS ESPECIFICOS DEL PRODUCTO') !!}
						</div>
						<div class="col-sm-6">
							{!! Form::label('cod_pc','Código especifico') !!}
							{!! Form::text('cod_pc_codigo',$codigoPC->cod_pc_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
						<div class="col-sm-6">
							{!! Form::label('pro_com_precio','Precio en dolares') !!}
							{!! Form::text('cod_pc_costo',$codigoPC->cod_pc_costo,['class'=> 'form-control', 'title'=>'Solo números de 0-9,max: 10 con 2 decimales', 'placeholder'=>'1542.25', 'required', 'maxlength' => '10', 'pattern'=>'[0-9]+[.]?[0-9]?[0-9]?', 'readonly'=>'true']) !!}
						</div>
						<div class="col-sm-6">
							{!! Form::label('cod_pc_fk_lote','Estado del producto') !!}
							@if ($codigoPC->cod_pc_estado === 'B')
								{!! Form::text('cod_pc_estado',"Bueno" ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							@else
								{!! Form::text('cod_pc_estado',"Malo" ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							@endif
						</div>
						<div class="col-sm-6">
							{!! Form::label('cod_pc_fk_lote','Lote del computador') !!}
							{!! Form::text('cod_pc_estado',$codigoPC->lote->lot_nombre ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
							{!! Form::label('cod_pc_fk_lote','Componentes del computador') !!}
					
						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>Código del articulo</th>
						      <th>Descripcion</th>
						      <th>Marca/Modelo</th>
						      <th>Tipo</th>
						      <th>Capacidad</th>
						      <th>Sector</th>

						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($codigosArticulo as $codigoArticulo)
							  		<tr>
								      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
								      <td>{{ $codigoArticulo->producto_articulo->pro_art_descripcion  }}</td>
								      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
								      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
								      <td>{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}</td>
								      <td>{{ $codigoArticulo->producto_articulo->sector->sec_sector ." Ofi: ".$codigoArticulo->producto_articulo->sector->oficina->ofi_direccion }}</td>
								      
							    	</tr>
							@endforeach

							  </tbody>

							</table>
							{{ $codigosArticulo->links() }}
						</div>
					</div>

						
						
						
				<div class="form-group ">
					



						<div>
							<a href="{{ route('codigoPC.index') }}" class="btn btn-info">
						      		<span class=""></span> Regresar al listado
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
