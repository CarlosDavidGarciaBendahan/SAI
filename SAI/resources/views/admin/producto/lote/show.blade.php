@extends('admin.template.main')

@section('title', 'Información de Lote')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'lote.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('lot_nombre','Nombre del lote') !!}

						{!! Form::text('lot_nombre',$lote->lot_nombre,['class'=> 'form-control', 'placeholder'=>'nombre', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('lot_fecha_recibido','Fecha recibido') !!}

						{!! Form::text('lot_fecha_recibido', $lote->lot_fecha_recibido, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control')) !!}
					</div>


					<div>
						<a href="{{ route('lote.index') }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					      	</a>
					</div>

					<h1>AGREGAR TABLA CON LOS PRODUCTOS DE ESTE LOTE.</h1>

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

