@extends('admin.template.main')

@section('title', 'Crear estado')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'estado.store', 'method' => 'POST' ]) !!}
					<div class="form-group"> 
						
						{!! Form::label('est_nombre','Nombre') !!}

						{!! Form::text('est_nombre',null,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
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