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

						<input class='form-control'  type='text' name='con_tel_codigo' placeholder='414' required='true' pattern="[0-9]+" minlength="3" maxlength="4" title="Solo números, min:3 y max:4">
					</div>

					<div class="form-group">
						{!! Form::label('con_tel_numero','Número') !!}
						<input class='form-control'  type='text' name='con_tel_numero' placeholder='1234567' required='true' pattern="[0-9]+" minlength="7" maxlength="7" title="Solo números, min:7 y max:7">
					</div>
					<div class="form-group">
						{!! Form::label('con_tel_tipo','Tipo') !!}
						{!! Form::select('con_tel_tipo',['movil'=>'Movil','local'=>'Local','fax'=>'Fax'], 'Movil', ['class'=>'form-control', 'placeholder'=>'Elegir un tipo', 'required'] ) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
					</div>


					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	

@endsection
