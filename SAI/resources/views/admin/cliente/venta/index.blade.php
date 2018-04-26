@extends('admin.template.main')

@section('title', 'Listar ventas')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('venta.create') }}" class="btn btn-info">Registrar nueva Venta</a>
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código de la venta</th>
				      <th>Fecha efectuada</th>
				      <th>Monto total</th>
				      <th>Monto cancelado</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($ventas as $venta)
				  		
				  		<tr>
					      <th scope="row">{{ $venta->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($venta->ven_fecha_compra))}}</td>	
					      <td>{{ $venta->ven_monto_total . " " . $venta->ven_moneda }}</td>
					      <td>
					      	@if ( count($venta->RegistroPagos) !== 0)
					      		
					      		<?php $monto_pagado = 0; ?> 
					      		@foreach ($venta->RegistroPagos as $pago)
					      			<?php $monto_pagado = $monto_pagado + $pago->reg_monto; ?>
					      		@endforeach
					      		{{ $monto_pagado." Bs" }}
					      	
					      		
					      	@endif
					      </td>


					      <td>
					      	
					      	<a href="{{ route('venta.edit', $venta->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	<a href="{{ route('venta.destroy', $venta->id) }}" onclick="return confirm('Eliminar el venta?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('venta.show', $venta->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	<a href="{{ route('registroPago.create', $venta->id) }}"  class="btn btn-success" title="Registrar pagos a esta venta">
					      		<span class="class glyphicon glyphicon-usd"></span>
					      	</a> 
					      	 
					      	@if ( count($venta->RegistroPagos) !== 0)
					      		<a href="{{ route('registroPago.index', $venta->id) }}"  class="btn  btn-link" title="Listar los registro de pago">
					      		<span class="glyphicon glyphicon-th-list"></span>
					      		</a>
					      	@endif
					      </td>
				    	</tr>
				  		
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $ventas->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection