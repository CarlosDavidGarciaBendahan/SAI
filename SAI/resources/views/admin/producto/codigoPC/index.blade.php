@extends('admin.template.main')

@section('title', 'Listar computadoras detalladas')

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
				      <th>Publicado?</th>
				      <th>Disponible</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($codigosPC as $codigoPC)
				  		<tr>
					      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
					      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
					      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
					      
					      <td>{{ $codigoPC->producto_computador->sector->sec_sector ." Ofi: ".$codigoPC->producto_computador->sector->oficina->ofi_direccion }}</td>	
					      <td>
					      	@if ($codigoPC->producto_computador->pro_com_catalogo !== 0)
					      		SI
						    @else
						      	NO
						    @endif
					  	  </td>	
					  	  <td>
					  	  	@if (count($codigoPC->Solicitudes) === 0 && count($codigoPC->Ventas) === 0  )
					  	  		<a href="#" class="btn btn-success" title="Disponible">
					      		<span class="class glyphicon glyphicon-ok"></span>
					      		</a>
					  	  	@else
					  	  		<a href="#" class="btn btn-danger" title="Vendido">
					      		<span class="class glyphicon glyphicon-ban-circle"></span>
					      		</a>
					  	  	@endif
					  	  </td>
					      <td>
					      	<a href="{{ route('codigoPC.edit', $codigoPC->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('codigoPC.destroy', $codigoPC->id) }}" onclick="return confirm('Eliminar el codigoPC?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('codigoPC.show', $codigoPC->id) }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</a>
					      	<a href="{{ route('codigoArticulo.create', $codigoPC->id) }}" class="btn btn-success" title="Agregar Articulos">
					      		<span class="glyphicon glyphicon-plus-sign"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $codigosPC->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection