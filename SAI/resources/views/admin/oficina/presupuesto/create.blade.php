@extends('admin.template.main')

@section('title', 'Crear Presupuesto')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'presupuesto.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('empresa','Empresa') !!}

						<select class="form-control col-sm input-sm select-empresas" name="empresa" id="empresas">
								<option value="" > Seleccionar empresa</option>
								@foreach ($empresas as $empresa)
									<option value="{{ $empresa->id }}"> {{ $empresa->emp_nombre }}</option>
									{{ $empresa_id = $empresa->id }}
								@endforeach
						</select>


					</div>
					<div class="empresa form-group" id="empresa">
						<h1>h1</h1>
					</div>



					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelectorEmpresas.js') }}"></script>
	<script src = "{{ asset('plugins/Script/ObtenerDatosEmpresa.js') }}"></script>
@endsection
