@extends('admin.template.main2')

@section('title', 'Crear municipio')

@section('contenido-header-name', 'Municipio')

@section('contenido-header-name2', 'registro de municipio')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('municipio.index') }}"> Municipio</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'municipio.store', 'method' => 'POST' ]) !!}
					
					<!-- SELECT ESTADO-->
					<div class="form-group">
						{!! Form::label('mun_fk_estado','Estado') !!}
						{!! Form::select('mun_fk_estado',$estados, null, ['class'=>'form-control', 'placeholder'=>'Elegir un estado', 'required'] ) !!}
					</div>
					
					<!-- NOMBRE MUNICIPIO -->
					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del municipio.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>
					

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection