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

						{!! Form::text('mar_marca',null,['class'=> 'form-control', 'placeholder'=>'Marca', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection