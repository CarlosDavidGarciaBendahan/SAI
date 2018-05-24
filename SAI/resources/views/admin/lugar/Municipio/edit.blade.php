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
				{!! Form::open(['route' => ['municipio.update',$municipio], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						{!! Form::label('mun_fk_estado','Estado') !!}
						{!! Form::select('mun_fk_estado',$estados, $municipio->estado->id, ['class'=>'form-control', 'placeholder'=>'Elegir un estado', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',$municipio->mun_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del municipio', 'required']) !!}
					</div>
					{{-- comment 
						<div class="form-group"> 
						
						{!! Form::label('ejemplo','ejemplo') !!}

						{!! Form::text('ejemplo',null,['class'=> 'form-control', 'placeholder'=>'ejemplo', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('type','tipo') !!}
						{!! Form::select('type',[''=>'Seleccionar','member' => 'Miembro','admin'=>'Administrador'],null,['class'=> 'form-control']) !!}
					</div>
						--}}
					
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
					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection