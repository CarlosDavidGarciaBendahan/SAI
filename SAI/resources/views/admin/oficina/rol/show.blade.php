@extends('admin.template.main2')

@section('title', 'Mostrar la rol '. $rol->rol_rol)

@section('contenido-header-name', 'Observación de rol')

@section('contenido-header-name2', 'observar rol')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('rol.index') }}"> Rol</a></li>
        <li class="active">Observar</li>
    </ol>
@endsection


@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'rol.store', 'method' => 'POST' ]) !!}
					<div class="form-group"> 
						
						{!! Form::label('id','ID') !!}

						{!! Form::text('id',$rol->id,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('rol_rol','rol') !!}

						{!! Form::text('rol_rol',$rol->rol_rol,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>

					<div class="form-group"> 
						
						{!! Form::label('permisos','Permisos') !!}

						{!! Form::select('permisos[]',$permisos,$rol->permisos->pluck('id'),['class'=> 'form-control select-permisos', 'placeholder'=>'seleccionar permisos', 'multiple','required','disabled']) !!}
					</div>

					<div>
						<a href="{{ route('rol.index') }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					     </a>
					</div>

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection
@section('scripts')
	<script src = "{{ asset('plugins/Script/ChosenMultipleSelector.js') }}"></script>
@endsection