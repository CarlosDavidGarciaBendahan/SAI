@extends('admin.template.main2')

@section('title', 'Editar tipo de producto '. $tipo_producto->tip_tipo)

@section('contenido-header-name', 'Edición de tipo de producto')

@section('contenido-header-name2', 'editar tipo de producto')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('tipo_producto.index') }}"> Tipo de producto</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['tipo_producto.update',$tipo_producto], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('tip_tipo','Tipo de producto') !!}

						{!! Form::text('tip_tipo',$tipo_producto->tip_tipo,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection