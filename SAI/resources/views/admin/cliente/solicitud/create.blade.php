@extends('admin.template.main')

@section('title', 'Crear Solicitud')

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'solicitud.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('venta','Nota de entrega',['class'=> ' col-sm']) !!}
						{!! Form::text('venta',"Nota de entraga #".$notaEntrega->id." efectuada en la fecha: ".date("d/m/Y", strtotime($notaEntrega->not_fecha)),['class'=> 'form-control', 'placeholder'=>'PAGO DE LA VENTA 0', 'required', 'readonly'=>'true']) !!}	
						{!! Form::text('sol_fk_notaentrega',$notaEntrega->id,['class'=> 'form-control', 'hidden'=>'true', 'required', 'readonly'=>'true']) !!}	
					</div>

					@if ($notaEntrega->venta->cliente_natural !== null)
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_nombre." ".$notaEntrega->venta->cliente_natural->cli_nat_nombre2 ." ".$notaEntrega->venta->cliente_natural->cli_nat_apellido." ".$notaEntrega->venta->cliente_natural->cli_nat_apellido2,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','C.I.') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_identificador."-".$notaEntrega->venta->cliente_natural->cli_nat_cedula,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_natural->cli_nat_direccion.", ".$notaEntrega->venta->cliente_natural->parroquia->par_nombre.", ".$notaEntrega->venta->cliente_natural->parroquia->municipio->mun_nombre.", ".$notaEntrega->venta->cliente_natural->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@else
						<div class="form-group ">
							{!! Form::label('cliente','Datos del cliente',['class'=>'col-sm']) !!}
							{!! Form::label('cliente','Nombre') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','RIF') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_identificador."-".$notaEntrega->venta->cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::label('cliente','Dirección') !!}
							{!! Form::text('ven_fecha_compra', $notaEntrega->venta->cliente_juridico->cli_jur_direccion.", ".$notaEntrega->venta->cliente_juridico->parroquia->par_nombre.", ".$notaEntrega->venta->cliente_juridico->parroquia->municipio->mun_nombre.", ".$notaEntrega->venta->cliente_juridico->parroquia->municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>
					@endif

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Tipo de solicitud') !!}
						{!! Form::select('sol_tipo',['cambio'=>'Cambio de producto','devolucion' => 'Devolución del producto'], null, ['class'=>'form-control col-sm input-sm ', 'placeholder'=>'', 'required'] ) !!}
					</div>
					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha') !!}

							{!! Form::text('sol_fecha',null, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
					</div>
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Aprobación de la solicitud') !!}
						{!! Form::select('sol_aprobado',['S'=>'Aprobar la solicitud','N' => 'Rechazar solicutd'], null, ['class'=>'form-control input-sm ', 'placeholder'=>'', 'required'] ) !!}
					</div>
					<div class="form-group">
						{!! Form::label('venta','Concepto',['class'=> ' col-sm']) !!}
						{!! Form::text('sol_concepto',null,['class'=> 'form-control', 'placeholder'=>'El computador no arranca', 'required']) !!}	
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
