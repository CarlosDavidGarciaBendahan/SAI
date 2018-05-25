@extends('admin.template.main2')

@section('title', 'Listar personal')

@section('contenido-header-name', 'Listado de personal')

@section('contenido-header-name2', 'listar  personal')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Personal</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('personal.create') }}" class="btn btn-info">Registrar nuevo personal</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>RIF</th>
				      <th>Nombre</th>
				      <th>Apellido</th>
				      <th>Correo</th>
				      <th>oficina</th>
				      <th>Rol</th>
				      <th>Dirección</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($personals as $personal)
				  		<tr>
					      <th scope="row">{{ $personal->per_identificador ."-".$personal->per_cedula }}</th>
					      <td>{{ $personal->per_nombre ." ".$personal->per_nombre2 }}</td>	
					      <td>{{ $personal->per_apellido ." ".$personal->per_apellido2 }}</td>	
					      <td>
					      	@foreach( $personal->Contacto_correos as $correo )
					      		{{ $correo->con_cor_correo }}
					      	@endforeach
					  	  </td>
					  	  <td>{{ $personal->oficina->ofi_direccion}}</td>	
					  	  <td>{{ $personal->rol->rol_rol}}</td>	
					      <td>{{ $personal->per_direccion .", ". $personal->parroquia->par_nombre.", Mun.".$personal->parroquia->municipio->mun_nombre.", Edo. ".$personal->parroquia->municipio->estado->est_nombre }}</td>
					      <td>
					      	<a href="{{ route('personal.edit', $personal->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('personal.destroy', $personal->id) }}" onclick="return confirm('Eliminar el personal?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 

					      	<a href="{{ route('personal.show', $personal->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $personals->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection


