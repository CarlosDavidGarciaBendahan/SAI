@extends('admin.template.main2')

@section('title', 'Editar marca '. $marca->mar_marca)

@section('contenido-header-name', 'Edición de marca')

@section('contenido-header-name2', 'editar marca')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('marca.index') }}"> Marca</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection


@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['marca.update',$marca], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('mar_marca','Marca') !!}

						{!! Form::text('mar_marca',$marca->mar_marca,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 2 max: 20', 'placeholder'=>'Marca.', 'required', 'minlength'=>'2', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('marca.index') }}" class="btn btn-danger">Calcelar</a>
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection