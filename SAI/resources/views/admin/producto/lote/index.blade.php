@extends('admin.template.main')

@section('title', 'Listar Lotes')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('lote.create') }}" class="btn btn-info">Registrar nuevo lote</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Nombre</th>
				      <th>Fecha recibido</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($lotes as $lote)
				  		<tr>
					      <th scope="row">{{ $lote->id }}</th>
					      <td>{{ $lote->lot_nombre }}</td>	
					      <td>{{ $lote->lot_fecha_recibido }}</td>
					      <td>
					      	<a href="{{ route('lote.edit', $lote->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('lote.destroy', $lote->id) }}" onclick="return confirm('Eliminar el lote?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('lote.show', $lote->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $lotes->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


