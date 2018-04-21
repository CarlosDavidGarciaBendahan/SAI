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

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($ventas as $venta)
				  		
				  		<tr>
					      <th scope="row">{{ $venta->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($venta->ven_fecha_compra))}}</td>	
					      <td>{{ $venta->ven_monto_total . " " . $venta->ven_moneda }}</td>
					      
					      <td>
					      	

					      	<a href="{{ route('venta.destroy', $venta->id) }}" onclick="return confirm('Eliminar el venta?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('venta.show', $venta->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
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