@extends('admin.template.main')

@section('title', 'Editar modelo '. $modelo->mod_modelo)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['modelo.update',$modelo], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						{!! Form::label('mod_fk_marca','Marca') !!}
						{!! Form::select('mod_fk_marca',$marcas, $modelo->marca->id, ['class'=>'form-control', 'placeholder'=>'Elegir una marca', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mod_modelo','Modelo') !!}

						{!! Form::text('mod_modelo',$modelo->mod_modelo,['class'=> 'form-control', 'placeholder'=>'Marca', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection