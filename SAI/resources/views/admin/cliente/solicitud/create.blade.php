@extends('admin.template.main2')

@section('title', 'Crear Solicitud')

@section('contenido-header-name', 'Registro de solicitud')

@section('contenido-header-name2', 'registro de solicitud')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('solicitud.index') }}"> Solicitud</a></li>
        <li class="active"><a href="{{ route('solicitud.listarNotas',0) }}"> Notas de entrega</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

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
					@if (count($notaEntrega->solicitudes) !== 0)
						<div>
					    {!! Form::label('venta','Solicitudes de cambio relacionadas',['class'=> ' col-sm']) !!}
						 <table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>id</th>
						      <th>Fecha</th>
						      <th>Tipo</th>
						      <th>Concepto</th>
						      <th>Observaciones</th>
						      <th>Nota Entrega</th>
						      <th>Aprobado</th>

						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($notaEntrega->solicitudes as $solicitud)
						  		@if ($solicitud->sol_tipo === 'cambio')
						  		<tr>
							      <th scope="row">{{ $solicitud->id }}</th>
							      <td>{{  date("d/m/Y", strtotime($solicitud->sol_fecha))}}</td>		
							      <td>{{ $solicitud->sol_tipo}}</td>
							      <td>{{ $solicitud->sol_concepto}}</td>
							      <td>{{ $solicitud->sol_observaciones}}</td>
							      <td>{{ '#'.$solicitud->notaEntrega->id }}</td>
							      <td>
							      	@if ($solicitud->sol_aprobado === 'S')
							      		<a class="btn btn-success" title="Aprobado">
							      		<span class="class glyphicon glyphicon-ok"></span>
								    	</a>
								    @else
								    	<a class="btn btn-danger" title="Rechazado">
							      		<span class="class glyphicon glyphicon-remove"></span>
								    	</a>
							      	@endif
							      </td>
						    	</tr>
						  		@endif
						  	@endforeach

						  </tbody>

						</table>
						{!! Form::label('empresa','Elegir una solicitud en caso de que la solicitud sea para otra solicitud') !!}
						{!! Form::select('solicitud_id',$solicitudes, null, ['class'=>'form-control col-sm input-sm ', 'placeholder'=>''] ) !!}

						</div>
					@endif
					

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

					<div class="form-group"> 
						
						{!! Form::label('empresa','Tipo de solicitud') !!}
						{!! Form::select('sol_tipo',['cambio'=>'Cambio de producto','devolucion' => 'Devolución del producto'], null, ['class'=>'form-control col-sm input-sm ', 'placeholder'=>'', 'required'] ) !!}
					</div>
					<div class="form-group"> 
						
							{!! Form::label('per_fecha_nacimiento','Fecha') !!}

							{!! Form::text('sol_fecha',null, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control', 'required'=>'true')) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('empresa','Aprobación de la solicitud') !!}
						{!! Form::select('sol_aprobado',['S'=>'Aprobar la solicitud','N' => 'Rechazar solicutd'], null, ['class'=>'form-control input-sm ', 'placeholder'=>'', 'required'] ) !!}
					</div>
					<div class="form-group">
						{!! Form::label('venta','Concepto',['class'=> ' col-sm']) !!}
						{!! Form::text('sol_concepto',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y numeros de 0-9, min: 10 max: 50', 'placeholder'=>'Concepto.', 'required', 'minlength'=>'10', 'maxlength' => '50', 'pattern'=>'[A-za-z0-9 ]+']) !!}	
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
