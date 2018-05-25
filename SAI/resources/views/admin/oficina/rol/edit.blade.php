@extends('admin.template.main2')

@section('title', 'Editar rol '. $rol->rol_rol)

@section('contenido-header-name', 'Edición de rol')

@section('contenido-header-name2', 'editar rol')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('rol.index') }}"> Rol</a></li>
        <li class="active">Editar</li>
    </ol>
@endsection


@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['rol.update',$rol], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('rol_rol','rol') !!}

						{!! Form::text('rol_rol',$rol->rol_rol,['class'=> 'form-control', 'placeholder'=>'Tipo de producto', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('permisos','Permisos') !!}

						{!! Form::select('permisos[]',$permisos,$rol->permisos->pluck('id'),['class'=> 'form-control select-permisos', 'placeholder'=>'seleccionar permisos', 'multiple','required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
@endsection