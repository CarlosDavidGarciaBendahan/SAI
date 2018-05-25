@extends('admin.template.main2')

@section('title', 'Editar contacto '. $tlf->con_tel_codigo."-".$tlf->con_tel_numero)

@section('contenido-header-name', 'Edición de teléfono')

@section('contenido-header-name2', 'editar teléfono')


@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('cliente_natural.edit',$cliente_natural->id) }}"> Persona</a></li>
        <li class="active">teléfono</li>
        <li class="active">Editar</li>
    </ol>
@endsection

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['contacto_telefono.update',$tlf], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						
						{!! Form::label('nombre cliente_natural','cliente_natural') !!}
						{!! Form::text('cliente_natural',$cliente_natural->cli_nat_nombre ." ".$cliente_natural->cli_nat_apellido,['class'=> 'form-control', 'placeholder'=>'nombre cliente_natural', 'required', 'readonly'=>'true']) !!}
						
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
