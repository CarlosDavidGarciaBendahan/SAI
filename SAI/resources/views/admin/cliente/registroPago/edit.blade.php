@extends('admin.template.main')

@section('title', 'Modificar registro pago')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['registroPago.update',$registroPago], 'method' => 'PUT']) !!}
					
					<div class="form-group">
						{!! Form::label('venta','Venta a que se le abona',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Venta #".$registroPago->venta->id." efectuada en la fecha: ".date("d/m/Y", strtotime($registroPago->venta->ven_fecha_compra)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('reg_fk_venta',$registroPago->venta->id,['class'=> 'form-control', 'hidden'=>'true', 'required', 'readonly'=>'true']) !!}	
					</div>

					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha recibido') !!}

							{!! Form::text('reg_fecha_pagado',  date("d/m/Y", strtotime($registroPago->reg_fecha_pagado)), array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
					</div>


					<div class="form-group">
						{!! Form::label('fecha','Monto',['class'=> ' col-sm'] ) !!}
						{!! Form::text('reg_monto',$registroPago->reg_monto,['class'=> 'form-control col-sm-10', 'placeholder'=>'123456789', 'required']) !!}		
						{!! Form::select('reg_moneda',['Bs'=>'Bs','$'=>'$'],$registroPago->reg_moneda,['class'=> 'form-control col-sm-2','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Concepto',['class'=> ' col-sm']) !!}
						{!! Form::text('reg_concepto',$registroPago->reg_concepto,['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Forma de pago',['class'=> ' col-sm']) !!}
						{!! Form::select('reg_forma',['efectivo'=>'Efectivo','deposito'=>'Deposito','transferencia'=>'Transferencia','cheque'=>'Cheque','otro'=>'Otras formas de pago'],$registroPago->reg_forma,['class'=> 'form-control col-sm','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Número de confirmación, referencia, guia, etc.',['class'=> ' col-sm']) !!}
						{!! Form::text('reg_numero_referencia',$registroPago->reg_numero_referencia,['class'=> 'form-control', 'placeholder'=>'152468579', 'required']) !!}	
					</div>

					<div class="form-group">
						{!! Form::label('fecha','Banco origen',['class'=> ' col-sm'] ) !!}	
						{!! Form::select('reg_fk_banco_origen',$bancos,$registroPago->reg_fk_banco_origen,['class'=> 'form-control ','required']) !!}
					</div>
					
					<div class="form-group">
						{!! Form::label('fecha','Banco destino',['class'=> ' col-sm'] ) !!}	
						{!! Form::select('reg_fk_banco_destino',$bancos,$registroPago->reg_fk_banco_destino,['class'=> 'form-control ','required']) !!}
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
