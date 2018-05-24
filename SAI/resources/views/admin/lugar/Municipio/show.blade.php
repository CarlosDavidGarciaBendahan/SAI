@extends('admin.template.main2')

@section('title', 'Mostrar el estado '. $municipio->mun_nombre)

@section('contenido-header-name', 'Municipio')

@section('contenido-header-name2', 'observación de municipio')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('municipio.index') }}"> Municipio</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'municipio.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('id','ID') !!}

						{!! Form::text('id',$municipio->id,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('estado','Estado') !!}

						{!! Form::text('estado',$municipio->estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('mun_nombre','Nombre') !!}

						{!! Form::text('mun_nombre',$municipio->mun_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
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
						
					

					<div class="form-group">
						{!! Form::submit('Regresar',['class'=>'btn btn-primary']) !!}
					</div>--}}

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
							      
						    	</tr>
						  	@endforeach

						  </tbody>
						</table>
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection