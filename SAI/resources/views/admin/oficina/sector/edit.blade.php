@extends('admin.template.main2')

@section('title', 'Editar sector '. $sector->sec_nombre)

@section('contenido-header-name', 'Edición de sector')

@section('contenido-header-name2', 'editar sector')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('sector.index') }}"> Sector</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['sector.update',$sector], 'method' => 'PUT' ]) !!}
					<div class="form-group">
						{!! Form::label('sec_fk_oficina','Oficina') !!}
						{!! Form::select('sec_fk_oficina',$oficinas, $sector->sec_fk_oficina, ['class'=>'form-control', 'placeholder'=>'Elegir una oficina', 'required'] ) !!}
					</div>
				

					<div class="form-group">
						{!! Form::label('sec_sector','Sector') !!}
						{!! Form::text('sec_sector',$sector->sec_sector,['class'=> 'form-control', 'placeholder'=>'Sector', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
