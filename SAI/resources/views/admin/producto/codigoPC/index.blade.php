@extends('admin.template.main2')

@section('title', 'Listar computadoras detalladas')

@section('contenido-header-name', 'Listar de productos')

@section('contenido-header-name2', 'listado de productos detallados')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_computador.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoPC.index') }}"> Producto detallado</a></li>
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
				      <th>Componentes</th>
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
					      	@foreach ($codigoPC->CodigoArticulos as $componente)
					      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
					      	@endforeach
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