@extends('admin.template.main')

@section('title','Presupuesto #'.$presupuesto_id)

@section('body')

    <section class="container cabeza">
        <div class="row">
            <div class="col-sm-8 offset-2 justify-content-center">            
                <h1>Hola bienvenido a la página de administrador</h1>
            </div>
        </div>
    </section>
    <section class="container cuerpo">
        <div class="row">
            <div class="col-sm-8 offset-2 justify-content-center">
                <p>esto es un parrafo de prueba</p>
            </div>
            <div class="col-sm-8 offset-2">               
                <div class="btn btn-success">
                    INGRESAR
                </div>
            </div>
        </div>
    </section>
    <section class="container pie">
        @section('footer')

        @endsection
    </section>
@endsection