@extends('admin.template.main2')

@section('title', 'Listar usuarios')

@section('contenido-header-name', 'Listado de usuarios')

@section('contenido-header-name2', 'listar usuarios')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Usuario</li>
    </ol>
@endsection

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
				      <th>Rol</th>
				      <th>Activado</th>
				      <th>Personal</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($users as $user)
				  		<tr>
					      <th scope="row">{{ $user->id }}</th>
					      <td>{{ $user->name }}</td>	
					      <td>{{ $user->rol->rol_rol }}</td>
					      @if ($user->activa !== 0)
					      	<td>SI</td>
					      @else
					      	<td>NO</td>
					      @endif
					      <td>{{ $user->personal->per_nombre ." ". $user->personal->per_nombre2 ." ". $user->personal->per_apellido ." ".$user->personal->per_apellido2 }}</td>	
					      <td>
					      	<a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">
					      		<span class="class fa fa-edit" title="Editar"></span>
					      	</a>

					      	@if ($user->id !== 0 && (auth()->user()->id !== $user->id) )
					      		<a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('Eliminar el user?')" class="btn btn-danger">
						      		<span class="class glyphicon glyphicon-remove-circle"></span>
						      	</a> 
					      	@endif

					      	@if ($user->activa === 0 && $user->solicitar_clave !== 0)
					      		<a href="{{ route('users.EnviarClave', $user->id) }}" onclick="return confirm('Enviar una nueva clave al usuario?')" class="btn btn-warning" title="RE-ENVIO DE CLAVE PENDIENTE">
						      		<span class="class fa fa-warning"></span>
						      	</a>
					      	@endif
					      	
					      	
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