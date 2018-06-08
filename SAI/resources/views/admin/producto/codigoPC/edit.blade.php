@extends('admin.template.main2')

@section('title', 'Modificar computador')

@section('contenido-header-name', 'Edición de producto')

@section('contenido-header-name2', 'editar producto detallado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('producto_computador.index') }}"> Producto</a></li>
        <li class="active"><a href="{{ route('codigoPC.index') }}"> Producto detallado</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => ['codigoPC.update',$codigoPC], 'method' => 'PUT']) !!}
					
						
						<div class="form-group ">
							{!! Form::label('cod_pc_fk_producto_computador','Descripcion del producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_descripcion,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('cod_pc_fk_producto_computador',$codigoPC->Producto_Computador->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>
						<div class="form-group ">

							{!! Form::label('cod_pc_fk_producto_computador','Codigo general del producto') !!}
							{!! Form::text('codigo',$codigoPC->Producto_Computador->pro_com_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_pc_fk_producto_computador','Marca') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->modelo->marca->mar_marca ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_pc_fk_producto_computador','Modelo') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->modelo->mod_modelo ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						
						<div class="form-group ">

							{!! Form::label('cod_pc_fk_producto_computador','Oficina') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->sector->oficina->ofi_direccion ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group ">

							{!! Form::label('cod_pc_fk_producto_computador','Sector') !!}
							{!! Form::text('codigo',$codigoPC->producto_computador->sector->sec_sector ,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
						</div>



						<div class="form-group ">
							{!! Form::label('cod_pc','Código especifico') !!}
							{!! Form::text('cod_pc_codigo',$codigoPC->cod_pc_codigo,['class'=> 'form-control', 'placeholder'=>'B208802', 'required', 'readonly'=>'true']) !!}
							{!! Form::text('id',$codigoPC->id,['class'=> 'form-control hidden', 'readonly'=>'true', 'required']) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_pc_fk_lote','Lote del computador') !!}
							{!! Form::select('cod_pc_fk_lote',$lote, $codigoPC->lote->id, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>

						<div class="form-group ">
							{!! Form::label('cod_pc_fk_lote','Estado del producto') !!}
							{!! Form::select('cod_pc_estado',['B' => 'Bueno','M'=>'Malo'], $codigoPC->cod_pc_estado, ['class'=>'form-control', 'placeholder'=>'', 'required'] ) !!}
						</div>
						
				<div class="form-group ">
					{!! Form::label('cod_pc_fk_lote','Listado de los articulos') !!}
				</div>		
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código del articulo</th>
				      <th>Descripcion</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Capacidad</th>
				      <th>Sector</th>
				      <th>Compone A</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($codigosArticulo as $codigoArticulo)
					  		<tr>
						      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
						      <td>{{ $codigoArticulo->producto_articulo->pro_art_descripcion  }}</td>
						      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
						      <td>{{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}</td>
						      <td>{{ $codigoArticulo->producto_articulo->sector->sec_sector ." Ofi: ".$codigoArticulo->producto_articulo->sector->oficina->ofi_direccion }}</td>	
						      
						  	  @if ($codigoArticulo->cod_art_fk_pc !== null)
						  	  	
						  	  	<td>
						  	  		<a href="#" class="btn btn-danger" title="Asignado">
						      		{{$codigoArticulo->codigopc->cod_pc_codigo }}<span class="class glyphicon glyphicon-ban-circle"></span>
						      		</a>
						  	  	</td>
						  	  @else
						  	  	<td>
						  	  		<a href="#" class="btn btn-success" title="No esta asignado a ninguna PC">
						      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a>
						  	  	</td>
						  	  @endif
						  	  

						  	  
						  	   

							    @if ($codigoArticulo->cod_art_fk_pc !== null && $codigoArticulo->cod_art_fk_pc === $codigoPC->id)
							    	<td>
								      	<a href="{{ route('codigoArticulo.quitarPC', [$codigoArticulo->id, $codigoPC->id]) }}" onclick="return confirm('Esta seguro de que quiere DESVINCULAR este articulo al computador?')" class="btn btn-warning" title="Desvincular este articulo del computador">
								      		<span class="class glyphicon glyphicon-link"></span>
								      	</a>  
								    </td>
								@else
									<td>
								      	<a href="{{ route('codigoArticulo.asignarPC', [$codigoArticulo->id, $codigoPC->id]) }}" onclick="return confirm('Esta seguro de que quiere asignar este articulo al computador?')" class="btn btn-info" title="Vincular este articulo al computador">
								      		<span class="class glyphicon glyphicon-link"></span>
								      	</a>  
							    	</td>
							    @endif
						      
					    	</tr>
					@endforeach

					  </tbody>

					</table>
					{{ $codigosArticulo->links() }}
						
						<!--
						<div class="form-group">
							{!! Form::submit('Agregar código',['class'=>'btn btn-primary', 'id' => 'add']) !!}
						</div>

						<div class="codigoPC">
							
						</div>
						-->
					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('codigoPC.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/FormDinamicoAgregarCodigoPC.js') }}"></script>
@endsection
