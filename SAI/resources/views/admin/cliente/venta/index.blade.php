@extends('admin.template.main2')

@section('title', 'Listar ventas')

@section('contenido-header-name', 'Listado de ventas')

@section('contenido-header-name2', 'lista de ventas')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('venta.index') }}"> Venta</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('venta.create') }}" class="btn btn-info">Registrar nueva Venta</a>
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código de la venta</th>
				      <th>Fecha efectuada</th>
				      <th>Monto total</th>
				      <th>Monto cancelado</th>
				      <th>Nota de entrega</th>
				      

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
					      	@if ($venta->NotaEntrega !== null)
					      		<a href="{{ route('notaEntrega.show', $venta->NotaEntrega->id) }}"  class="btn btn-primary" title="Ver nota de entrega" target="_blank">
					      		<span class="class glyphicon glyphicon-file"></span>
						      	</a> 

						      	<a href="{{ route('notaEntrega.download', $venta->NotaEntrega->id) }}"  class="btn btn-info" title="Descargar nota de entrega" target="_blank">
						      		<span class="class glyphicon glyphicon-floppy-save"></span>
						      	</a>

						      	<a href="{{ route('notaEntrega.enviarNotaEntrega', $venta->NotaEntrega->id) }}" class="btn btn-default" title="Enviar nota de entrega al cliente">
					      		<span class="glyphicon glyphicon-send"></span>
					      	</a>
						    @else
						    	<?php $monto_pagado2 = 0; ?> 
						    	@if ( count($venta->RegistroPagos) !== 0)
						      		@foreach ($venta->RegistroPagos as $pago)
						      			<?php $monto_pagado2 = $monto_pagado2 + $pago->reg_monto; ?>
						      		@endforeach
						      	@endif
							    @if ($monto_pagado2 >= $venta->ven_monto_total)
							    	<a href="{{ route('notaEntrega.create', $venta->id) }}"  class="btn btn-success" title="Crear Nota de entrega">
						      		<span class="class glyphicon glyphicon-paperclip"></span>
							      	</a> 
							    @endif
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