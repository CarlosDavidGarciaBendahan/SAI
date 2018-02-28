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

				  	@foreach ($estado as $estado)
				  		<tr>
					      <th scope="row">{{ $estado->id }}</th>
					      <td>{{ $estado->est_nombre }}</td>	
					      <td>
					      	<a href="{{ route('estado.edit', $estado->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('estado.destroy', $estado->id) }}" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('estado.show', $estado->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
			</div>
			
		</div>
			
	</section>


	

@endsection