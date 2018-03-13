@extends('admin.template.main')

@section('title', 'Listar permisos')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('permiso.create') }}" class="btn btn-info">Registrar nuevo permiso</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>permiso</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($permisos as $permiso)
				  		<tr>
					      <th scope="row">{{ $permiso->id }}</th>
					      <td>{{ $permiso->perm_permiso }}</td>	
					      <td>
					      	<a href="{{ route('permiso.edit', $permiso->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('permiso.destroy', $permiso->id) }}" onclick="return confirm('Eliminar el permiso?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('permiso.show', $permiso->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $permisos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection