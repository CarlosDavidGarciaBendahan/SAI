@extends('admin.template.main2')

@section('title', 'Editar unidad de medida '. $unidadmedida->uni_meidda)

@section('contenido-header-name', 'Edición de unidad de medida')

@section('contenido-header-name2', 'editar unidad de medida')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('unidadmedida.index') }}"> Unidad de medida</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['unidadmedida.update',$unidadmedida], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('uni_medida','Unidad de medida') !!}

						{!! Form::text('uni_medida',$unidadmedida->uni_medida,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas, min: 2 max: 10', 'placeholder'=>'unidad medida.', 'required', 'minlength'=>'2', 'maxlength' => '10', 'pattern'=>'[A-za-z]+']) !!}
					</div>

					
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection