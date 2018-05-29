@extends('layouts.app2')

@section('content')
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="panel panel-default">

				<div class="panel-heading">
					
					<h1 class="panel-title">Solicitud de nueva clave temporal para un usuario</h1>
				</div>
				<div class="panel-body">

					<form method="POST" action="{{ route('resetClave') }}">
						{{ csrf_field() }} <!-- acomoda el error del token csrf-->
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name"> Nombre de usuario</label>
							<input  class="form-control" 
									type="text" 
									name="name" 
									value="{{ old('name') }}" 
									placeholder="Ingresar usuario"
									pattern="[A-za-z0-9]+"
									maxlength="20"
									title="Solo letras mayúsculas, minúsculas y números sin espacios max: 20"
									required="true">
									{{ $errors->first('name',':message') }}
						</div>
						<!--
						<div class="form-group  $errors->has('password') ? 'has-error' : '' }}">
							<label for="password"> Contraseña</label>
							<input  class="form-control" 
									type="password" 
									name="password" 
									placeholder="Ingresar contraseña">
									 $errors->first('password',':message') }}
						</div>
						-->
						{!! Form::submit('Solicitar',['class'=>'btn btn-primary btn-block']) !!}
						<!--<botton class="btn btn-primary btn-block">Acceder</botton>-->
					</form>
					<br>
					@include('flash::message')
				</div>
			</div>
		</div>
	</div>
@endsection