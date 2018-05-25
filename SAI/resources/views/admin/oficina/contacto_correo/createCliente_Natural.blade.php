@extends('admin.template.main2')

@section('title', 'Crear correo ')

@section('contenido-header-name', 'Registro de correo')

@section('contenido-header-name2', 'crear correo')


@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_natural.edit',$cliente_natural->id) }}"> Persona</a></li>
        <li class="active">Correo</li>
        <li class="active">Crear</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'contacto_correo.store', 'method' => 'POST' ]) !!}
					
					<div class="form-group">
						{!! Form::label('ID','ID cliente') !!}
						{!! Form::text('con_cor_fk_cliente_natural',$cliente_natural->id,['class'=> 'form-control', 'placeholder'=>'nombre cliente_natural', 'required', 'readonly'=>'true']) !!}
					
						{!! Form::label('nombre cliente_natural','cliente') !!}
						{!! Form::text('cliente_natural',$cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_apellido,['class'=> 'form-control', 'placeholder'=>'nombre cliente_natural', 'required', 'readonly'=>'true']) !!}
						
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
