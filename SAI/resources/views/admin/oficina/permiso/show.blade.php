@extends('admin.template.main')

@section('title', 'Mostrar la permiso '. $permiso->perm_permiso)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => 'permiso.store', 'method' => 'POST' ]) !!}
					<div class="form-group"> 
						
						{!! Form::label('id','ID') !!}

						{!! Form::text('id',$permiso->id,['class'=> 'form-contpermiso', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>
					<div class="form-group"> 
						
						{!! Form::label('perm_permiso','permiso') !!}

						{!! Form::text('perm_permiso',$permiso->perm_permiso,['class'=> 'form-control', 'placeholder'=>'Nombre del estado', 'required']) !!}
					</div>

					<div>
						<a href="{{ route('permiso.index') }}" class="btn btn-info">
					      		<span class="glyphicon glyphicon-arrow-left"></span> Regresar al listado
					     </a>
					</div>

				{!! Form::close() !!}

				
			</div>
			
			

		</div>
			
	</section>
	

@endsection