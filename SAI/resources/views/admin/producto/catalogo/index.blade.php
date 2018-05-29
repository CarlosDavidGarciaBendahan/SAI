@extends('admin.template.main2')

@section('contenido-header-name','Catálogo de productos de Indatech C.A.')
@section('contenido-header-name2','catálogo')



@section('body')

	<div class="containter col-sm-12"><!-- CONTENEDOR PRINCIPAL DONDE ESTARAN TODOS LOS PRODUCTOS-->
		@foreach ($PCs as $PC)
		
			<div class="col-sm-6"><!-- PONGO 3 PRODUCTOS POR FILA -->
				<div class="container col-sm-12 producto">
					<div class="col-sm-4">
						@foreach ($PC->imagenes as $imagen)
							<a href="{{ route('producto_computador.show', $PC->id) }}" class="">
					      		<img class="img-fluid" src="{{"\\imagenes\\computador\\".$imagen->ima_nombre  }}" width="150" height="150">
					      	</a>
						@endforeach
					</div>
					<div class="col-sm-8">
						<div>código: {{ $PC->pro_com_codigo }}</div>
						<div>descripción: {{ $PC->pro_com_descripcion}}</div>
						<div>precio: {{ $PC->pro_com_precio." ".$PC->pro_com_moneda }}</div>
						<div class="">Componentes: 
						
							@foreach ($PC->articulos as $componente)
							{{ $componente->tipo_producto->tip_tipo." ".$componente->modelo->marca->mar_marca." ".$componente->modelo->mod_modelo." ".$componente->pro_art_capacidad." ".$componente->unidadmedida->uni_medida." / " }}
							
							
							@endforeach
						</div>
					</div>
				</div>
			</div>
		
		@endforeach
	</div>
	
@endsection