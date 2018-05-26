@extends('admin.template.main2')

@section('title', 'Crear Tipo producto')

@section('contenido-header-name', 'Registro de tipo de producto')

@section('contenido-header-name2', 'crear tipo de producto')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('tipo_producto.index') }}"> Tipo de producto</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'tipo_producto.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('tip_tipo','Tipo de producto') !!}

						{!! Form::text('tip_tipo',null,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection