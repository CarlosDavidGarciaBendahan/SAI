@extends('admin.template.main2')

@section('title', 'Listar unidades de medida')

@section('contenido-header-name', 'Listado de unidades de medida')

@section('contenido-header-name2', 'listar unidades de medida')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('unidadmedida.index') }}"> Unidad de medida</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('unidadmedida.create') }}" class="btn btn-info">Registrar nueva unidad de medida</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Unidad de medida</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($unidadesmedida as $unidadmedida)
				  		<tr>
					      <th scope="row">{{ $unidadmedida->id }}</th>
					      <td>{{ $unidadmedida->uni_medida }}</td>	
					      <td>
					      	<a href="{{ route('unidadmedida.edit', $unidadmedida->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('unidadmedida.destroy', $unidadmedida->id) }}" onclick="return confirm('Eliminar el unidad medida?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $unidadesmedida->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection