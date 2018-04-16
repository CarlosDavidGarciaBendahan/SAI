@extends('admin.template.main')

@section('title', 'Agregar computadores')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'codigoPC.store', 'method' => 'POST']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_producto_computador','Código') !!}
							{!! Form::text('codigo',$producto_computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_pc_fk_producto_computador',$producto_computador->id,['class'=> 'form-control', 'hidden'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_lote','Lote del computador') !!}
							{!! Form::select('cod_pc_fk_lote',$lote, null, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
						
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoPC">
							
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
	<script src = "{{ asset('plugins/Script/FormDinamicoAgregarCodigoPC.js') }}"></script>
@endsection
