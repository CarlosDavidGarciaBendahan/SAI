@extends('admin.template.main')

@section('title', 'Listar solicitudes')

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
				      <th>Tipo</th>
				      <th>Concepto</th>
				      <th>Observaciones</th>
				      <th>Aprobado</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($solicitudes as $solicitud)
				  			<tr>
					      <th scope="row">{{ $solicitud->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($solicitud->sol_fecha))}}</td>		
					      <td>{{ $solicitud->sol_tipo}}</td>
					      <td>{{ $solicitud->sol_concepto}}</td>
					      <td>{{ $solicitud->sol_observaciones}}</td>
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
					     

					      <td>
					      	<a href="{{ route('solicitud.edit', $solicitud->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	
					      	<a href="{{ route('solicitud.destroy', $solicitud->id) }}" onclick="return confirm('Eliminar la solicitud?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	
					      </td>
				    	</tr>
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $solicitudes->links() }}


				
			</div>

			
			
		</div>
			
	</section>


	

@endsection