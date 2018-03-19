@extends('admin.template.main')

@section('title', 'Editar correo '. $correo->con_cor_correo)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['contacto_correo.update',$correo], 'method' => 'PUT' ]) !!}
					
					<div class="form-group">
						<!--
						{!! Form::text('con_cor_fk_empresa',$empresa->id,['class'=> 'form-control', 'placeholder'=>'nombre empresa', 'required', 'readonly'=>'true', 'style'=>'visibility:hidden']) !!}
						-->
						{!! Form::label('con_cor_fk_empresa','Empresa') !!}
						{!! Form::text('empresa',$empresa->emp_nombre,['class'=> 'form-control', 'placeholder'=>'nombre empresa', 'required', 'readonly'=>'true']) !!}
						
					</div>

					<div class="form-group">
						{!! Form::label('con_cor_correo','Correo') !!}
						{!! Form::email('con_cor_correo',$correo->con_cor_correo,['class'=> 'form-control', 'placeholder'=>'414', 'required']) !!}
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