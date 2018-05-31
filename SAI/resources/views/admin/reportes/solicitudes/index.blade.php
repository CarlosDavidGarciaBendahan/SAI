@extends('admin.template.main2')

@section('title', 'Listar solicitudes')

@section('contenido-header-name', 'Listado de solicitudes')

@section('contenido-header-name2', 'lista de solicitudes')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Solicitud</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">
				
				<div class="row">
					<div class="col-sm-4">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Cantidad de solicitudes aprobadas por tipo</h3>

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
					<div class="col-sm-4">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Cantidad de solicitudes rechazadas por tipo</h3>

			              <div class="box-tools pull-right">
			                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			                </button>
			                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			              </div>
			            </div>
			            <div class="box-body chart-responsive">
			              <div class="chart" id="sales-chart2" style="height: 300px; position: relative;"></div>
			            </div>	
			            <!-- /.box-body -->
			          </div>
			          <!-- /.box -->
					</div> 
					<div class="col-sm-4">
						<!-- DONUT CHART -->
			          <div class="box box-danger">
			            <div class="box-header with-border">
			              <h3 class="box-title">Cantidad de solicitudes por cliente</h3>

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
				</div>



				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>id</th>
				      <th>Fecha</th>
				      <th>Tipo</th>
				      <th>Concepto</th>
				      <th>Observaciones</th>
				      <th>Nota Entrega</th>
				      <th>Aprobado</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($solicitudes as $solicitud)
				  			<tr>
					      <th scope="row">{{ $solicitud->id }}</th>
					      <td>{{  date("d/m/Y", strtotime($solicitud->sol_fecha))}}</td>		
					      <td>{{ $solicitud->sol_tipo}}</td>
					      <td>{{ $solicitud->sol_concepto}}</td>
					      <td>{{ $solicitud->sol_observaciones}}</td>
					      <td>{{ '#'.$solicitud->notaEntrega->id }}</td>
					      <td>
					      	@if ($solicitud->sol_aprobado === 'S')
					      		<a class="btn btn-success" title="Aprobado">
					      		<span class="class glyphicon glyphicon-ok"></span>
						    	</a>
						    @else
						    	<a class="btn btn-danger" title="Rechazado">
					      		<span class="class glyphicon glyphicon-remove"></span>
						    	</a>
					      	@endif
					      </td>
					     

					      <td>
					      	
					      	<a href="{{ route('solicitud.show', $solicitud->id) }}" class="btn btn-info" title="Ver solicitud">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>
				    	</tr>
				  		
				  	@endforeach

				  </tbody>

				</table>
				{{ $solicitudes->links() }}


				
			</div>

			
			
		</div>
			
	</section>


	
<!-- jQuery 3 -->
<script src="{{ asset('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('adminLTE/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/morris.js/morris.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{ { asset('adminLTE/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{ { asset('adminLTE/js/demo.js') }}"></script>
<script>
  $(function () {
    "use strict";

    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#00FFFF"],
      data: [
      
     
      {label: "Cambio", value:{{ $total_cambio }} },		
	  {label: "Devolución", value:{{ $total_devolucion }} },	
      //data: [
        //{label: "Download Sales", value: 12},
        //{label: "In-Store Sales", value: 30},
        //{label: "Mail-Order Sales", value: 20},
        //{label: "Carlos", value: 25}
      ],
      hideHover: 'auto'
    });
    
  });
</script>
<script>
  $(function () {
    "use strict";

    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart2',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#00FFFF"],
      data: [
      
     
      {label: "Cambio", value:{{ $total_cambio_rechazada }} },		
	  {label: "Devolución", value:{{ $total_devolucion_rechazada }} },	
      //data: [
        //{label: "Download Sales", value: 12},
        //{label: "In-Store Sales", value: 30},
        //{label: "Mail-Order Sales", value: 20},
        //{label: "Carlos", value: 25}
      ],
      hideHover: 'auto'
    });
    
  });
</script>
<script>
  $(function () {
    "use strict";
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart3',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a","#00FFFF"],
      data: [
      
      @foreach ($clientes_juridicos as $cliente_juridico)
      
      	
      	{label: "{{ $cliente_juridico->cli_jur_nombre }}", value: {{ $totalesJ[$cliente_juridico->id] }} },

      @endforeach	
      @foreach ($clientes_naturales as $cliente_natural)

      	{label: "{{ $cliente_natural->cli_nat_nombre." ".$cliente_natural->cli_nat_nombre2." ".
      				$cliente_natural->cli_nat_apellido." ".$cliente_natural->cli_nat_apellido2 }}", value: {{ $totalesN[$cliente_natural->id] }} },
      
      @endforeach	

      //data: [
        //{label: "Download Sales", value: 12},
        //{label: "In-Store Sales", value: 30},
        //{label: "Mail-Order Sales", value: 20},
        //{label: "Carlos", value: 25}
      ],
      hideHover: 'auto'
    });
    
  });
</script>
@endsection