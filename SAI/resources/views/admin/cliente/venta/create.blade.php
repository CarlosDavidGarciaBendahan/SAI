@extends('admin.template.main2')

@section('title', 'Crear Venta')

@section('contenido-header-name', 'Registro de venta')

@section('contenido-header-name2', 'crear venta')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('venta.index') }}"> Venta</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'venta.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group col-sm-12"> 
						{!! Form::label('fecha','Fecha de venta') !!}
						{!! Form::text('ven_fecha_compra',$fecha,['class'=> 'form-control', 'placeholder'=>'d-m-Y', 'required', 'readonly'=>'true']) !!}		
					</div>

					
					<div class="form-group col-sm-12"> 
						{!! Form::label('tipo de cliente','Tipo de cliente: Persona') !!}
						{!! Form::checkbox('tipo_cliente', 'natural','true') !!}
					</div>
					
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('cliente','Cliente') !!}

						<select class="form-control col-sm input-sm select-empresas" name="ven_fk_cliente_natural" id="clientes_naturales" >
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

						<select class="form-control col-sm input-sm select-empresas" name="ven_fk_cliente_juridico" id="clientes_juridicos">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_juridicos as $cliente_juridico)
									<option value="{{ $cliente_juridico->id }}"> {{ $cliente_juridico->cli_jur_nombre }}</option>
								@endforeach
						</select>
					</div>

					<div class="cliente_juridico form-group col-sm-12" id="cliente_juridico">
						
					</div>

					
					<div class="form-group"> 
						
						{!! Form::label('codigoPC','Códigos de computadoras') !!}

						{!! Form::select('codigoPC[]',$codigosPC,null,['class'=> 'form-control select-permisos ', 'multiple','required' , 'id'=>'select-codigosPC']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('codigoArticulo','Códigos de artículos') !!}

						{!! Form::select('codigoArticulo[]',$codigosArticulo,null,['class'=> 'form-control select-permisos ', 'multiple','required', 'id'=>'select-codigosArticulo']) !!}
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
	<!--<script src = "{{ asset('plugins/Script/ObtenerDatosEmpresa.js') }}"></script>-->
	<script src = "{{ asset('plugins/Script/ObtenerDatosClienteNatural.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosClienteJuridico.js') }}"></script>
	<!--<script src = "{{ asset('plugins/Script/ObtenerDatosProductoComputador.js') }}"></script>-->
	<!--<script src = "{{ asset('plugins/Script/ObtenerDatosProductoArticulo.js') }}"></script>-->
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
	<!--<script src = "{{ asset('plugins/Script/FormDinamicoAgregarTablaCodigoPC.js') }}"></script>-->
@endsection
