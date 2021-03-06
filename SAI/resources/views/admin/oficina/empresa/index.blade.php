@extends('admin.template.main2')

@section('title', 'Listar empresas')

@section('contenido-header-name', 'Listado de empresas')

@section('contenido-header-name2', 'lista de empresas')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Empresa</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('empresa.create') }}" class="btn btn-info">Registrar nueva empresa</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>RIF</th>
				      <th>Nombre</th>
				      <th>Dirección</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($empresas as $empresa)
				  		<tr>
					      <th scope="row">{{ $empresa->emp_identificador ."-".$empresa->emp_rif }}</th>
					      <td>{{ $empresa->emp_nombre }}</td>	
					      <td>{{ $empresa->emp_direccion .", ". $empresa->parroquia->par_nombre.", Mun.".$empresa->parroquia->municipio->mun_nombre.", Edo. ".$empresa->parroquia->municipio->estado->est_nombre }}</td>
					      <td>
					      	<a href="{{ route('empresa.edit', $empresa->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('empresa.destroy', $empresa->id) }}" onclick="return confirm('Eliminar el empresa?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('empresa.show', $empresa->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $empresas->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


