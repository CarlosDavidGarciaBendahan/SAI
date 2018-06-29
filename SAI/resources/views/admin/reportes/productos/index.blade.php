@extends('admin.template.main2')

@section('title', 'Reporte de productos')

@section('contenido-header-name', 'Listar de productos')

@section('contenido-header-name2', 'listado de productos detallados')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Lista</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		 <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cantidad de ventas y solicitudes por producto</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          
			
	</section>
	<section class="container">

		<div class="container col-sm-6">
			<div class="col-sm-10 offset-1">
				{!! Form::label('cli_nat_direccion','Lista de las computadoras') !!}
				<div>
					<table class="table table-inverse">
					  <thead>
					    <tr>
					      <th>Código</th>
					      <th>Marca/Modelo</th>
					      <th>Tipo</th>
					      <th>Componentes</th>
					      <th>Disponible</th>

					    </tr>
					  </thead>
					  <tbody>

					  	@foreach ($PCs as $codigoPC)
					  		<tr>
						      <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
						      <td>{{ "Marca: ".$codigoPC->producto_computador->modelo->marca->mar_marca ." Modelo: ".$codigoPC->producto_computador->modelo->mod_modelo }}</td>	
						      <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
						      
						      <td>
						      	@foreach ($codigoPC->CodigoArticulos as $componente)
						      		{{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
						      	@endforeach
						  	  </td>	
						  	  <td>
						  	  	@if (count($codigoPC->Solicitudes) === 0 && count($codigoPC->Ventas) === 0  )
						  	  		<a href="#" class="btn btn-success" title="Disponible">
						      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a>
						  	  	@else
						  	  		<a href="#" class="btn btn-danger" title="Vendido">
						      		<span class="class glyphicon glyphicon-ban-circle"></span>
						      		</a>
						  	  	@endif
						  	  </td>
						      <td>

						      	<a href="{{ route('codigoPC.show', $codigoPC->id) }}" class="btn btn-default" title="Ver detalles">
						      		<span class="fa fa-eye"></span>
						      	</a>
						      </td>
					    	</tr>
					  	@endforeach

					  </tbody>

					</table>
					{{ $PCs->links() }}
				</div>	
			</div>
		</div>

		<div class="container col-sm-6">
			<div class="col-sm-10 offset-1">
				
				{!! Form::label('cli_nat_direccion','Lista de los artículos') !!}
				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>Código</th>
				      <th>Marca/Modelo</th>
				      <th>Tipo</th>
				      <th>Disponible</th>
				      <th>PC</th>

				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($Articulos as $codigoArticulo)
				  		<tr>
					      <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
					      <td>{{ "Marca: ".$codigoArticulo->producto_articulo->modelo->marca->mar_marca ." Modelo: ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td>	
					      <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
					      
					      
					  	  <td>
					  	  	@if (count($codigoArticulo->Solicitudes) === 0 && count($codigoArticulo->Ventas) === 0  )
					  	  		<a href="#" class="btn btn-success" title="Disponible">
					      		<span class="class glyphicon glyphicon-ok"></span>
					      		</a>
					  	  	@else
					  	  		<a href="#" class="btn btn-danger" title="Vendido">
					      		<span class="class glyphicon glyphicon-ban-circle"></span>
					      		</a>
					  	  	@endif
					  	  </td>
					      


					        @if ($codigoArticulo->cod_art_fk_pc !== null)
						  	  	
						  	  	<td>
						  	  		<a  class="btn btn-danger" title="Asignado">
						      		{{$codigoArticulo->codigopc->cod_pc_codigo }}<span class="class glyphicon glyphicon-ban-circle"></span>
						      		</a>
						  	  	</td>
						  	  @else
						  	  	<td>
						  	  		<a  class="btn btn-success" title="No esta asignado a ninguna PC">
						      		<span class="class glyphicon glyphicon-ok"></span>
						      		</a>
						  	  	</td>
						  	@endif

						  	<td>
					      	<a href="{{ route('codigoArticulo.show', $codigoArticulo->id) }}" class="btn btn-default" title="Ver detalles">
					      		<span class="fa fa-eye"></span>
					      	</a>
					      </td>

				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $Articulos->links() }}
			
			</div>

		</div>

			

			
			
	</section>


	
<!-- jQuery 3 -->
<script src="{{ asset('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js chArticulos -->
<script src="{{ asset('adminLTE/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/morris.js/morris.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{ { asset('adminLTE/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{ { asset('adminLTE/js/demo.js') }}"></script>


<!-- ChartJS -->
<script src={{ asset('adminLTE/bower_components/chart.js/Chart.js') }}></script>










<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few chArticulos using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      //labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],


      labels  : [
      			@foreach ($pcs as $PC)
      				"{{ $PC->pro_com_codigo.'('.$PC->Tipo_Producto->tip_tipo.')' }}",
      			@endforeach	

      			@foreach ($arts as $art)
      				"{{ $art->pro_art_codigo.'('.$art->Tipo_Producto->tip_tipo.')'}}",
      			@endforeach

      ],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : //[65, 59, 80, 81, 56, 55, 40]
          [
      			@foreach ($pcs as $PC)
		          	<?php $suma=0; ?>
		      			@foreach ($PC->CodigoPCs as $cod)
		      				<?php $suma = $suma + count($cod->ventas); ?>
		      			@endforeach
		      		{{ $suma }},		
	      		@endforeach	

      			@foreach ($arts as $art)
		        <?php $suma=0; ?>
      				@foreach ($art->CodigoArticulos as $cod)
		      			<?php $suma = $suma + count($cod->ventas); ?>
      				@endforeach
		      	{{ $suma }}	,	
      			@endforeach
          ]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : //[28, 48, 40, 19, 86, 27, 90]
          [
      			@foreach ($pcs as $PC)
		          	<?php $suma=0; ?>
		      			@foreach ($PC->CodigoPCs as $cod)
		      				<?php $suma = $suma + count($cod->solicitudes); ?>
		      			@endforeach
		      		{{ $suma }},		
	      		@endforeach	

      			@foreach ($arts as $art)
		        <?php $suma=0; ?>
      				@foreach ($art->CodigoArticulos as $cod)
		      			<?php $suma = $suma + count($cod->solicitudes); ?>
      				@endforeach
		      	{{ $suma }}	,	
      			@endforeach
          ]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    
  })
</script>

@endsection