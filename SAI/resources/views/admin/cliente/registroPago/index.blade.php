@extends('admin.template.main')

@section('title', 'Listar Registros de pago')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>id</th>
				      <th>Fecha del pago</th>
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
					      	<a href="{{ route('registroPago.show', $registroPago->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	<a href="{{ route('registroPago.create', $registroPago->id) }}"  class="btn btn-success" title="Registrar pagos a esta registroPago">
					      		<span class="class glyphicon glyphicon-usd"></span>
					      	</a> 
					      </td>
				    	</tr>
				  		
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $registroPagos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection