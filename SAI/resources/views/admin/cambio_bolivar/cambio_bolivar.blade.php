@extends('admin.template.main2')

@section('contenido-header-name','Cotización del dolar')
@section('contenido-header-name2','Registrar nueva cotización')

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
				{!! Form::open(['route' => 'cambio_bolivar.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('ban_nombre','Fecha') !!}

						{!! Form::text('fecha',(\Carbon\Carbon::now())->format('d-m-Y'),['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 10', 'placeholder'=>'Nombre del banco.', 'required', 'minlength'=>'4', 'maxlength' => '10', 'pattern'=>'[0-9-]+', 'readonly'=>'true']) !!}

						{!! Form::label('ban_nombre','Cotización') !!}

						{!! Form::text('precio_dolar',null,['class'=> 'form-control','title'=>'Solo numeros de 0-9, min: 1 max: 10, con 2 decimales', 'placeholder'=>'1234567899.12', 'required', 'minlength'=>'1', 'maxlength' => '12', 'pattern'=>'[0-9][0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[0-9]?[\.]?[0-9]?{1,2}']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>

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
					      	<td>{{--  
					      	<a href="{{ route('cotizacion.edit', $cotizacion->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>
				--}}
					      	<a href="{{ route('cambio_bolivar.destroy', [$cotizacion->fecha]) }}" onclick="return confirm('Eliminar el cotizacion?')" class="btn btn-danger">
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
			
		</div>
			
	</section>
	

@endsection