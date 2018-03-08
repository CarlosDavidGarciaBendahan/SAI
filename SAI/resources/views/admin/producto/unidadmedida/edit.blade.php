@extends('admin.template.main')

@section('title', 'Editar unidad de medida '. $unidadmedida->uni_meidda)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['unidadmedida.update',$unidadmedida], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('uni_medida','Unidad de medida') !!}

						{!! Form::text('uni_medida',$unidadmedida->uni_medida,['class'=> 'form-control', 'placeholder'=>'unidad de medida', 'required']) !!}
					</div>

					
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection