@extends('admin.template.main2')

@section('title', 'Modificar Articulo')

@section('contenido-header-name', 'Edición de producto')

@section('contenido-header-name2', 'editar producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoArticulo.index') }}"> Producto detallado</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm">
				{!! Form::open(['route' => ['codigoArticulo.update',$codigoArticulo], 'method' => 'PUT']) !!}
					
						
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
							{!! Form::select('cod_art_fk_lote',$lote, $codigoArticulo->lote->id, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_art_fk_lote','Estado del producto') !!}
							{!! Form::select('cod_art_estado',['B' => 'Bueno','M'=>'Malo'], $codigoArticulo->cod_art_estado, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>

						@if ($codigoArticulo->codigoPC !== null)
							<div class="form-group ">
								{!! Form::label('cod_art_fk_lote','Incorporado al computador con código') !!}
								{!! Form::text('cod_art_codigo',$codigoArticulo->codigoPC->cod_pc_codigo,['class'=> 'form-control col-sm-11', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
								<a href="{{ route('codigoArticulo.quitarPC', [$codigoArticulo->id]) }}" onclick="return confirm('Esta seguro de que quiere DESVINCULAR este articulo del computador?')" class="btn btn-warning col-sm-1" title="Desvincular este articulo del computador">
								      		<span class="class glyphicon glyphicon-link"></span>
								</a> 
							</div>
						@endif
						<!--
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoArticulo">
							
						</div>
						-->
					<div class="form-group col-sm-12">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/FormDinamicoAgregarcodigoArticulo.js') }}"></script>
@endsection
