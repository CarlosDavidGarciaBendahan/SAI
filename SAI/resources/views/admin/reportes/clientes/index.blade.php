@extends('admin.template.main2')

@section('title', 'Reporte Clientes')

@section('contenido-header-name', 'Reporte de clientes')

@section('contenido-header-name2', 'listar clientes')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reporte clientes</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
				<!-- DONUT CHART -->
	          <div class="box box-danger">
	            <div class="box-header with-border">
	              <h3 class="box-title">Cantidad de ventas por cliente</h3>

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
		<div class="row">
			<div class="col-sm-12">

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Identificador</th>
				      <th>Nombre</th>
				      <th>Dirección</th>
				      <th>Tipo de cliente</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<!-- CONTENIDO DE CLIENTES NATURALES-->
				  	@foreach ($clientes_naturales as $cliente_natural)
				  		<tr>
					      <th scope="row">{{ $cliente_natural->cli_nat_identificador ."-".$cliente_natural->cli_nat_cedula }}</th>
					      <td>
					      	{{ $cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_nombre2." ". $cliente_natural->cli_nat_apellido ." ".$cliente_natural->cli_nat_apellido2 }}
					      </td>	
					      <td>
					      	{{ $cliente_natural->cli_nat_direccion .", ". $cliente_natural->parroquia->par_nombre.", Mun.".$cliente_natural->parroquia->municipio->mun_nombre.", Edo. ".$cliente_natural->parroquia->municipio->estado->est_nombre }}
					      </td>
					      <td>Persona</td>
					      <td>

					      	<a href="{{ route('cliente_natural.show', $cliente_natural->id) }}" class="btn btn-default">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach
				  	<!-- CONTENIDO DE CLIENTES JURIDICOS-->
				  		@foreach ($clientes_juridicos as $cliente_juridico)
				  		<tr>
					      <th scope="row">{{ $cliente_juridico->cli_jur_identificador ."-".$cliente_juridico->cli_jur_rif }}</th>
					      <td>{{ $cliente_juridico->cli_jur_nombre }}</td>	
					      <td>{{ $cliente_juridico->cli_jur_direccion .", ". $cliente_juridico->parroquia->par_nombre.", Mun.".$cliente_juridico->parroquia->municipio->mun_nombre.", Edo. ".$cliente_juridico->parroquia->municipio->estado->est_nombre }}</td>
					      <td>Empresa</td>
					      <td>

					      	<a href="{{ route('cliente_juridico.show', $cliente_juridico->id) }}" class="btn btn-default">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $clientes_naturales->links() }}
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
      
      	@foreach ($clientes_juridicos as $cliente_juridico)
      		{label: "{{ $cliente_juridico->cli_jur_nombre }}", value:{{ count($cliente_juridico->Ventas) }} },
		
		@endforeach

		@foreach ($clientes_naturales as $cliente_natural)
      		{label: "{{ $cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_nombre2." ". $cliente_natural->cli_nat_apellido ." ".$cliente_natural->cli_nat_apellido2 }}", value:{{ count($cliente_natural->Ventas) }} },
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


