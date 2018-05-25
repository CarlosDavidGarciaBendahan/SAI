@extends('admin.template.main2')

@section('title', 'Listar Clientes')

@section('contenido-header-name', 'Listado de personas')

@section('contenido-header-name2', 'listar personas')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Persona</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('cliente_natural.create') }}" class="btn btn-info">Registrar nuevo cliente</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>RIF</th>
				      <th>Nombre</th>
				      <th>Apellido</th>
				      <th>Correo</th>
				      <th>Dirección</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($clientes_naturales as $cliente_natural)
				  		<tr>
					      <th scope="row">{{ $cliente_natural->cli_nat_identificador ."-".$cliente_natural->cli_nat_cedula }}</th>
					      <td>{{ $cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_nombre2 }}</td>	
					      <td>{{ $cliente_natural->cli_nat_apellido ." ".$cliente_natural->cli_nat_apellido2 }}</td>	
					      <td>
					      	@foreach( $cliente_natural->Contacto_correos as $correo )
					      		{{ $correo->con_cor_correo }}
					      	@endforeach
					  	  </td>
					      <td>{{ $cliente_natural->cli_nat_direccion .", ". $cliente_natural->parroquia->par_nombre.", Mun.".$cliente_natural->parroquia->municipio->mun_nombre.", Edo. ".$cliente_natural->parroquia->municipio->estado->est_nombre }}</td>
					      <td>
					      	<a href="{{ route('cliente_natural.edit', $cliente_natural->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('cliente_natural.destroy', $cliente_natural->id) }}" onclick="return confirm('Eliminar el cliente_natural?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('cliente_natural.show', $cliente_natural->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
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


