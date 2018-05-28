@extends('layouts.app2')

@section('content')
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					
					<h1 class="panel-title">Acceso al sistema administrativo SAI</h1>
				</div>
				<div class="panel-body">
					<form method="POST" action="{{ route('login') }}">
						{{ csrf_field() }} <!-- acomoda el error del token csrf-->
						<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name"> Nombre de usuario</label>
							<input  class="form-control" 
									type="text" 
									name="name" 
									value="{{ old('name') }}" 
									placeholder="Ingresar usuario">
									{{ $errors->first('name',':message') }}
						</div>
						<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password"> Contraseña</label>
							<input  class="form-control" 
									type="password" 
									name="password" 
									placeholder="Ingresar contraseña">
									{{ $errors->first('password',':message') }}
						</div>
						{!! Form::submit('Acceder',['class'=>'btn btn-primary btn-block']) !!}
						<!--<botton class="btn btn-primary btn-block">Acceder</botton>-->
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection