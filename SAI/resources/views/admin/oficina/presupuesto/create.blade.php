@extends('admin.template.main')

@section('title', 'Crear Presupuesto')

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'presupuesto.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group col-sm-12"> 
						{!! Form::label('fecha','Fecha de solicitud') !!}
						{!! Form::text('pre_fecha_solicitud',$fecha,['class'=> 'form-control', 'placeholder'=>'d-m-Y', 'required', 'readonly'=>'true']) !!}		
					</div>

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('empresa','Empresa') !!}

						<select class="form-control col-sm input-sm select-empresas" name="pre_fk_empresa" id="empresas" required="true">
								<option value="" > Seleccionar empresa</option>
								@foreach ($empresas as $empresa)
									<option value="{{ $empresa->id }}"> {{ $empresa->emp_nombre }}</option>							
								@endforeach
						</select>
					</div>

					<div class="empresa form-group col-sm-12" id="empresa">
						
					</div>
					
					<div class="form-group col-sm-12"> 
						{!! Form::label('tipo de cliente','Tipo de cliente: Persona') !!}
						{!! Form::checkbox('tipo_cliente', 'natural','true') !!}
					</div>
					
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('cliente','Cliente') !!}

						<select class="form-control col-sm input-sm select-empresas" name="pre_fk_cliente_natural" id="clientes_naturales" required="true">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_naturales as $cliente_natural)
									<option value="{{ $cliente_natural->id }}"> {{ $cliente_natural->cli_nat_nombre." ".$cliente_natural->cli_nat_nombre2." ".$cliente_natural->cli_nat_apellido." ".$cliente_natural->cli_nat_apellido2 }}</option>
								@endforeach
						</select>
					</div>

					<div class="cliente_natural form-group col-sm-12" id="cliente_natural">
						
					</div>

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('cliente','Cliente ') !!}

						<select class="form-control col-sm input-sm select-empresas" name="pre_fk_cliente_juridico" id="clientes_juridicos">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_juridicos as $cliente_juridico)
									<option value="{{ $cliente_juridico->id }}"> {{ $cliente_juridico->cli_jur_nombre }}</option>
								@endforeach
						</select>
					</div>

					<div class="cliente_juridico form-group col-sm-12" id="cliente_juridico">
						
					</div>


					<div class="form-group col-sm-12"> 
						
						{!! Form::label('productos','Computadoras') !!}

						{!! Form::select('productos_computadores',$productos_computadores,null,['class'=> 'form-control select-multiple', 'placeholder'=>'seleccionar productos', 'required', 'id'=>'select-computadoras']) !!}
					</div>
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('productos','Articulos') !!}

						{!! Form::select('productos_articulos',$productos_articulos,null,['class'=> 'form-control select-multiple', 'placeholder'=>'seleccionar productos', 'required', 'id'=>'select-articulos']) !!}
					</div>

					<div class="presupuesto form-group col-sm-12" id="presupuesto">
						<label class = "col-sm-1">ID</label>
						<label class = "col-sm-3">Descripción</label>
						<label class = "col-sm-2">Código</label>
						<!--<label class = "col-sm-2">Descripción</label>-->
						<label class = "col-sm-2">precio unitario</label>
						<label class = "col-sm-1">cantidad</label>
						<label class = "col-sm-2">total</label>
						<div class="presupuesto-computador form-group col-sm-12" id="presupuesto-computador">

						</div>
						<div class="presupuesto-articulo form-group col-sm-12" id="presupuesto-articulo">
						
						</div>
					</div>

					<div class="form-group col-sm-12">
						<div class="col-sm-4 offset-8">
							{!! Form::label('productos','SubTotal',['class'=>' col-sm-4']) !!}
							{!! Form::text('pre_subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'0.0', 'required']) !!}
							{!! Form::text('moneda-subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'Bs', 'required']) !!}
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-4 offset-8">
							{!! Form::label('productos','Total',['class'=>' col-sm-4']) !!}
							{!! Form::text('pre_total',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'0.0', 'required']) !!}
							{!! Form::text('moneda-subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'Bs', 'required']) !!}
						</div>
					</div>


					<div class="form-group col-sm-12">
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
	<script src = "{{ asset('plugins/Script/ObtenerDatosProductoComputador.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosProductoArticulo.js') }}"></script>
@endsection
