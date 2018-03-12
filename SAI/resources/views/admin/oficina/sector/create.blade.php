@extends('admin.template.main')

@section('title', 'Crear Sector')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'sector.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						<label>Oficina </label>
						<select class="form-control input-sm" name="sec_fk_oficina" id="sec_fk_oficina">
							<option value=""> Seleccionar una oficina</option>
							@foreach ($oficinas as $oficina)
								<option value="{{ $oficina->id }}"> {{ $oficina->ofi_direccion }}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{!! Form::label('sec_sector','Sector') !!}
						{!! Form::text('sec_sector',null,['class'=> 'form-control', 'placeholder'=>'Sector', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>

					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection

