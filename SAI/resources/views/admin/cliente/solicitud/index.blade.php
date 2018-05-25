@extends('admin.template.main2')

@section('title', 'Listar solicitudes')

@section('contenido-header-name', 'Listado de solicitudes')

@section('contenido-header-name2', 'lista de solicitudes')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Solicitud</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">
				 
				<a href="{{ route('solicitud.listarNotas',0) }}" class="btn btn-info">Registrar nueva solicitud</a>
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

				  	@foreach ($solicitudes as $solicitud)
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
					     

					      <td>
					      	<a href="{{ route('solicitud.edit', $solicitud->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	
					      	<a href="{{ route('solicitud.destroy', $solicitud->id) }}" onclick="return confirm('Eliminar la solicitud?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	
					      	<a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-info" title="Ver solicitud">
					      		<span class="glyphicon glyphicon-search"></span>
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