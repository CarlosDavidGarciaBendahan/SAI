@extends('admin.template.main')

@section('title', 'Editar municipio '. $municipio->mun_nombre)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['municipio.update',$municipio], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						{!! Form::label('mun_fk_estado','Estado') !!}
						{!! Form::select('mun_fk_estado',$estados, $municipio->estado->id, ['class'=>'form-control', 'placeholder'=>'Elegir un estado', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',$municipio->mun_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del municipio', 'required']) !!}
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
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection