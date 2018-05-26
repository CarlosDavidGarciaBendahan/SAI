@extends('admin.template.main2')

@section('title', 'Editar banco '. $banco->ban_nombre)

@section('contenido-header-name', 'Banco')

@section('contenido-header-name2', 'edición de banco')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('banco.index') }}"> Banco</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['banco.update',$banco], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('ban_nombre','Nombre del banco') !!}

						{!! Form::text('ban_nombre',$banco->ban_nombre,['class'=> 'form-control','title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del banco.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection