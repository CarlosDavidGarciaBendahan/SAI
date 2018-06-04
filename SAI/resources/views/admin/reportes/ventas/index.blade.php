@extends('admin.template.main2')

@section('title', 'Reporte Ventas')

@section('contenido-header-name', 'Reporte de ventas')

@section('contenido-header-name2', ' Seleccionar mes')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reporte ventas</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">
	{!! Form::open(['route' => 'reporteventa.ventasMensuales', 'method' => 'POST']) !!}	
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					{!! Form::label('mun_fk_estado','Seleccionar año') !!}
					{!! Form::select('year',$anos, \Carbon\Carbon::now()->year, ['class'=>'form-control', 'placeholder'=>'Elegir un año', 'required'] ) !!}
				</div>
				<div class="form-group">
					{!! Form::label('mun_fk_estado','Seleccionar mes del año') !!}
					{!! Form::select('month',$meses, \Carbon\Carbon::now()->month, ['class'=>'form-control', 'placeholder'=>'Elegir un mes', 'required'] ) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Calcular',['class'=>'btn btn-primary btn-block', 'title'=>'Calcular estadisticas de las ventas de un mes']) !!}
				</div>
			</div>
			
		</div>
			

	{!! Form::close() !!}
	</section>


@endsection


