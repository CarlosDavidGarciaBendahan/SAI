@extends('admin.template.main')

@section('title', 'Listar usuarios')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('users.create') }}" class="btn btn-info">Registrar nuevo usuario</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Usuario</th>
				      <th>Activado</th>
				      <th>Personal</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($users as $user)
				  		<tr>
					      <th scope="row">{{ $user->id }}</th>
					      <td>{{ $user->name }}</td>	
					      @if ($user->activa !== 0)
					      	<td>SI</td>
					      @else
					      	<td>NO</td>
					      @endif
					      <td>{{ $user->personal->per_nombre ." ". $user->personal->per_nombre2 ." ". $user->personal->per_apellido ." ".$user->personal->per_apellido2 }}</td>	
					      <td>
					      	<a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('Eliminar el user?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $users->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection