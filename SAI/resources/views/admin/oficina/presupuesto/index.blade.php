@extends('admin.template.main')

@section('title', 'Listar Presupuestos')

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-8 offset-2">

				<a href="{{ route('presupuesto.create') }}" class="btn btn-info">Registrar nuevo presupuesto</a>
				
				
			</div>
			
		</div>
			
	</section>


	

@endsection


