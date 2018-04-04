@extends('admin.template.mainPDF')


@section('title', 'Presupuesto')

@section('empresa')
    <h3>empresa</h3>
@endsection

@section('cliente')
    <h3>cliente</h3>
@endsection

@section('presupuesto')
    <h3>presupuesto</h3>
    <h3>Presupuesto #{{ $id }}</h3>
@endsection

@section('productos')
    <h3>productos</h3>
@endsection

@section('footer')
    <h3>Indatech C.A. - Venta de productos de computación</h3>
@endsection