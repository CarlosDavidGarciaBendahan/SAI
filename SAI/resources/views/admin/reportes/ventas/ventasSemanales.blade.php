@extends('admin.template.main2')

@section('title', 'Reporte Ventas')

@section('contenido-header-name', 'Reporte de ventas')

@section('contenido-header-name2', 'Estadísticas de la semana')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reporte ventas</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					{!! Form::label('mun_fk_estado','Seleccionar año') !!}
					{!! Form::select('mun_fk_estado',$anos, $year, ['class'=>'form-control', 'placeholder'=>'Elegir un año', 'required', 'disabled'] ) !!}
				</div>
				<div class="form-group">
					{!! Form::label('mun_fk_estado','Seleccionar mes del año') !!}
					{!! Form::select('mun_fk_estado',$meses, $month, ['class'=>'form-control', 'placeholder'=>'Elegir un mes', 'required', 'disabled'] ) !!}
				</div>

				<div class="form-group">
					{!! Form::label('mun_fk_estado','Semana') !!}
					<!--{ !! Form::select('numeroSemana',$array_inicioSemana, 1, ['class'=>'form-control', 'placeholder'=>'Elegir semana de mes', 'required'] ) !!}-->
						<select class="form-control input-sm" name="numeroSemana" disabled="true">
							@for ($i = 1; $i <= count($array_inicioSemana); $i++)
								<option value="{{ $i }}"> {{  date("d/m/Y", strtotime($array_inicioSemana[$i]))." al ". date("d/m/Y", strtotime($array_finSemana[$i])) }}</option>
							@endfor
						</select>
				</div>
				<div class="form-group">
					<a href=" {{ route('reporteventa.index') }} " class="btn btn-primary btn-block" title="Regresar a las estadísticas mensuales">
						Regresar
					</a>
				</div>

			</div>
			
			<div class="col-sm-10">
				<div class="col-sm-6">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Cantidad de productos vendidos en la semana</h3>

			              <div class="box-tools pull-right">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			              </div>
			            </div>
			            <div class="box-body chart-responsive">
			              <div class="chart" id="sales-chart3" style="height: 300px; position: relative;"></div>
			            </div>	
			            <!-- /.box-body -->
			          </div>
			          <!-- /.box -->
					</div>
				<div class="col-sm-6">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Ingreso en dolares ($) por producto en la semana</h3>

			              <div class="box-tools pull-right">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			              </div>
			            </div>
			            <div class="box-body chart-responsive">
			              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
			            </div>	
			            <!-- /.box-body -->
			          </div>
			          <!-- /.box -->
					</div>
			</div>


		</div>
		<div class="row">
			<div class="col-sm-2">
				{!! Form::label('mun_fk_estado','Ingreso semanal en dolares') !!}
						{!! Form::text('ven_fecha_compra',$ingresoMensual." $",['class'=> 'form-control', 'placeholder'=>'d-m-Y', 'required', 'readonly'=>'true']) !!}	
			</div>
			<div class="col-sm-10">
					{!! Form::label('mun_fk_estado','Listado de ventas del mes') !!}
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código de la venta</th>
				      <th>Fecha efectuada</th>
				      <th>Monto total</th>
				      <th>Monto cancelado</th>
				      <th>Nota de entrega</th>
				      

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
					      	@if ($venta->NotaEntrega !== null)
					      		<a href="{{ route('notaEntrega.show', $venta->NotaEntrega->id) }}"  class="btn btn-primary" title="Ver nota de entrega" target="_blank">
					      		<span class="class glyphicon glyphicon-file"></span>
						      	</a> 
					      	</a>
						    @else
						    	<?php $monto_pagado2 = 0; ?> 
						    	@if ( count($venta->RegistroPagos) !== 0)
						      		@foreach ($venta->RegistroPagos as $pago)
						      			<?php $monto_pagado2 = $monto_pagado2 + $pago->reg_monto; ?>
						      		@endforeach
						      	@endif
							    @if ($monto_pagado2 >= $venta->ven_monto_total)
							    	<a href="{{ route('notaEntrega.create', $venta->id) }}"  class="btn btn-success" title="Crear Nota de entrega">
						      		<span class="class glyphicon glyphicon-paperclip"></span>
							      	</a> 
							    @endif
					      	@endif
					      	
					      </td>

					      <td>
					      	
					      	<a href="{{ route('venta.show', $venta->id) }}" class="btn btn-info">
					      		<span class="fa fa-eye"></span>
					      	</a> 
					      	 
					      </td>
				    	</tr>
				  		
				  		
				  	@endforeach

				  </tbody>

				</table>
			</div>

			

<!-- jQuery 3 -->
<script src="{{ asset('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('adminLTE/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/morris.js/morris.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script>
  $(function () {
    "use strict";
    //DONUT CHART

    var contarPCenVenta = 0;

    var donut = new Morris.Donut({
      element: 'sales-chart3',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#00FFFF"],
      data: [
      
      @foreach ($productoPCs as $PC)

      	{label: "{{ $PC->tipo_producto->tip_tipo.", ".$PC->pro_com_codigo.", ".$PC->modelo->marca->mar_marca." ".$PC->modelo->mod_modelo}}", value:  {{ $cantidadPC[$PC->pro_com_codigo] }}},
	      		
      @endforeach	
      @foreach ($productoArticulos as $articulo)

      	{label: "{{ $articulo->tipo_producto->tip_tipo.", ".$articulo->pro_art_codigo.", ".$articulo->modelo->marca->mar_marca." ".$articulo->modelo->mod_modelo}}", value:  {{ $cantidadArticulo[$articulo->pro_art_codigo] }}},
	      		
      @endforeach	
      ],
      hideHover: 'auto'
    });
    
  });
</script>
<script>
  $(function () {
    "use strict";
    //DONUT CHART

    var contarPCenVenta = 0;

    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#00FFFF"],
      data: [
      
      @foreach ($productoPCs as $PC)

      	{label: "{{ $PC->tipo_producto->tip_tipo.", ".$PC->pro_com_codigo.", ".$PC->modelo->marca->mar_marca." ".$PC->modelo->mod_modelo}}", value:  {{ $cantidadIngresoPC[$PC->pro_com_codigo] }}},
	      		
      @endforeach	
      @foreach ($productoArticulos as $articulo)

      	{label: "{{ $articulo->tipo_producto->tip_tipo.", ".$articulo->pro_art_codigo.", ".$articulo->modelo->marca->mar_marca." ".$articulo->modelo->mod_modelo}}", value:  {{ $cantidadIngresoArticulo[$articulo->pro_art_codigo] }}},
	      		
      @endforeach	
      ],
      hideHover: 'auto'
    });
    
  });
</script>
	</section>


@endsection


