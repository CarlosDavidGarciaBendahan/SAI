@extends('admin.template.main2')

@section('title', 'Crear fuente de venta')

@section('contenido-header-name', 'fuente de venta')

@section('contenido-header-name2', 'registro de fuente de venta')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('fuenteventa.index') }}"> Fuente de venta</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection



@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => ['fuenteventa.update',$fuenteventa], 'method' => 'PUT' ]) !!}

					<!-- NOMBRE DEL ESTADO-->
					<div class="form-group"> 
						
						{!! Form::label('nombre','Nombre') !!}

						{!! Form::text('nombre',$fuenteventa->nombre,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas y puntos, min: 4 max: 25', 'placeholder'=>'Nombre de la fuente de venta.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z. ]+']) !!}
					</div>
					
					<div class="form-group"> 
						
						{!! Form::label('descripcion','Descripcion') !!}

						{!! Form::text('descripcion',$fuenteventa->descripcion,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas y puntos, min: 4 max: 50', 'placeholder'=>'Descripcion de la fuente de venta.', 'required', 'minlength'=>'4', 'maxlength' => '50', 'pattern'=>'[A-za-z. ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('fuenteventa.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
