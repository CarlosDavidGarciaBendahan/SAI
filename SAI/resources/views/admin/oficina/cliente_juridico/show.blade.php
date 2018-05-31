@extends('admin.template.main2')

@section('title', 'Mostrar cliente juridico '. $cliente_juridico->cli_jur_identificador."-".$cliente_juridico->cli_jur_rif)

@section('contenido-header-name', 'Observación de empresa')

@section('contenido-header-name2', 'observar empresa')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_juridico.index') }}"> Empresa</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'cliente_juridico.store', 'method' => 'POST' ]) !!}

					<div class="row">
							<!--DIRECCION -->
							<div class="form-group col-sm-6">
								{!! Form::label('cli_jur_direccion','Direccion') !!}
								{!! Form::text('cli_jur_direccion',$cliente_juridico->cli_jur_direccion,['class'=> 'form-control', 'placeholder'=>'dirección', 'required', 'readonly'=>'true']) !!}
							</div>
							<!--PARROQUIA -->
							<div class="form-group col-sm-2">
								<label>Parroquia</label>
								<select class="form-control input-sm" name="cli_jur_fk_parroquia" id="parroquia" disabled="true">
									
									@foreach ($parroquias as $parroquia)
										@if ($parroquia->municipio->mun_nombre === $cliente_juridico->parroquia->municipio->mun_nombre)
											@if ( $parroquia->par_nombre=== $cliente_juridico->parroquia->par_nombre)
												<option value="{{ $parroquia->id }}" selected="true"> {{ $parroquia->par_nombre }}</option>
											@endif
										@endif
										
										
									@endforeach
								</select>
							</div>
							<!--MUNICIPIO -->
							<div class="form-group col-sm-2">
								<label>Municipio</label>
								<select class="form-control input-sm" name="municipio" id="municipio" disabled="true">
									
									
									@foreach ($municipios as $municipio)

									@if ($municipio->estado->est_nombre === $cliente_juridico->parroquia->municipio->estado->est_nombre)
										@if ( $municipio->mun_nombre=== $cliente_juridico->parroquia->municipio->mun_nombre)
											<option value="{{ $municipio->id }}" selected="true"> {{ $municipio->mun_nombre }}</option>
										@endif
									@endif
										
										
									@endforeach

								</select>
							</div>
							<!--ESTADO -->
							<div class="form-group col-sm-2">
								<label>Estado </label>
								<select class="form-control input-sm" name="estado" id="estado" disabled="true">
									
									@foreach ($estados as $estado)
										@if ($estado->est_nombre === $cliente_juridico->parroquia->municipio->estado->est_nombre)
											<option value="{{ $estado->id }}" selected="true"> {{ $estado->est_nombre }}</option>
										@endif
										
									@endforeach
								</select>
							</div>

					</div><!-- FIN ROW DIRECCION-->
					
					<div class="row"><!--  ROW DATOS IDENTIFICACION-->
						<div class="form-group col-sm-6">
							{!! Form::label('cli_jur_nombre','Nombre') !!}
							{!! Form::text('cli_jur_nombre',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre', 'required', 'readonly'=>'true']) !!}
						</div>

						<div class="form-group col-sm-2">
							{!! Form::label('cli_jur_identificador','Identificador') !!}
							{!! Form::select('cli_jur_identificador',['J'=>'J','G'=>'G','C'=>'C'], $cliente_juridico->cli_jur_identificador, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required', 'disabled'] ) !!}
						</div>

						<div class="form-group col-sm-4"> 
							
							{!! Form::label('cli_jur_rif','RIF') !!}

							{!! Form::text('cli_jur_rif',$cliente_juridico->cli_jur_rif,['class'=> 'form-control', 'placeholder'=>'dirección', 'required','readonly'=>'true']) !!}
						</div>
					</div><!-- FIN ROW DATOS IDENTIFICACION-->

					<div class="row"><!--  ROW DATOS CONTACTOS-->
						<div class="col-sm-12">
							{!! Form::label('cli_jur_rif','Contactos de correos y telefonos ') !!}
						</div>
						<div class="col-sm-6">
							<table class="table table-inverse">
							  <thead>
							    <tr>
							      <th>ID</th>
							      <th>Correo</th>
							    </tr>
							  </thead>
							  <tbody>

							  	@foreach ($cliente_juridico->Contacto_Correos as $contacto_correo)
							  		<tr>
								      <th scope="row">{{ $contacto_correo->id }}</th>
								      <td>{{ $contacto_correo->con_cor_correo }}</td>
								      
							    	</tr>
							  	@endforeach

							  </tbody>

							</table>
						</div>

						<div class="col-sm-6">
							<table class="table table-inverse">
							  <thead>
							    <tr>
							      <th>ID</th>
							      <th>tipo</th>
							      <th>Telefono</th>
							    </tr>
							  </thead>
							  <tbody>

							  	@foreach ($cliente_juridico->Contacto_Telefonos  as $contacto_telefono)
							  		<tr>
								      <th scope="row">{{ $contacto_telefono->id }}</th>
								      <td>{{ $contacto_telefono->con_tel_tipo }}</td>
								      <td>{{ $contacto_telefono->con_tel_codigo . "-" . $contacto_telefono->con_tel_numero }}</td>
								      
							    	</tr>
							  	@endforeach

							  </tbody>

							</table>
						</div>
					</div><!-- FIN ROW DATOS CONTACTOS-->
 	
					<div class="row"><!--  ROW DATOS EXTRAS-->
						<div class="col-sm-6"><!-- ULTIMA COMPRA-->
							<div class="row">
								{!! Form::label('cli_jur_rif','Ultima venta',['class'=> 'col-sm-12']) !!}	
							</div>
							<div class="row ">
								<div class="form-group col-sm-12">
									@if (count($ultimaCompra) !== 0)
										{!! Form::label('x','Número de venta',['class'=> '']) !!}
										{!! Form::text('x',"#".$ultimaCompra[0]->id,['class'=> 'form-control ', 'placeholder'=>' ', 'required','readonly'=>'true']) !!}

										{!! Form::label('x','Fecha realizada',['class'=> '']) !!}
										{!! Form::text('x',date("d/m/Y", strtotime($ultimaCompra[0]->ven_fecha_compra)),['class'=> 'form-control ', 'placeholder'=>' ', 'required','readonly'=>'true']) !!}

										{!! Form::label('x','Monto',['class'=> '']) !!}
										{!! Form::text('x',$ultimaCompra[0]->ven_monto_total." ".$ultimaCompra[0]->ven_moneda,['class'=> 'form-control ', 'placeholder'=>' ', 'required','readonly'=>'true']) !!}
									@else
										{!! Form::label('cli_jur_rif','No hay ninguna venta.',['class'=> '']) !!}
									@endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									@if ($frecuenciaVenta != 0 )
										{!! Form::label('cli_jur_rif','Frecuencia de compra del cliente',['class'=> 'col-sm-12']) !!}
										{!! Form::text('x',"Tiene una frecuencia de ".$frecuenciaVenta." días para realizar una compra",['class'=> 'form-control ', 'placeholder'=>' ', 'required','readonly'=>'true']) !!}
									@endif
									
								</div>
							</div>
							
						</div>

						<div class="col-sm-6 "><!-- VENTAS RELACIONADAS-->
							<table class="table table-inverse">
							  <thead>
							    <tr>
							      <th>Código de la venta</th>
							      <th>Fecha efectuada</th>
							      <th>Monto total</th>
							      <th>Monto cancelado</th>
							      
							    </tr>
							  </thead>
							  <tbody>

							  	@foreach ($ventas as $venta)
							  		
							  		<tr>
								      <th scope="row">{{ $venta->id }}</th>
								      <td>{{  date("d/m/Y", strtotime($venta->ven_fecha_compra))}}</td>	
								      <td>{{ $venta->ven_monto_total . " " . $venta->ven_moneda }}</td>
								      <td>
								      	@if ( count($venta->RegistroPagos) !== 0)
								      		
								      		<?php $monto_pagado = 0; ?> 
								      		@foreach ($venta->RegistroPagos as $pago)
								      			<?php $monto_pagado = $monto_pagado + $pago->reg_monto; ?>
								      		@endforeach
								      		{{ $monto_pagado." Bs" }}
								      		
								      	@endif
								      </td>


								      <td>
								      	<a href="{{ route('venta.show', $venta->id) }}" class="btn btn-default" title="Ver información de la venta">
								      		<span class="fa fa-eye"></span>
								      	</a>
								      </td>
							    	</tr>
							  		
							  		
							  	@endforeach

							  </tbody>

							</table>

							{{ $ventas->links() }}
						</div>
					</div><!-- FIN ROW DATOS EXTRAS-->

					
				

				

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src="{{ asset('plugins/Script/ObtenerMunicipiosPorEstado.js') }}"></script>
	<script src="{{ asset('plugins/Script/ObtenerParroquiasPorMunicipio.js') }}"></script>
@endsection