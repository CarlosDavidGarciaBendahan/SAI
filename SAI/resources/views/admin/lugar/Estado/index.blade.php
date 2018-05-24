@extends('admin.template.main2')

@section('title', 'Listar estados')

@section('contenido-header-name', 'Estado')

@section('contenido-header-name2', 'Listado de estados')

@section('contenido-header-route')
	<ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Estado</li>
                </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12 ">

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