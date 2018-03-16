@extends('admin.template.main')

@section('title', 'Editar contacto '. $tlf->con_tel_codigo."-".$tlf->con_tel_numero)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['contacto_telefono.update',$tlf], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						
						{!! Form::label('nombre cliente_juridico','cliente_juridico') !!}
						{!! Form::text('cliente_juridico',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
						
					</div>

					<div class="form-group">
						{!! Form::label('con_tel_codigo','Código') !!}
						{!! Form::text('con_tel_codigo',$tlf->con_tel_codigo,['class'=> 'form-control', 'placeholder'=>'414', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('con_tel_numero','Número') !!}
						{!! Form::text('con_tel_numero',$tlf->con_tel_numero,['class'=> 'form-control', 'placeholder'=>'1234567', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('con_tel_tipo','Tipo') !!}
						{!! Form::select('con_tel_tipo',['movil'=>'Movil','local'=>'Local','fax'=>'Fax'], $tlf->con_tel_tipo, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
