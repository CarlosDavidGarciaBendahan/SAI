@extends('admin.template.main2')

@section('title', 'Listar modelos')

@section('contenido-header-name', 'Listado de modelos')

@section('contenido-header-name2', 'listar modelos')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('modelo.index') }}"> Modelo</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('modelo.create') }}" class="btn btn-info">Registrar nuevo modelo</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Modelo</th>
				      <th>Marca</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($modelos as $modelo)
				  		<tr>
					      <th scope="row">{{ $modelo->id }}</th>
					      <td>{{ $modelo->mod_modelo }}</td>	
					      <td>{{ $modelo->marca->mar_marca }}</td>	
					      <td>
					      	<a href="{{ route('modelo.edit', $modelo->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('modelo.destroy', $modelo->id) }}" onclick="return confirm('Eliminar el modelo?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<!--
					      	<a href="{{ route('modelo.show', $modelo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					     	 -->
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $modelos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection