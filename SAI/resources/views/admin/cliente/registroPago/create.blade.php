@extends('admin.template.main')

@section('title', 'Crear Registro de pago')

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'registroPago.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('venta','Venta a que se le abona',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Venta #".$venta->id." efectuada en la fecha: ".date("d/m/Y", strtotime($venta->ven_fecha_compra)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('reg_fk_venta',$venta->id,['class'=> 'form-control', 'hidden'=>'true', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha recibido') !!}

							{!! Form::text('reg_fecha_pagado', '', array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
					</div>


					<div class="form-group">
						{!! Form::label('fecha','Monto',['class'=> ' col-sm'] ) !!}
						{!! Form::text('reg_monto',null,['class'=> 'form-control col-sm-10', 'placeholder'=>'123456789', 'required']) !!}		
						{!! Form::select('reg_moneda',['Bs'=>'Bs','$'=>'$'],'Bs',['class'=> 'form-control col-sm-2','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Concepto',['class'=> ' col-sm']) !!}
						{!! Form::text('reg_concepto',null,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Forma de pago',['class'=> ' col-sm']) !!}
						{!! Form::select('reg_forma',['efectivo'=>'Efectivo','deposito'=>'Deposito','transferencia'=>'Transferencia','cheque'=>'Cheque','otro'=>'Otras formas de pago'],null,['class'=> 'form-control col-sm','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Número de confirmación, referencia, guia, etc.',['class'=> ' col-sm']) !!}
						{!! Form::text('reg_numero_referencia',null,['class'=> 'form-control', 'placeholder'=>'152468579', 'required']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Banco origen',['class'=> ' col-sm'] ) !!}	
						{!! Form::select('reg_fk_banco_origen',$bancos,null,['class'=> 'form-control ','required']) !!}
					</div>
					
					<div class="form-group">
						{!! Form::label('fecha','Banco destino',['class'=> ' col-sm'] ) !!}	
						{!! Form::select('reg_fk_banco_destino',$bancos,null,['class'=> 'form-control ','required']) !!}
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
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  	<script src="{{ asset('plugins/Script/datepicker.js') }}"></script>
@endsection

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection
