@extends('admin.template.main2')

@section('title', 'Listar articulos')

@section('contenido-header-name', 'Listado de articulos')

@section('contenido-header-name2', 'listar articulos')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Artículo</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('producto_articulo.create') }}" class="btn btn-info">Registrar nuevo articulo</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Descripción</th>
				      <th>Precio</th>
				      <th>Publicado</th>
				      <th>Ubicación</th>
				      <th>Marca</th>
				      <th>Tipo</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($producto_articulos as $producto_articulo)
				  		<tr>
					      <th scope="row">{{ $producto_articulo->pro_art_codigo }}</th>
					      <td>{{ $producto_articulo->pro_art_descripcion }}</td>	
					      <td>{{ $producto_articulo->pro_art_precio . $producto_articulo->pro_art_moneda }}</td>
					      <td>@if ($producto_articulo->pro_art_catalogo !== 0)
					      	SI
					      @else
					      	NO
					      @endif</td>	
					      <td>{{ $producto_articulo->sector->sec_sector ." Ofi: ".$producto_articulo->sector->oficina->ofi_direccion }}</td>	
					      <td>{{ $producto_articulo->modelo->marca->mar_marca . " Modelo: " .$producto_articulo->modelo->mod_modelo   }}</td>	
					      <td>{{ $producto_articulo->tipo_producto->tip_tipo}}</td>		
					      <td>
					      	<a href="{{ route('producto_articulo.edit', $producto_articulo->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('producto_articulo.destroy', $producto_articulo->id) }}" onclick="return confirm('Eliminar el producto_articulo?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('producto_articulo.show', $producto_articulo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	<a href="{{ route('codigoArticulo.create', $producto_articulo->id) }}" class="btn btn-success" title="Agregar Articulos">
					      		<span class="glyphicon glyphicon-plus-sign"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $producto_articulos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection