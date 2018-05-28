@extends('admin.template.main2')

@section('title', 'Listar roles')

@section('contenido-header-name', 'Listado de roles')

@section('contenido-header-name2', 'lista de roles')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rol</li>
    </ol>
@endsection


@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('rol.create') }}" class="btn btn-info">Registrar nuevo rol</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>rol</th>
				      <th>tipo</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($roles as $rol)
				  		<tr>
					      <th scope="row">{{ $rol->id }}</th>
					      <td>{{ $rol->rol_rol }}</td>	
					      @if ($rol->rol_tipo === 'U')
					      	<td>Usuario</td>	
					      @else
					      	@if ($rol->rol_tipo === 'P')
					      		<td>Personal</td>
					      	@endif	
					      @endif
					      <td>
					      	<a href="{{ route('rol.edit', $rol->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('rol.destroy', $rol->id) }}" onclick="return confirm('Eliminar el rol?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('rol.show', $rol->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $roles->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection