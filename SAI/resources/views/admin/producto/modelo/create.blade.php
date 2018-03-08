@extends('admin.template.main')

@section('title', 'Crear modelo')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'modelo.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('mod_fk_marca','Marca') !!}
						{!! Form::select('mod_fk_marca',$marcas, null, ['class'=>'form-control', 'placeholder'=>'Elegir una marca', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mod_modelo','Modelo') !!}

						{!! Form::text('mod_modelo',null,['class'=> 'form-control', 'placeholder'=>'Modelo', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection