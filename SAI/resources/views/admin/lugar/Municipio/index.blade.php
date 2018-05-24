@extends('admin.template.main2')

@section('title', 'Listar municipios')

@section('contenido-header-name', 'Municipio')

@section('contenido-header-name2', 'listado de municipios')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Municipio</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('municipio.create') }}" class="btn btn-info">Registrar nuevo municipio</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Nombre del municipio</th>
				      <th>Parte del estado</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($municipios as $municipio)
				  		<tr>
					      <th scope="row">{{ $municipio->id }}</th>
					      <td>{{ $municipio->mun_nombre }}</td>	
					      <td>{{ $municipio->estado->est_nombre }}</td>	
					      <td>
					      	<a href="{{ route('municipio.edit', $municipio->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('municipio.destroy', $municipio->id) }}" onclick="return confirm('Eliminar el municipio?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('municipio.show', $municipio->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $municipios->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection