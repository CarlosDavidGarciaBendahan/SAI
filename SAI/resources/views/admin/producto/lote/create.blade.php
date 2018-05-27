@extends('admin.template.main2')

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('title', 'Crear Lote')

@section('contenido-header-name', 'Registro de lote')

@section('contenido-header-name2', 'crear lote')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('lote.index') }}"> Lote</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'lote.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('lot_nombre','Nombre del lote') !!}

						{!! Form::text('lot_nombre',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 10 max: 50', 'placeholder'=>'Lote.', 'required', 'minlength'=>'10', 'maxlength' => '50', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('lot_fecha_recibido','Fecha recibido') !!}

						{!! Form::text('lot_fecha_recibido', '', array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control', 'required'=>'true')) !!}
					</div>


					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

@section('scripts')
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  	<script src="{{ asset('plugins/Script/datepicker2.js') }}"></script>
@endsection