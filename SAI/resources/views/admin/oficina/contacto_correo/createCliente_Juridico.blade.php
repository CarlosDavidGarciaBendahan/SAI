@extends('admin.template.main')

@section('title', 'Crear correo ')

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'contacto_correo.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('ID','ID cliente juridico') !!}
						{!! Form::text('con_cor_fk_cliente_juridico',$cliente_juridico->id,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
					
						{!! Form::label('nombre cliente_juridico','Empresa cliente') !!}
						{!! Form::text('cliente_juridico',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
						
					</div>

					<div class="form-group">
						{!! Form::label('con_cor_correo','Código') !!}
						{!! Form::email('con_cor_correo',null,['class'=> 'form-control', 'placeholder'=>'ejemplo@gmail.com', 'required']) !!}
					</div>

					<!--
					<div class="form-group">
						{!! Form::label('con_cor_numero','Número') !!}
						{!! Form::text('con_cor_numero',null,['class'=> 'form-control', 'placeholder'=>'1234567', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('con_cor_tipo','Tipo') !!}
						{!! Form::select('con_cor_tipo',['movil'=>'Movil','local'=>'Local','fax'=>'Fax'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>
					-->

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection