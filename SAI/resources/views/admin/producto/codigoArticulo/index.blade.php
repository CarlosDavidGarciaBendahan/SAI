@extends('admin.template.main2')

@section('title', 'Listar articulos detallados')

@section('contenido-header-name', 'Listar de productos')

@section('contenido-header-name2', 'listado de productos detallados')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_articulo.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoArticulo.index') }}"> Producto detallado</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Ubicación</th>
				      <th>Disponible</th>
				      <th>Componente del computador</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($codigosArticulo as $codigoArticulo)
				  		<tr>
					      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
					      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
					      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
					      
					      <td>{{ $codigoArticulo->producto_articulo->sector->sec_sector ." Ofi: ".$codigoArticulo->producto_articulo->sector->oficina->ofi_direccion }}</td>	
					      
					  	  <td>
					  	  	@if (count($codigoArticulo->Solicitudes) === 0 && count($codigoArticulo->Ventas) === 0  )
					  	  		<a href="#" class="btn btn-success" title="Disponible">
					      		<span class="class glyphicon glyphicon-ok"></span>
					      		</a>
					  	  	@else
					  	  		<a href="#" class="btn btn-danger" title="Vendido">
					      		<span class="class glyphicon glyphicon-ban-circle"></span>
					      		</a>
					  	  	@endif
					  	  </td>
					      


					        @if ($codigoArticulo->cod_art_fk_pc !== null)
						  	  	
						  	  	<td>
						  	  		<a  class="btn btn-danger" title="Asignado">
						      		{{$codigoArticulo->codigopc->cod_pc_codigo }}<span class="class glyphicon glyphicon-ban-circle"></span>
						      		</a>
						  	  	</td>
						  	  @else
						  	  	<td>
						  	  		<a  class="btn btn-success" title="No esta asignado a ninguna PC">
						      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a>
						  	  	</td>
						  	@endif

						  	<td>
					      	<a href="{{ route('codigoArticulo.edit', $codigoArticulo->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('codigoArticulo.destroy', $codigoArticulo->id) }}" onclick="return confirm('Eliminar el codigoArticulo?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('codigoArticulo.show', $codigoArticulo->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      </td>

				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $codigosArticulo->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection