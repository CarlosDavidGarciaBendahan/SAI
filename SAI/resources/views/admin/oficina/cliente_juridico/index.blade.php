@extends('admin.template.main2')

@section('title', 'Listar Clientes juridicos')

@section('contenido-header-name', 'Listado de empresa')

@section('contenido-header-name2', 'listar empresa')

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
			<div class="col-sm-8 offset-2">

				<a href="{{ route('cliente_juridico.create') }}" class="btn btn-info">Registrar nuevo cliente juridico</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>RIF</th>
				      <th>Nombre</th>
				      <th>Dirección</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($clientes_juridicos as $cliente_juridico)
				  		<tr>
					      <th scope="row">{{ $cliente_juridico->cli_jur_identificador ."-".$cliente_juridico->cli_jur_rif }}</th>
					      <td>{{ $cliente_juridico->cli_jur_nombre }}</td>	
					      <td>{{ $cliente_juridico->cli_jur_direccion .", ". $cliente_juridico->parroquia->par_nombre.", Mun.".$cliente_juridico->parroquia->municipio->mun_nombre.", Edo. ".$cliente_juridico->parroquia->municipio->estado->est_nombre }}</td>
					      <td>
					      	<a href="{{ route('cliente_juridico.edit', $cliente_juridico->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('cliente_juridico.destroy', $cliente_juridico->id) }}" onclick="return confirm('Eliminar el cliente_juridico?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('cliente_juridico.show', $cliente_juridico->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $clientes_juridicos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


