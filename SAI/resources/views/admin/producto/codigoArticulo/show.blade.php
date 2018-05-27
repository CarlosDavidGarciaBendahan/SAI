@extends('admin.template.main2')

@section('title', 'Consultar articulo')

@section('contenido-header-name', 'Obsevación de producto')

@section('contenido-header-name2', 'observar producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoArticulo.index') }}"> Producto detallado</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'producto_articulo.store', 'method' => 'GET' ]) !!}
					
					
						<div class="form-group ">
							{!! Form::label('cod_art_fk_producto_articulo','Descripcion del producto') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->pro_art_descripcion,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_art_fk_producto_articulo',$codigoArticulo->producto_articulo->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">

							{!! Form::label('cod_art_fk_producto_articulo','Codigo general del producto') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->pro_art_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_art_fk_producto_articulo','Marca') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->modelo->marca->mar_marca ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_art_fk_producto_articulo','Modelo') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->modelo->mod_modelo ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						
						<div class="form-group ">

							{!! Form::label('cod_art_fk_producto_articulo','Oficina') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->sector->oficina->ofi_direccion ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_art_fk_producto_articulo','Sector') !!}
							{!! Form::text('codigo',$codigoArticulo->producto_articulo->sector->sec_sector ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>



						<div class="form-group ">
							{!! Form::label('cod_pc','Código especifico') !!}
							{!! Form::text('cod_art_codigo',$codigoArticulo->cod_art_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('id',$codigoArticulo->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_art_fk_lote','Lote del computador') !!}
							{!! Form::text('cod_art_codigo',$codigoArticulo->lote->lot_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}

						</div>

						<div class="form-group ">
							{!! Form::label('cod_art_fk_lote','Estado del producto') !!}
							@if ($codigoArticulo->cod_art_estado === 'B')
								{!! Form::text('cod_art_estado',"Bueno" ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							@else
								{!! Form::text('cod_art_estado',"Malo" ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							@endif
						</div>

						@if ($codigoArticulo->codigoPC !== null)

							<div class="form-group ">
								{!! Form::label('cod_art_fk_lote','Incorporado al computador con código') !!}
								{!! Form::text('cod_art_codigo',$codigoArticulo->codigoPC->cod_pc_codigo,['class'=> 'form-control col-sm-11', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							</div>
						@endif
						<!--
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoArticulo">
							
						</div>
						-->


						

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerSectoresPorOficina.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerModelosPorMarca.js') }}"></script>
@endsection
