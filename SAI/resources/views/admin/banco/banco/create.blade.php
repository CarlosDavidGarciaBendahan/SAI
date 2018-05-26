@extends('admin.template.main2')

@section('title', 'Crear banco')

@section('contenido-header-name', 'Banco')

@section('contenido-header-name2', 'registro de banco')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('banco.index') }}"> Banco</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'banco.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('ban_nombre','Banco') !!}

						{!! Form::text('ban_nombre',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del banco.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection