@extends('admin.template.main')

@section('title', 'Editar banco '. $banco->ban_nombre)

@section('body')
	{{-- expr --}}
	<section class="container">
		<div class="row">
			<div class="col-sm-8 offset-2">
				{!! Form::open(['route' => ['banco.update',$banco], 'method' => 'PUT' ]) !!}
					
					<div class="form-group"> 
						
						{!! Form::label('ban_nombre','Nombre del banco') !!}

						{!! Form::text('ban_nombre',$banco->ban_nombre,['class'=> 'form-control', 'placeholder'=>'Nombre del banco', 'required']) !!}
					</div>

					<div class="form-group">
						{!! Form::submit('Editar',['class'=>'btn btn-primary']) !!}
					</div>
					

				{!! Form::close() !!}
			</div>
			
		</div>
			
	</section>
	
@endsection