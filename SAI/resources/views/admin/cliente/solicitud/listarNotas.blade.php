@extends('admin.template.main')

@section('title', 'Listar nota de entrega')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>id</th>
				      <th>Fecha</th>
				      <th>Subtotal / Total</th>
				      <th>Observaciones</th>
				      <th>Venta relacionada</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($notaEntregas as $notaEntrega)
				  		@if ($notaEntrega->venta->ven_eliminada === 0)
				  			<tr>
					      <th scope="row">{{ $notaEntrega->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($notaEntrega->not_fecha))}}</td>	
					      <td>{{ $notaEntrega->not_subtotal . " Bs / " . $notaEntrega->not_subtotal*1.12." Bs" }}</td>
					      <td>{{ $notaEntrega->not_observaciones}}</td>
					      <td>{{ "Venta #".$notaEntrega->venta->id." efectuada ".date("d/m/Y", strtotime($notaEntrega->venta->ven_fecha_compra))}}</td>
					     

					      <td>
					      	<a href="{{ route('solicitud.create', $notaEntrega->id) }}" class="btn btn-primary" title="Crear solicitud">
					      		<span class="glyphicon glyphicon-inbox"></span>
					      	</a>
					      	
					      </td>
				    	</tr>
				  		@endif
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $notaEntregas->links() }}


				
			</div>

			
			
		</div>
			
	</section>


	

@endsection