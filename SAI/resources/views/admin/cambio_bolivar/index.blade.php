@extends('admin.template.main2')

@section('title', 'Listar cotizaciones')

@section('contenido-header-name', 'Cotización')

@section('contenido-header-name2', 'listado de cotizaciones')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Fecha</th>
				      <th>Cotización</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($cotizaciones as $cotizacion)
				  		<tr>
					      <th scope="row">{{ $cotizacion->fecha }}</th>
					      <td>{{  $cotizacion->precio_dolar}}</td>	
					      <td>
					      	<a href="{{ route('cotizacion.edit', $cotizacion->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('cotizacion.destroy', $cotizacion->id) }}" onclick="return confirm('Eliminar el cotizacion?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $cotizaciones->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection