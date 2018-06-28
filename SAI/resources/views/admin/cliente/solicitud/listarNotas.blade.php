@extends('admin.template.main2')

@section('title', 'Listar nota de entrega')

@section('contenido-header-name', 'Registro de solicitud')

@section('contenido-header-name2', 'listado de notas de entrega')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('solicitud.index') }}"> Solicitud</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div>
				{!! Form::label('venta','Para crear una solicitud, precione el botón "crear solicitud" en la Nota de Entrega que corresponda.',['class'=> ' col-sm-12']) !!}
			</div>
			<div class="col-sm-8 offset-2">
				 

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
						      	
						      	{{-- $dias = (\Carbon\Carbon::parse((\Carbon\Carbon::now())->format('d-m-Y')))->diffInDays(\Carbon\Carbon::parse($notaEntrega->not_fecha))
							       
							    --}}
							    @if ( (\Carbon\Carbon::parse((\Carbon\Carbon::now())->format('d-m-Y')))->diffInDays(\Carbon\Carbon::parse($notaEntrega->not_fecha)) <= 90)
							    	<a href="{{ route('solicitud.create', $notaEntrega->id) }}" class="btn btn-primary" title="Crear solicitud">
							      		<span class="glyphicon glyphicon-inbox"></span>
							      	</a>
							    @else
							    	<a  class="btn btn-danger" title="No tiene garantía">
							      		<span class="glyphicon glyphicon-inbox"></span>
							      	</a>
							    @endif
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