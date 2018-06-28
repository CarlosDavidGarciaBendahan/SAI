@extends('admin.template.main2')

@section('title', 'Listar Registros de pago')

@section('contenido-header-name', 'Registro de pago')

@section('contenido-header-name2', 'listado de los registros de pago')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registro de pago</li>
        <li class="active">Cargar archivo</li>
    </ol>
@endsection

@section('body')
	<div class="containter-fluid">
		<div class="row">
			<div class="col-sm-12">
				@if (count($errors) > 0)
					<div class="alert alert-danger" role="alert">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>	
				@endif
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				{!! Form::open(['route' => 'solicitud.importarExcel', 'method' => 'POST', 'files' => 'true' ]) !!}
					<div class="form-group col-sm-12"> 
						
							{!! Form::label('ima','Archivo') !!}

							<!-- File input field -->
							<input class="col-sm-12" type="file" name="imagen" id="file" onchange="return fileValidation()"/>
							<br>
							
								
							

					</div>
					<div class="form-group col-sm-12">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
						<a href="{{ route('solicitud.index') }}" class="btn btn-danger">Calcelar</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection

@section('scripts')

	<script src = "{{ asset('plugins/Script/ValidarExcel.js') }}"></script>

@endsection