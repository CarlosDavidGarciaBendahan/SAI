@extends('admin.template.main')

@section('title', 'Mostrar la marca '. $marca->mar_marca)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'marca.store', 'method' => 'POST' ]) !!}
					<div class="form-group"> 
						
						{!! Form::label('id','ID') !!}

						{!! Form::text('id',$marca->id,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('mar_marca','Marca') !!}

						{!! Form::text('mar_marca',$marca->mar_marca,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
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
						
						{!! Form::label('modelos','Modelos') !!}

						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>ID</th>
						      <th>Modelo</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($marca->Modelos as $modelo)
						  		<tr>
							      <th scope="row">{{ $modelo->id }}</th>
							      <td>{{ $modelo->mod_modelo }}</td>	
							      <td>
							      	<a href="{{ route('modelo.edit', $modelo->id) }}" class="btn btn-warning">
							      		<span class="class glyphicon glyphicon-wrench"></span>
							      	</a>

							      	<a href="{{ route('modelo.destroy', $modelo->id) }}" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
							      		<span class="class glyphicon glyphicon-remove-circle"></span>
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