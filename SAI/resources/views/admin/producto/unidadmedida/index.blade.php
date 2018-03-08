@extends('admin.template.main')

@section('title', 'Listar unidades de medida')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

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