@extends('admin.template.main')

@section('title', 'Mostrar la oficina '. $oficina->ofi_direccion)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'estado.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('ofi_id','ID') !!}
						{!! Form::text('ofi_id',$oficina->id,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group">
						<label>Estados </label>
						<select class="form-control input-sm" name="estado" id="estado">
							<option value=""> Seleccionar un estado</option>
							@foreach ($estados as $estado)
								<option value="{{ $estado->id }}"> {{ $estado->est_nombre }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="municipio" id="municipio">
							<option value=""> Seleccionar un municipio</option>
						</select>
					</div>

					<div class="form-group">
						<label>Municipios</label>
						<select class="form-control input-sm" name="ofi_fk_parroquia" id="parroquia">
							<option value=""> Seleccionar una parroquia</option>
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('ofi_tipo','Tipo de oficina') !!}
						{!! Form::select('ofi_tipo',['local'=>'Local', 'almacen'=>'Almacen'], $oficina->ofi_tipo, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('ofi_direccion','Dirección') !!}

						{!! Form::text('ofi_direccion',$oficina->ofi_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('sectores','Sectores') !!}

						<table class="table table-inverse">
						  <thead>
						    <tr>
						      <th>ID</th>
						      <th>Sector</th>
						    </tr>
						  </thead>
						  <tbody>

						  	@foreach ($oficina->Sectores as $sector)
						  		<tr>
							      <th scope="row">{{ $sector->id }}</th>
							      <td>{{ $sector->sec_sector }}</td>	
							      <td>
							      	<a href="{{ route('sector.edit', $sector->id) }}" class="btn btn-warning">
							      		<span class="class glyphicon glyphicon-wrench"></span>
							      	</a>

							      	<a href="{{ route('sector.destroy', $sector->id) }}" onclick="return confirm('Eliminar el estado?')" class="btn btn-danger">
							      		<span class="class glyphicon glyphicon-remove-circle"></span>
							      	</a> 

							      	<a href="{{ route('sector.show', $sector->id) }}" class="btn btn-info">
							      		<span class="glyphicon glyphicon-search"></span>
							      	</a>
							      </td>
						    	</tr>
						  	@endforeach

						  </tbody>
						</table>
					</div>

					<div>
						<a href="{{ route('oficina.index') }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					      	</a>
					</div>

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
@endsection