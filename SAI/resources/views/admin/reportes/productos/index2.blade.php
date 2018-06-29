@extends('admin.template.main2')

@section('title', 'Reporte de productos')

@section('contenido-header-name', 'Listar de productos')

@section('contenido-header-name2', 'listado de productos detallados')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection
@section('body')
	{{-- {{ dd($estado) }} --}}
	<br>
	<section class="container">

		<div class="container col-sm-6">
			<div class="col-sm-10 offset-1">
				{!! Form::label('cli_nat_direccion','Lista de las computadoras') !!}
				<div>
					<table class="table table-inverse">
					  <thead>
					    <tr>
					      <th>Código</th>
					      <th>Marca/Modelo</th>
					      <th>Tipo</th>
					      <th>Componentes</th>
					      <th>Disponible</th>

					    </tr>
					  </thead>
					  <tbody>

					  	@foreach ($PCs as $codigoPC)
					  		<tr>
						      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
						      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
						      
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

						      	<a href="{{ route('codigoPC.show', $codigoPC->id) }}" class="btn btn-default" title="Ver detalles">
						      		<span class="fa fa-eye"></span>
						      	</a>
						      </td>
					    	</tr>
					  	@endforeach

					  </tbody>

					</table>
					{{ $PCs->links() }}
				</div>	
			</div>
		</div>

		<div class="container col-sm-6">
			<div class="col-sm-10 offset-1">
				
				{!! Form::label('cli_nat_direccion','Lista de los artículos') !!}
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Disponible</th>
				      <th>PC</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($Articulos as $codigoArticulo)
				  		<tr>
					      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
					      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
					      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
					      
					      
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
					      	<a href="{{ route('codigoArticulo.show', $codigoArticulo->id) }}" class="btn btn-default" title="Ver detalles">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>

				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $Articulos->links() }}
			
			</div>

		</div>

			

			
			
	</section>


	

@endsection