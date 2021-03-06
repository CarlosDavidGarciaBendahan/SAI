@extends('admin.template.main2')

@section('title', 'Crear estado')

@section('contenido-header-name', 'Estado')

@section('contenido-header-name2', 'registro de estado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('estado.index') }}"> Estado</a></li>
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
				{!! Form::open(['route' => 'estado.store', 'method' => 'POST' ]) !!}

					<!-- NOMBRE DEL ESTADO-->
					<div class="form-group"> 
						
						{!! Form::label('est_nombre','Nombre') !!}

						{!! Form::text('est_nombre',null,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del estado.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>
					

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('estado.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
