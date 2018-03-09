@extends('admin.template.main')

@section('title', 'Listar marcas')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('marca.create') }}" class="btn btn-info">Registrar nueva marca</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Marca</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($marcas as $marca)
				  		<tr>
					      <th scope="row">{{ $marca->id }}</th>
					      <td>{{ $marca->mar_marca }}</td>	
					      <td>
					      	<a href="{{ route('marca.edit', $marca->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('marca.destroy', $marca->id) }}" onclick="return confirm('Eliminar el marca?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('marca.show', $marca->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $marcas->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection