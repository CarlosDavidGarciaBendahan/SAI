@extends('admin.template.main2')

@section('title', 'Crear marca')

@section('contenido-header-name', 'Registro de marca')

@section('contenido-header-name2', 'crear marca')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('marca.index') }}"> Marca</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'marca.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('mar_marca','Marca') !!}

						{!! Form::text('mar_marca',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 3 max: 20', 'placeholder'=>'Marca.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection