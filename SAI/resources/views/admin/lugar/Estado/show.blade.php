@extends('admin.template.main2')

@section('title', 'Mostrar el estado '. $estado->est_nombre)

@section('contenido-header-name', 'Estado')

@section('contenido-header-name2', 'observación de estado')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('estado.index') }}"> Estado</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm">
				{!! Form::open(['route' => 'estado.store', 'method' => 'POST' ]) !!}
					<div class="form-group"> 
						
						{!! Form::label('id','ID') !!}

						{!! Form::text('id',$estado->id,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('est_nombre','Nombre') !!}

						{!! Form::text('est_nombre',$estado->est_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
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