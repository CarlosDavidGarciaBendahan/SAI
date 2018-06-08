@extends('admin.template.main2')

@section('title', 'Listar parroquias')

@section('contenido-header-name', 'Parroquias')

@section('contenido-header-name2', 'listado de parroquias')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Parroquia</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('parroquia.create') }}" class="btn btn-info">Registrar nueva parroquia</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Nombre de la parroquia</th>
				      <th>Parte del municipio</th>
				      <th>Parte del estado</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($parroquias as $parroquia)
				  		<tr>
					      <th scope="row">{{ $parroquia->id }}</th>
					      <td>{{ $parroquia->par_nombre }}</td>	
					      <td>{{ $parroquia->municipio->mun_nombre }}</td>	
					      <td>{{ $parroquia->municipio->estado->est_nombre}}</td>
					      <td>
					      	<a href="{{ route('parroquia.edit', $parroquia->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('parroquia.destroy', $parroquia->id) }}" onclick="return confirm('Eliminar el parroquia?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<!--
					      	<a href="{{ route('parroquia.show', $parroquia->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	-->
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $parroquias->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection