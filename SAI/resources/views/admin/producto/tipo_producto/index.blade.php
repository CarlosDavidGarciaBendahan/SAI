@extends('admin.template.main2')

@section('title', 'Listar Tipo de productos')

@section('contenido-header-name', 'Listado de tipos de producto')

@section('contenido-header-name2', 'listar tipos de producto')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('tipo_producto.index') }}"> Tipo de producto</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('tipo_producto.create') }}" class="btn btn-info">Registrar nuevo tipo de producto</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>Tipo de producto</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($tipo_productos as $tipo_producto)
				  		<tr>
					      <th scope="row">{{ $tipo_producto->id }}</th>
					      <td>{{ $tipo_producto->tip_tipo }}</td>	
					      <td>
					      	<a href="{{ route('tipo_producto.edit', $tipo_producto->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('tipo_producto.destroy', $tipo_producto->id) }}" onclick="return confirm('Eliminar el tipo_producto?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $tipo_productos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection