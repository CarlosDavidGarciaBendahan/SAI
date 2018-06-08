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
				{!! Form::open(['route' => ['sector.update',$sector], 'method' => 'PUT' ]) !!}
					<div class="form-group">
						{!! Form::label('sec_fk_oficina','Oficina') !!}
						{!! Form::select('sec_fk_oficina',$oficinas, $sector->sec_fk_oficina, ['class'=>'form-control', 'placeholder'=>'Elegir una oficina', 'required'] ) !!}
					</div>
				

					<div class="form-group">
						{!! Form::label('sec_sector','Sector') !!}
						{!! Form::text('sec_sector',$sector->sec_sector,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas, minúsculas y números min: 3 max: 20', 'placeholder'=>'Nombre del sector.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('sector.index') }}" class="btn btn-danger">Calcelar</a>
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
