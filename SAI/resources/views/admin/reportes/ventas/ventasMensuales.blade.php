@extends('admin.template.main2')

@section('title', 'Reporte Ventas')

@section('contenido-header-name', 'Reporte de ventas')

@section('contenido-header-name2', 'Estadisticas del mes')

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
					<a href=" {{ route('reporteventa.index') }} " class="btn btn-primary btn-block" title="Regresar para seleccionar otro mes">
						Regresar
					</a>
				</div>
			</div>
			
			<div class="col-sm-10">
				<div class="col-sm-6">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Cantidad de productos vendidos en el mes</h3>

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
			              <h3 class="box-title">Cantidad de ingreso en dolares ($) por producto en el mes</h3>

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


