@extends('admin.template.main')

@section('title', 'Mostrar el estado '. $estado->est_nombre)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
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

					

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection