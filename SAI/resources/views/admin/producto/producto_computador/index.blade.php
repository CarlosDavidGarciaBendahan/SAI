@extends('admin.template.main')

@section('title', 'Listar Computadoras')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('producto_computador.create') }}" class="btn btn-info">Registrar nuevo computador</a>
				

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

				  	@foreach ($producto_computadoras as $producto_computador)
				  		<tr>
					      <th scope="row">{{ $producto_computador->pro_com_codigo }}</th>
					      <td>{{ $producto_computador->pro_com_descripcion }}</td>	
					      <td>{{ $producto_computador->pro_com_precio . $producto_computador->pro_com_moneda }}</td>
					      <td>@if ($producto_computador->pro_com_catalogo !== 0)
					      	SI
					      @else
					      	NO
					      @endif</td>	
					      <td>{{ $producto_computador->sector->sec_sector ." Ofi: ".$producto_computador->sector->oficina->ofi_direccion }}</td>	
					      <td>{{ $producto_computador->modelo->marca->mar_marca . " Modelo: " .$producto_computador->modelo->mod_modelo   }}</td>	
					      <td>{{ $producto_computador->tipo_producto->tip_tipo}}</td>		
					      <td>
					      	<a href="{{ route('producto_computador.edit', $producto_computador->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('producto_computador.destroy', $producto_computador->id) }}" onclick="return confirm('Eliminar el producto_computador?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('producto_computador.show', $producto_computador->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $producto_computadoras->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection