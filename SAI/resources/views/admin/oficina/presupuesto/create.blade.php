@extends('admin.template.main')

@section('title', 'Crear Presupuesto')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'presupuesto.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('empresa','Empresa') !!}

						<select class="form-control col-sm input-sm select-empresas" name="empresa" id="empresas">
								<option value="" > Seleccionar empresa</option>
								@foreach ($empresas as $empresa)
									<option value="{{ $empresa->id }}"> {{ $empresa->emp_nombre }}</option>							
								@endforeach
						</select>
					</div>

					<div class="empresa form-group" id="empresa">
						<h1>h1</h1>
					</div>

					<div class="form-group"> 
						{!! Form::label('tipo de cliente','Cliente juridico?') !!}
						{!! Form::checkbox('tipo_cliente', 'juridico') !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('cliente','Cliente') !!}

						<select class="form-control col-sm input-sm select-empresas" name="empresa" id="clientes_naturales">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_naturales as $cliente_natural)
									<option value="{{ $cliente_natural->id }}"> {{ $cliente_natural->cli_nat_nombre." ".$cliente_natural->cli_nat_nombre2." ".$cliente_natural->cli_nat_apellido." ".$cliente_natural->cli_nat_apellido2 }}</option>
								@endforeach
						</select>
					</div>

					<div class="cliente_natural form-group" id="cliente_natural">
						<h1>h1</h1>
					</div>

					<div class="form-group"> 
						
						{!! Form::label('cliente','Cliente ') !!}

						<select class="form-control col-sm input-sm select-empresas" name="empresa" id="clientes_juridicos">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_juridicos as $cliente_juridico)
									<option value="{{ $cliente_juridico->id }}"> {{ $cliente_juridico->cli_jur_nombre }}</option>
								@endforeach
						</select>
					</div>

					<div class="cliente_juridico form-group" id="cliente_juridico">
						<h1>h1</h1>
					</div>


					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelectorEmpresas.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosEmpresa.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosClienteNatural.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosClienteJuridico.js') }}"></script>
@endsection
