@extends('admin.template.main2')

@section('link-head')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('title', 'Editar lote '. $lote->lot_nombre)

@section('contenido-header-name', 'Edición de lote')

@section('contenido-header-name2', 'editar lote')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('lote.index') }}"> Lote</a></li>
        <li class="active">Editar</li>
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
				{!! Form::open(['route' => ['lote.update',$lote], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('lot_nombre','Nombre del lote') !!}

						{!! Form::text('lot_nombre',$lote->lot_nombre,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números de 0-9, min: 10 max: 50', 'placeholder'=>'Lote.', 'required', 'minlength'=>'10', 'maxlength' => '50', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('lot_fecha_recibido','Fecha recibido') !!}

						{!! Form::text('lot_fecha_recibido', $lote->lot_fecha_recibido, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control', 'required'=>'true')) !!}
					</div>


					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('lote.index') }}" class="btn btn-danger">Calcelar</a>
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