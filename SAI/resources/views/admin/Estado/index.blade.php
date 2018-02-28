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
					      <td><a href="" class="btn btn-danger"></a> <a href="" class="btn btn-warning"></a></td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
			</div>
			
		</div>
			
	</section>


	

@endsection