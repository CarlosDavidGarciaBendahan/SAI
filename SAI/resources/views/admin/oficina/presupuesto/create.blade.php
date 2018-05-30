@extends('admin.template.main2')

@section('title', 'Crear Presupuesto')

@section('contenido-header-name', 'Registro de persupuesto')

@section('contenido-header-name2', 'crear  persupuesto')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('presupuesto.index') }}"> Presupuesto</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
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
					<!--
					<div class="empresa form-group col-sm-12" id="empresa">
						
					</div>
				-->
					
					<div class="form-group col-sm-12"> 
						{!! Form::label('tipo de cliente','Tipo de cliente: Persona') !!}
						{!! Form::checkbox('tipo_cliente', 'natural','true') !!}
					</div>
					
					<div class="form-group col-sm-12"> 
						
						{!! Form::label('cliente','Persona') !!}

						<select class="form-control col-sm input-sm select-empresas" name="pre_fk_cliente_natural" id="clientes_naturales" >
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_naturales as $cliente_natural)
									<option value="{{ $cliente_natural->id }}"> {{ $cliente_natural->cli_nat_nombre." ".$cliente_natural->cli_nat_nombre2." ".$cliente_natural->cli_nat_apellido." ".$cliente_natural->cli_nat_apellido2." ".$cliente_natural->cli_nat_identificador."-".$cliente_natural->cli_nat_cedula }}</option>
								@endforeach
						</select>
					</div>

					<!--<div class="cliente_natural form-group col-sm-12" id="cliente_natural">
						
					</div>-->

					<div class="form-group col-sm-12"> 
						
						{!! Form::label('cliente','Empresa ') !!}

						<select class="form-control col-sm input-sm select-empresas" name="pre_fk_cliente_juridico" id="clientes_juridicos">
								<option value="" > Seleccionar empresa</option>
								@foreach ($clientes_juridicos as $cliente_juridico)
									<option value="{{ $cliente_juridico->id }}"> {{ $cliente_juridico->cli_jur_nombre." ".$cliente_juridico->cli_jur_identificador."-".$cliente_juridico->cli_jur_rif }}</option>
								@endforeach
						</select>
					</div>

					<!-- 
					<div class="cliente_juridico form-group col-sm-12" id="cliente_juridico">
						
					</div>


					<div class="form-group col-sm-12"> 
						
						{ !! Form::label('productos','Computadoras') !!}

						{ !! Form::select('productos_computadores',$productos_computadores,null,['class'=> 'form-control select-multiple', 'placeholder'=>'seleccionar productos', 'required', 'id'=>'select-computadoras']) !!}
					</div>
					<div class="form-group col-sm-12"> 
						
						{ !! Form::label('productos','Articulos') !!}

						{ !! Form::select('productos_articulos',$productos_articulos,null,['class'=> 'form-control select-multiple', 'placeholder'=>'seleccionar productos', 'required', 'id'=>'select-articulos']) !!}
					</div>

					<div class="presupuesto form-group col-sm-12" id="presupuesto">
						<label class = "col-sm-1">ID</label>
						<label class = "col-sm-3">Descripción</label>
						<label class = "col-sm-2">Código</label>
						<!--<label class = "col-sm-2">Descripción</label>-
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
							{ !! Form::label('productos','SubTotal',['class'=>' col-sm-4']) !!}
							{ !! Form::text('pre_subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'0.0', 'required']) !!}
							{ !! Form::text('moneda-subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'Bs', 'required']) !!}
						</div>
					</div>
					<div class="form-group col-sm-12">
						<div class="col-sm-4 offset-8">
							{ !! Form::label('productos','Total',['class'=>' col-sm-4']) !!}
							{ !! Form::text('pre_total',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'0.0', 'required']) !!}
							{ !! Form::text('moneda-subtotal',null,['class'=> 'form-control col-sm-4', 'placeholder'=>'Bs', 'required']) !!}
						</div>
					</div>
				-->

<!-- TABLAS DE PRODUCTOS PARA PODER INGRESAR EN EL PRESUPUESTO.  TANTO DE PC COMO DE ARTICULOS-->
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Descripción</th>
				      <th>Precio</th>
				      <th>Marca</th>
				      <th>Tipo</th>
				      <th>Stock</th>
				      <th>cantidad</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($productos_computadores as $producto_computador)
				  		<tr>
					      <th scope="row">{{ $producto_computador->pro_com_codigo }}</th>
					      <td>{{ $producto_computador->pro_com_descripcion }}</td>	
					      <td>{{ $producto_computador->pro_com_precio . $producto_computador->pro_com_moneda }}</td>
					      	
					      <td>{{ $producto_computador->modelo->marca->mar_marca . " Modelo: " .$producto_computador->modelo->mod_modelo   }}</td>	
					      <td>{{ $producto_computador->tipo_producto->tip_tipo}}</td>
					      <td>{{ $producto_computador->pro_com_cantidad }}</td>		
					      <td>
					      	<div class="container col-sm-12">
					      		{!! Form::text('computador_id[]',$producto_computador->id,['class'=> 'form-control  hidden', 'readonly'=>'true']) !!}

						      	{!! Form::text('cantidad_computador[]'.$producto_computador->id,'0',['class'=> 'form-control col-sm-8', 'title'=>'Solo números de 0-9, min: 1 max: 4', 'placeholder'=>'1.', 'required', 'minlength'=>'1', 'maxlength' => '4', 'pattern'=>'[0-9]+']) !!}

						      	{!! Form::label('tipo de cliente','Agregar') !!}

						      	{!! Form::label('tipo de cliente','SI') !!}

						      	{!! Form::checkbox('agregarPC[]', 'true',null) !!}

						      	{!! Form::label('tipo de cliente','NO') !!}

						      	{!! Form::checkbox('agregarPC[]', 'false','true') !!}
					      	</div>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $productos_computadores->links() }}
			</div>





			<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Descripción</th>
				      <th>Precio</th>
				      <th>Marca</th>
				      <th>Tipo</th>
				      <th>Stock</th>
				      <th>cantidad</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($productos_articulos as $producto_articulo)
				  		<tr>
					      <th scope="row">{{ $producto_articulo->pro_art_codigo }}</th>
					      <td>{{ $producto_articulo->pro_art_descripcion }}</td>	
					      <td>{{ $producto_articulo->pro_art_precio . $producto_articulo->pro_art_moneda }}</td>
					      
					      <td>{{ $producto_articulo->modelo->marca->mar_marca . " Modelo: " .$producto_articulo->modelo->mod_modelo   }}</td>	
					      <td>{{ $producto_articulo->tipo_producto->tip_tipo}}</td>	
					      <td>{{ $producto_articulo->pro_art_cantidad }}</td>	
					      <td>
					      	<div class="container col-sm-12">
					      		{!! Form::text('articulo_id[]',$producto_computador->id,['class'=> 'form-control  hidden', 'readonly'=>'true']) !!}

						      	{!! Form::text('cantidad_articulo[]'.$producto_computador->id,'0',['class'=> 'form-control col-sm-8', 'title'=>'Solo números de 0-9, min: 1 max: 4', 'placeholder'=>'1.', 'required', 'minlength'=>'1', 'maxlength' => '4', 'pattern'=>'[0-9]+']) !!}

						      	{!! Form::label('tipo de cliente','Agregar') !!}

						      	{!! Form::label('tipo de cliente','SI') !!}

						      	{!! Form::checkbox('agregarArticulo[]', 'true',null) !!}

						      	{!! Form::label('tipo de cliente','NO') !!}

						      	{!! Form::checkbox('agregarArticulo[]', 'false','true') !!}
					      	</div>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $productos_articulos->links() }}
<!-- FIN FIN FIN FIN   TABLAS DE PRODUCTOS PARA PODER INGRESAR EN EL PRESUPUESTO.  TANTO DE PC COMO DE ARTICULOS-->
					<div class="form-group col-sm-12">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<!-- <script src = "{{ asset('plugins/Script/ChosenMultipleSelectorEmpresas.js') }}"></script> -->
	<!-- <script src = "{{ asset('plugins/Script/ObtenerDatosEmpresa.js') }}"></script> -->
	<!-- <script src = "{{ asset('plugins/Script/ObtenerDatosClienteNatural.js') }}"></script> -->
	<!-- <script src = "{{ asset('plugins/Script/ObtenerDatosClienteJuridico.js') }}"></script> -->
	<!-- <script src = "{{ asset('plugins/Script/ObtenerDatosProductoComputador.js') }}"></script> -->
	<!-- <script src = "{{ asset('plugins/Script/ObtenerDatosProductoArticulo.js') }}"></script> -->
@endsection
