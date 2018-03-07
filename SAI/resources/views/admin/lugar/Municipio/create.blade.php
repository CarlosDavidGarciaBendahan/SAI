@extends('admin.template.main')

@section('title', 'Crear municipio')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'municipio.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('mun_fk_estado','Estado') !!}
						{!! Form::select('mun_fk_estado',$estados, null, ['class'=>'form-control', 'placeholder'=>'Elegir un estado', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre del municipio', 'required']) !!}
					</div>
					{{-- comment 
						<div class="form-group"> 
						
						{!! Form::label('ejemplo','ejemplo') !!}

						{!! Form::text('ejemplo',null,['class'=> 'form-control', 'placeholder'=>'ejemplo', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type','tipo') !!}
						{!! Form::select('type',[''=>'Seleccionar','member' => 'Miembro','admin'=>'Administrador'],null,['class'=> 'form-control']) !!}
					</div>
						--}}
					

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection