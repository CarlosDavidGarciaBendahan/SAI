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
	<section class="container-fluid">
		<div class="row">
			
			<div class="col-sm-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => 'codigoArticulo.store', 'method' => 'POST']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_art_fk_producto_articulo','Código') !!}
							{!! Form::text('codigo',$producto_articulo->pro_art_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_art_fk_producto_articulo',$producto_articulo->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('cod_art_fk_lote','Lote del articulo') !!}
							{!! Form::select('cod_art_fk_lote',$lote, null, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
						
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="form-group codigoArticulo">
							<label class='col-sm'>Códigos</label>
							<input class='form-control col-sm-9'  type='text' name='codigosArticulo[]' placeholder='B203040' required='true' title="Cantidad de caracteres max: 100" maxlength="100">
							<select class='form-control input-sm col-sm-2' name='estado[]' id='tipo_producto' required="true">
									<option value='B'>Bueno</option>
									<option value='M'>Malo</option>
							</select>
						</div>
					<div class="form-group col-sm-12">
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
