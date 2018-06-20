@extends('admin.template.main2')

@section('title', 'Listar estados')

@section('contenido-header-name', 'Fuente de venta')

@section('contenido-header-name2', 'Listado de fuente de ventas')

@section('contenido-header-route')
	<ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active"> Fuente de ventas</li>
                </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12 ">

				<a href="{{ route('fuenteventa.create') }}" class="btn btn-info">Registrar nueva fuente de venta</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Nombre</th>
				      <th>Descripcion</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($fuenteVentas as $fuenteventa)
				  		<tr>
					      <th scope="row">{{ $fuenteventa->id }}</th>
					      <td>{{ $fuenteventa->nombre }}</td>
					      <td>{{ $fuenteventa->descripcion }}</td>		
					      
					      <td>
					      	<a href="{{ route('fuenteventa.edit', $fuenteventa->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('fuenteventa.destroy', $fuenteventa->id) }}" onclick="return confirm('Eliminar el fuenteVenta?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<!--
					      	<a href="{ { route('fuenteVenta.show', $fuenteventa->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>-->
					      </td>
					  		
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $fuenteVentas->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection