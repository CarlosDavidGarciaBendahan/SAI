@extends('admin.template.main2')

@section('title', 'Información de Lote')

@section('contenido-header-name', 'Observación de lote')

@section('contenido-header-name2', 'oberservar lote')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('lote.index') }}"> Lote</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'lote.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('lot_nombre','Nombre del lote') !!}

						{!! Form::text('lot_nombre',$lote->lot_nombre,['class'=> 'form-control', 'placeholder'=>'nombre', 'required', 'readonly'=>'true']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('lot_fecha_recibido','Fecha recibido') !!}

						{!! Form::text('lot_fecha_recibido', $lote->lot_fecha_recibido, array('id' => 'datepicker', 'placeholder'=>'DD-MM-YYYY', 'class'=> 'form-control', 'readonly'=>'true')) !!}
					</div>


					

					<h1>AGREGAR TABLA CON LOS PRODUCTOS DE ESTE LOTE.</h1>

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

