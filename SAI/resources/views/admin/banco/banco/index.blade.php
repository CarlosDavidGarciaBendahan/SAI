@extends('admin.template.main2')

@section('title', 'Listar bancos')

@section('contenido-header-name', 'Banco')

@section('contenido-header-name2', 'listado de bancos')

@section('contenido-header-route')
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banco</li>
    </ol>
@endsection

@section('body')
	{{-- {{ dd($estado) }} --}}

	<section class="container-fluid">

		<div class="row">
			<div class="col-sm-12">

				<a href="{{ route('banco.create') }}" class="btn btn-info">Registrar nuevo banco</a>
				

				<table class="table table-inverse">
				  <thead>
				    <tr>
				      <th>ID</th>
				      <th>banco</th>
				    </tr>
				  </thead>
				  <tbody>

				  	@foreach ($bancos as $banco)
				  		<tr>
					      <th scope="row">{{ $banco->id }}</th>
					      <td>{{ $banco->ban_nombre }}</td>	
					      <td>
					      	<a href="{{ route('banco.edit', $banco->id) }}" class="btn btn-warning">
					      		<span class="class glyphicon glyphicon-wrench"></span>
					      	</a>

					      	<a href="{{ route('banco.destroy', $banco->id) }}" onclick="return confirm('Eliminar el banco?')" class="btn btn-danger">
					      		<span class="class glyphicon glyphicon-remove-circle"></span>
					      	</a> 
					      </td>
				    	</tr>
				  	@endforeach

				  </tbody>

				</table>
				{{ $bancos->links() }}
			</div>
			
		</div>
			
	</section>


	

@endsection