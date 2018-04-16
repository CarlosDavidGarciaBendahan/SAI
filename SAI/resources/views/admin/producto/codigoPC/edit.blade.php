@extends('admin.template.main')

@section('title', 'Modificar computador')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['codigoPC.update',$codigoPC], 'method' => 'PUT']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_producto_computador','Producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_pc_fk_producto_computador',$codigoPC->Producto_Computador->id,['class'=> 'form-control', 'hidden'=>'true', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_pc_fk_lote','Lote del computador') !!}
							{!! Form::select('cod_pc_fk_lote',$lote, $codigoPC->lote->id, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_pc','CódigoPC') !!}
							{!! Form::text('cod_pc_codigo',$codigoPC->cod_pc_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('id',$codigoPC->id,['class'=> 'form-control', 'hidden'=>'true', 'required']) !!}
						</div>
						
						<!--
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoPC">
							
						</div>
						-->
					<div class="form-group">
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
