@extends('admin.template.main')

@section('title', 'Listar estados')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('estado.create') }}" class="btn btn-info">Registrar nuevo estado</a>
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Nombre del estado</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($estado as $edo)
				  		<tr>
					      <th scope="row">{{ $edo->id }}</th>
					      <td>{{ $edo->est_nombre }}</td>	
					      <td>
					      	<a href="{{ route('estado.edit', $edo->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('estado.destroy', $edo->id) }}" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('estado.show', $edo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $estado->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection