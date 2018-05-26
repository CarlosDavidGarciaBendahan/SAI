@extends('admin.template.main2')

@section('title', 'Agregar articulos')

@section('contenido-header-name', 'Registro de producto')

@section('contenido-header-name2', 'crear producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoArticulo.index') }}"> Producto detallado</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'codigoArticulo.store', 'method' => 'POST']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_art_fk_producto_articulo','Código') !!}
							{!! Form::text('codigo',$producto_articulo->pro_art_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_art_fk_producto_articulo',$producto_articulo->id,['class'=> 'form-control', 'hidden'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('cod_art_fk_lote','Lote del articulo') !!}
							{!! Form::select('cod_art_fk_lote',$lote, null, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
						
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoArticulo">
							
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
	<script src = "{{ asset('plugins/Script/FormDinamicoAgregarCodigoArticulo.js') }}"></script>
@endsection
