@extends('admin.template.main2')

@section('title', 'Reporte Clientes')

@section('contenido-header-name', 'Reporte de clientes')

@section('contenido-header-name2', 'listar clientes')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reporte clientes</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<h1>TORTA DE CLIENTES QUE MÁS COMPRAN</h1>
		</div>
		<div class="row">
			<div class="col-sm-12">

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Identificador</th>
				      <th>Nombre</th>
				      <th>Dirección</th>
				      <th>Tipo de cliente</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<!-- CONTENIDO DE CLIENTES NATURALES-->
				  	@foreach ($clientes_naturales as $cliente_natural)
				  		<tr>
					      <th scope="row">{{ $cliente_natural->cli_nat_identificador ."-".$cliente_natural->cli_nat_cedula }}</th>
					      <td>
					      	{{ $cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_nombre2." ". $cliente_natural->cli_nat_apellido ." ".$cliente_natural->cli_nat_apellido2 }}
					      </td>	
					      <td>
					      	{{ $cliente_natural->cli_nat_direccion .", ". $cliente_natural->parroquia->par_nombre.", Mun.".$cliente_natural->parroquia->municipio->mun_nombre.", Edo. ".$cliente_natural->parroquia->municipio->estado->est_nombre }}
					      </td>
					      <td>Persona</td>
					      <td>

					      	<a href="{{ route('cliente_natural.show', $cliente_natural->id) }}" class="btn btn-default">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach
				  	<!-- CONTENIDO DE CLIENTES JURIDICOS-->
				  		@foreach ($clientes_juridicos as $cliente_juridico)
				  		<tr>
					      <th scope="row">{{ $cliente_juridico->cli_jur_identificador ."-".$cliente_juridico->cli_jur_rif }}</th>
					      <td>{{ $cliente_juridico->cli_jur_nombre }}</td>	
					      <td>{{ $cliente_juridico->cli_jur_direccion .", ". $cliente_juridico->parroquia->par_nombre.", Mun.".$cliente_juridico->parroquia->municipio->mun_nombre.", Edo. ".$cliente_juridico->parroquia->municipio->estado->est_nombre }}</td>
					      <td>Empresa</td>
					      <td>

					      	<a href="{{ route('cliente_juridico.show', $cliente_juridico->id) }}" class="btn btn-default">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $clientes_naturales->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


