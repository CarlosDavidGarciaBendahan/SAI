@extends('admin.template.main2')

@section('title', 'Listar Registros de pago')

@section('contenido-header-name', 'Registro de pago')

@section('contenido-header-name2', 'listado de los registros de pago')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('venta.index') }}"> Venta</a></li>
        <li class="active">Registro de pago</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">
		<div>
			<a href="{{ route('venta.index') }}" class="btn btn-info" title="Lista de ventas">
						<span class="fa fa-bars"></span>
			</a>
			{!! Form::label('venta','Registrar pago de una venta.',['class'=> ' col-sm']) !!}
		</div>
		<div class="row">
			<div class="col-sm-8 offset-2">
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>id</th>
				      <th>Fecha del pago</th>
				      <th>Venta relacionada</th>
				      <th>Monto</th>
				      <th>Concepto</th>
				      <th>Forma</th>
				      <th>Número de referencia</th>
				      <th>Banco origen del pago</th>
				      <th>Banco destino del pago</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($registroPagos as $registroPago)
				  		
				  		<tr>
					      <th scope="row">{{ $registroPago->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($registroPago->reg_fecha_pagado))}}</td>
					      <td>{{ "Venta #".$registroPago->venta->id." "}}</td>	
					      <td>{{ $registroPago->reg_monto . " " . $registroPago->reg_moneda }}</td>
					      <td>{{ $registroPago->reg_concepto}}</td>
					      <td>{{ $registroPago->reg_forma}}</td>
					      <td>{{ $registroPago->reg_numero_referencia}}</td>
					      <td>
					      	@if ( $registroPago->BancoOrigen !== null)
					      		{{ $registroPago->BancoOrigen->ban_nombre }}
					      	@endif
					      </td>
					      <td>
					      	@if ( $registroPago->BancoDestino !== null)
					      		{{ $registroPago->BancoDestino->ban_nombre }}
					      	@endif
					      </td>


					      <td>
					      	
					      	<a href="{{ route('registroPago.edit', $registroPago->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	<a href="{{ route('registroPago.destroy', $registroPago->id) }}" onclick="return confirm('Eliminar el registroPago?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	
					      </td>
				    	</tr>
				  		
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $registroPagos->links() }}


				
			</div>

			
			
		</div>
			<div>
			<a href="{{ route('registroPago.listarRegistroPago',0) }}" class="btn btn-info" title="Lista completa de los registros de pago">
						<span class="fa fa-bars"></span>
			</a>
			{!! Form::label('venta','Ver lista completa.',['class'=> ' col-sm']) !!}
			</div>
	</section>


	

@endsection