@extends('admin.template.main2')

@section('title', 'Listar oficinas')

@section('contenido-header-name', 'Listado de oficinas')

@section('contenido-header-name2', 'listar oficinas')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Oficina</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('oficina.create') }}" class="btn btn-info">Registrar nueva oficina</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Tipo de oficina</th>
				      <th>Dirección</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($oficinas as $oficina)
				  		<tr>
					      <th scope="row">{{ $oficina->id }}</th>
					      <td>{{ $oficina->ofi_tipo }}</td>	
					      <td>{{ $oficina->ofi_direccion .", ". $oficina->parroquia->par_nombre.", Mun.".$oficina->parroquia->municipio->mun_nombre.", Edo. ".$oficina->parroquia->municipio->estado->est_nombre }}</td>
					      <td>
					      	<a href="{{ route('oficina.edit', $oficina->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('oficina.destroy', $oficina->id) }}" onclick="return confirm('Eliminar el oficina?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('oficina.show', $oficina->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $oficinas->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


