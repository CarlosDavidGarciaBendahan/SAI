@extends('admin.template.main2')

@section('title', 'Crear contacto ')

@section('contenido-header-name', 'Registro de teléfono')

@section('contenido-header-name2', 'crear teléfono')


@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_juridico.edit',$cliente_juridico->id) }}"> Empresa</a></li>
        <li class="active">teléfono</li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'contacto_telefono.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('ID','ID cliente_juridico') !!}
						{!! Form::text('con_tel_fk_cliente_juridico',$cliente_juridico->id,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
					
						{!! Form::label('nombre cliente_juridico','cliente_juridico') !!}
						{!! Form::text('cliente_juridico',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
						
					</div>

					<div class="form-group">
						{!! Form::label('con_tel_codigo','Código') !!}
						{!! Form::text('con_tel_codigo',null,['class'=> 'form-control', 'placeholder'=>'414', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('con_tel_numero','Número') !!}
						{!! Form::text('con_tel_numero',null,['class'=> 'form-control', 'placeholder'=>'1234567', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('con_tel_tipo','Tipo') !!}
						{!! Form::select('con_tel_tipo',['movil'=>'Movil','local'=>'Local','fax'=>'Fax'], null, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
