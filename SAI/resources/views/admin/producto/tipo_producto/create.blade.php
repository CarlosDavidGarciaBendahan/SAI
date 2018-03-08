@extends('admin.template.main')

@section('title', 'Crear Tipo producto')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'tipo_producto.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('tip_tipo','Tipo de producto') !!}

						{!! Form::text('tip_tipo',null,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection