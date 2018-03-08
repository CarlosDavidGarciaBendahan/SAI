@extends('admin.template.main')

@section('title', 'Editar marca '. $marca->mar_marca)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['marca.update',$marca], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('mar_marca','Marca') !!}

						{!! Form::text('mar_marca',$marca->mar_marca,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection