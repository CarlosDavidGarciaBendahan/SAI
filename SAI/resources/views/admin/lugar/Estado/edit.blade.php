@extends('admin.template.main2')

@section('title', 'Editar estado '. $estado->est_nombre)

@section('contenido-header-name', 'Estado')

@section('contenido-header-name2', 'edición de estado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('estado.index') }}"> Estado</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm">
				{!! Form::open(['route' => ['estado.update',$estado], 'method' => 'PUT' ]) !!}

					<!-- NOMBRE DEL ESTADO-->
					<div class="form-group"> 
						
						{!! Form::label('est_nombre','Nombre') !!}

						{!! Form::text('est_nombre',$estado->est_nombre,['class'=> 'form-control', 'title'=>'Solo letras mayúsculas o minúsculas, min: 4 max: 25', 'placeholder'=>'Nombre del estado.', 'required', 'minlength'=>'4', 'maxlength' => '25', 'pattern'=>'[A-za-z ]+']) !!}
					</div>
					
					<div class="form-group"> 
						
						{!! Form::label('municipios','Municipios') !!}

						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>ID</th>
						      <th>Nombre del municipio</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($estado->Municipios as $municipio)
						  		<tr>
							      <th scope="row">{{ $municipio->id }}</th>
							      <td>{{ $municipio->mun_nombre }}</td>	
							      <td>
							      	<a href="{{ route('municipio.edit', $municipio->id) }}" class="btn btn-warning">
							      		<span class="class glyphicon glyphicon-wrench"></span>
							      	</a>

							      	<a href="{{ route('municipio.destroy', $municipio->id) }}" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
							      		<span class="class glyphicon glyphicon-remove-circle"></span>
							      	</a> 

							      	<a href="{{ route('municipio.show', $municipio->id) }}" class="btn btn-info">
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