@extends('admin.template.main2')

@section('title', 'Editar municipio '. $municipio->mun_nombre)

@section('contenido-header-name', 'Municipio')

@section('contenido-header-name2', 'edición de municipio')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('municipio.index') }}"> Municipio</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				{!! Form::open(['route' => ['municipio.update',$municipio], 'method' => 'PUT' ]) !!}
					
					<!-- SELECT ESTADO-->
					<div class="form-group">
						{!! Form::label('mun_fk_estado','Estado') !!}
						{!! Form::select('mun_fk_estado',$estados, $municipio->estado->id, ['class'=>'form-control', 'placeholder'=>'Elegir un estado', 'required'] ) !!}
					</div>

					<!-- NOMBRE MUNICIPIO -->
					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',$municipio->mun_nombre,['class'=> 'form-control','title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del municipio.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>
					
					<!-- TABLA PARROQUIAS -->
					<div class="form-group"> 
						
						{!! Form::label('parroquias','Parroquias') !!}

						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>ID</th>
						      <th>Nombre de la parroquia</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($municipio->parroquias as $parroquia)
						  		<tr>
							      <th scope="row">{{ $parroquia->id }}</th>
							      <td>{{ $parroquia->par_nombre }}</td>	
							      <td>
							      	<a href="#" class="btn btn-warning">
							      		<span class="class glyphicon glyphicon-wrench"></span>
							      	</a>

							      	<a href="#" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
							      		<span class="class glyphicon glyphicon-remove-circle"></span>
							      	</a> 

							      	<a href="#" class="btn btn-info">
							      		<span class="glyphicon glyphicon-search"></span>
							      	</a>
							      </td>
						    	</tr>
						  	@endforeach

						  </tbody>
						</table>
					</div>
					<!-- FIN TABLA PARROQUIAS -->

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('municipio.index') }}" class="btn btn-danger">Calcelar</a>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection