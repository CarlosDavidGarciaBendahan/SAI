@extends('admin.template.mainPDF')


@section('title', 'Presupuesto')

@section('empresa')
    <div>
       <p>
            nombre de la empresa    <br>
            rif de la empresa       <br>
            dirección de la empresa <br>
            correos de la empresa   <br>
            telefonos de la empresa
        </p> 
    </div>
    
@endsection

@section('cliente')
    <div>
        <p>
            nombre del cliente    <br>
            identificador       <br>
            dirección del cliente <br>
            correos del cliente   <br>
            telefonos del cliente
        </p>
    </div>
    
@endsection

@section('presupuesto')
    
    <div>
        <p>
            número de presupuesto:  1 <br>
            fecha de solicitud:     04/04/2018 <br>
            fecha de aprobado: 


        </p>
    </div>

    

@endsection

@section('productos')
    <table class="table table-inverse">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Código</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
            <tbody>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre.</td>
                    <td>B201030</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 22. Esto es relleno para ver que pasa.</td>
                    <td>B201111</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
                <tr>
                    <td>Computador de escritorio, tipo torre 33.</td>
                    <td>B203635</td>
                    <td>16.800.000,00</td>
                    <td>5</td>
                    <td>84.000.000,00</td>
                </tr>
            </tbody>
    </table>
    <div>
        <p>
            SubTotal: 252.000.000,00 Bs. <br>
            Total:    252.000.000,00 Bs.
        </p>
    </div>
@endsection

@section('footer')
    <p>Indatech C.A. - Venta de productos de computación</p>
@endsection