@extends('admin.template.main2')

@section('title', 'Listar nota de entrega')

@section('contenido-header-name', 'Nota de entrega')

@section('contenido-header-name2', 'listado de las notas de entrega')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nota de entrega</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">
		<div>
			<a href="{{ route('venta.index') }}" class="btn btn-info" title="Lista de ventas">
						<span class="fa fa-bars"></span>
			</a>
			{!! Form::label('venta','Registrar nota de entrega de una venta.',['class'=> ' col-sm']) !!}
		</div>
		<div class="row">
			<div class="col-sm-12">
				 

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>id</th>
				      <th>Fecha</th>
				      <th>Subtotal / Total</th>
				      <th>Observaciones</th>
				      <th>Venta relacionada</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($notaEntregas as $notaEntrega)
				  		@if ($notaEntrega->venta->ven_eliminada === 0)
				  			<tr>
					      <th scope="row">{{ $notaEntrega->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($notaEntrega->not_fecha))}}</td>	
					      <td>{{ $notaEntrega->not_subtotal . " Bs / " . $notaEntrega->not_subtotal*1.12." Bs" }}</td>
					      <td>{{ $notaEntrega->not_observaciones}}</td>
					      <td>{{ "Venta #".$notaEntrega->venta->id." efectuada ".date("d/m/Y", strtotime($notaEntrega->venta->ven_fecha_compra))}}</td>
					     

					      <td>
					      	<a href="{{ route('notaEntrega.show', $notaEntrega->id) }}"  class="btn btn-info" title="Ver nota de entrega" target="_blank">
					      		<span class="class glyphicon glyphicon-file"></span>
						    </a> 
						    <a href="{{ route('notaEntrega.download', $notaEntrega->id) }}"  class="btn btn-default" title="Descargar nota de entrega" target="_blank">
						      		<span class="class glyphicon glyphicon-floppy-save"></span>
						    </a>
					      	<a href="{{ route('notaEntrega.edit', $notaEntrega->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
					      	
					      	<a href="{{ route('notaEntrega.destroy', $notaEntrega->id) }}" onclick="return confirm('Eliminar el registroPago?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      	<a href="{{ route('notaEntrega.show', $notaEntrega->id) }}" class="btn btn-primary" title="Enviar notaEntrega al cliente">
					      		<span class="glyphicon glyphicon-send"></span>
					      	</a>
					      	
					      </td>
				    	</tr>
				  		@endif
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $notaEntregas->links() }}


				
			</div>

			
			
		</div>
			
	</section>


	

@endsection