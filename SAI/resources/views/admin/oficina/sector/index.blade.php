@extends('admin.template.main2')

@section('title', 'Listar sectores')

@section('contenido-header-name', 'Listado de sectores')

@section('contenido-header-name2', 'listar sectores')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sector</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('sector.create') }}" class="btn btn-info">Registrar nuevo sector</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Sector</th>
				      <th>Oficina</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($sectores as $sector)
				  		<tr>
					      <th scope="row">{{ $sector->id }}</th>
					      <td>{{ $sector->sec_sector }}</td>	
					      <td>{{ $sector->oficina->ofi_direccion . " Par. " .$sector->oficina->parroquia->par_nombre . " Mun. " .$sector->oficina->parroquia->municipio->mun_nombre . " Edo. " . $sector->oficina->parroquia->municipio->estado->est_nombre}}</td>
					      <td>
					      	<a href="{{ route('sector.edit', $sector->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('sector.destroy', $sector->id) }}" onclick="return confirm('Eliminar el sector?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $sectores->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


