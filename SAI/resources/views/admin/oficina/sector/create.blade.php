@extends('admin.template.main2')

@section('title', 'Crear Sector')

@section('contenido-header-name', 'Registro de sector')

@section('contenido-header-name2', 'crear sector')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('sector.index') }}"> Sector</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
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
				{!! Form::open(['route' => 'sector.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						<label>Oficina </label>
						<select class="form-control input-sm" name="sec_fk_oficina" id="sec_fk_oficina" required="true">
							<option value=""> Seleccionar una oficina</option>
							@foreach ($oficinas as $oficina)
								<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('sec_sector','Sector') !!}
						{!! Form::text('sec_sector',null,['class'=> 'form-control','title'=>'Solo letras mayúsculas, minúsculas y números min: 3 max: 20', 'placeholder'=>'Nombre del sector.', 'required', 'minlength'=>'3', 'maxlength' => '20', 'pattern'=>'[A-za-z0-9 ]+']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('sector.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

