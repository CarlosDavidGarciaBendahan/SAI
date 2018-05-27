@extends('admin.template.main2')

@section('title', 'Editar correo '. $correo->con_cor_correo)

@section('contenido-header-name', 'Edición de correo')

@section('contenido-header-name2', 'editar correo')


@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_juridico.edit',$cliente_juridico->id) }}"> Empresa</a></li>
        <li class="active">Correo</li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['contacto_correo.update',$correo], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						
					
						{!! Form::label('nombre cliente_juridico','Empresa cliente') !!}
						{!! Form::text('cliente_juridico',$cliente_juridico->cli_jur_nombre,['class'=> 'form-control', 'placeholder'=>'nombre cliente_juridico', 'required', 'readonly'=>'true']) !!}
						
					</div>

					<div class="form-group">
						{!! Form::label('con_cor_correo','Correo') !!}
						<input class='form-control' value={{ $correo->con_cor_correo }} type='email' name='con_cor_correo' placeholder='correo@gmail.com' required='true' pattern=".+@[gG]?[mM]?[aA]?[iI]?[lL]?[hH]?[oO]?[tT]?[mM]?[aA]?[iI]?[lL]?[.][cC][oO][mM]" title="Solo se permiten cuentas de GMAIL o HOTMAIL">
					</div>
					<!--
					<div class="form-group">
						{!! Form::label('con_cor_numero','Número') !!}
						{!! Form::text('con_cor_numero',$correo->con_cor_numero,['class'=> 'form-control', 'placeholder'=>'1234567', 'required']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('con_cor_tipo','Tipo') !!}
						{!! Form::select('con_cor_tipo',['movil'=>'Movil','local'=>'Local','fax'=>'Fax'], $correo->con_cor_tipo, ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>
					-->

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
