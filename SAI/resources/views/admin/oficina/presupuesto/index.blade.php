@extends('admin.template.main')

@section('title', 'Listar Presupuestos')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('presupuesto.create') }}" class="btn btn-info">Registrar nuevo presupuesto</a>
				 
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Fecha solicitud</th>
				      <th>Total</th>
				      <th>Cliente</th>
				      <th>Fecha de aprobación</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($presupuestos as $presupuesto)
				  		<tr>
					      <th scope="row">{{ $presupuesto->id }}</th>
					      <td>{{ date("d/m/Y", strtotime($presupuesto->pre_fecha_solicitud)) }}</td>
					      <td>{{ $presupuesto->pre_subtotal }}</td>	

					      @if ($presupuesto->pre_fk_cliente_natural !== null)
					      	<td>{{ $presupuesto->cliente_natural->cli_nat_identificador ."-". $presupuesto->cliente_natural->cli_nat_cedula ." ".$presupuesto->cliente_natural->cli_nat_nombre ." ". $presupuesto->cliente_natural->cli_nat_apellido }}</td>	
					      @else
					      	<td>{{ $presupuesto->cliente_juridico->cli_jur_identificador ."-". $presupuesto->cliente_juridico->cli_jur_rif ." ".$presupuesto->cliente_juridico->cli_jur_nombre }}</td>	
					      @endif

					      @if ($presupuesto->pre_fecha_aprobado !== null)
					      	<td>{{ date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)) }}</td>
					      @else
					      	<td></td>		    
					      @endif
					      <td>
					      	<a href="{{ route('presupuesto.edit', $presupuesto->id) }}" class="btn btn-success" onclick="return confirm('Desea aprobar el presupuesto #'+{{$presupuesto->id }}+'?') " title="Aprobar">
					      		<span class="class glyphicon glyphicon-ok"></span>
					      	</a>

					      	<a href="{{ route('presupuesto.destroy', $presupuesto->id) }}" onclick="return confirm('Eliminar el presupuesto?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('presupuesto.show', $presupuesto->id) }}" class="btn btn-info" target="_blank">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>

					      	<a href="{{ route('presupuesto.download', $presupuesto->id) }}" class="btn btn-primary" title="Descargar">
					      		<span class="glyphicon glyphicon-floppy-save"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $presupuestos->links() }}
				
			</div>
			
		</div>
			
	</section>


	

@endsection


