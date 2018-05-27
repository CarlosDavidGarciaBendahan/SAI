@extends('admin.template.main2')

@section('title', 'Agregar computadores')

@section('contenido-header-name', 'Registro de producto')

@section('contenido-header-name2', 'crear producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_computador.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoPC.index') }}"> Producto detallado</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'codigoPC.store', 'method' => 'POST']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_producto_computador','Código') !!}
							{!! Form::text('codigo',$producto_computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_pc_fk_producto_computador',$producto_computador->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_lote','Lote del computador') !!}
							{!! Form::select('cod_pc_fk_lote',$lote, null, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
						
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoPC">
							<label class='col-sm'>Códigos</label>
							<input class='form-control col-sm-9'  title="Cantidad de caracteres max: 100" maxlength="100" type='text' name='codigosPC[]' placeholder='B203040' required='true'>
							<select class='form-control input-sm col-sm-2' name='estado[]' id='tipo_producto'>
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
	<script src = "{{ asset('plugins/Script/FormDinamicoAgregarCodigoPC.js') }}"></script>
@endsection
