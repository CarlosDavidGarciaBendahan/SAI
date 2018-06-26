@extends('admin.template.mainPDF')


@section('title', 'Presupuesto')

@section('titulo')
 <div class="titulo">
      <h2>PRESUPUESTO #{{$presupuesto->id  }}</h2>
    </div>
@endsection
@section('empresa')
    
    
    <div class="div-marco">       
        <div class="div-texto">
           <strong>{{ $presupuesto->empresa->emp_nombre }} </strong>
        </div>
        <div class="div-texto">
           <strong>RIF: </strong> {{ $presupuesto->empresa->emp_identificador ."-".$presupuesto->empresa->emp_rif }} 
        </div>
        <div class="div-texto">
            <strong>Dirección: </strong>{{ $presupuesto->empresa->emp_direccion.". Par. ".$presupuesto->empresa->parroquia->par_nombre.". Mun. ".$presupuesto->empresa->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->empresa->parroquia->municipio->estado->est_nombre }}
        </div>
        <div class="div-texto">
          <strong>Correos: </strong>
            @foreach ($presupuesto->empresa->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
            @endforeach 
        </div>
        <div class="div-texto">
          <strong>Teléfonos: </strong>
            @foreach ($presupuesto->empresa->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
            @endforeach
        </div>
       
    </div>

    
@endsection

@section('cliente')
  <hr>
    <div class="div-marco">
        @if ($presupuesto->cliente_natural !== null)
           <div class="div-texto">
               <strong>Cliente: </strong> {{ $presupuesto->cliente_natural->cli_nat_nombre ." ".$presupuesto->cliente_natural->cli_nat_nombre2 ." ".$presupuesto->cliente_natural->cli_nat_apellido ." ".$presupuesto->cliente_natural->cli_nat_apellido2 }}
           </div>
           <div class="div-texto">
               <strong>Cédula: </strong>{{ $presupuesto->cliente_natural->cli_nat_identificador."-".$presupuesto->cliente_natural->cli_nat_cedula }}
           </div>
           <div class="div-texto">
               <strong>Dirección: </strong>{{ $presupuesto->cliente_natural->cli_nat_direccion.". Par. ".$presupuesto->cliente_natural->parroquia->par_nombre.". Mun. ".$presupuesto->cliente_natural->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->cliente_natural->parroquia->municipio->estado->est_nombre }}
           </div>
           <div class="div-texto">
              <strong>Correos: </strong>
               @foreach ($presupuesto->cliente_natural->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
                @endforeach   
           </div>
           <div class="div-texto">
              <strong>Teléfonos: </strong>
               @foreach ($presupuesto->cliente_natural->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
                @endforeach 
           </div>
            
        @else
            @if ($presupuesto->cliente_juridico !== null)
                <div class="div-texto">
                   <strong>Cliente: </strong> {{ $presupuesto->cliente_juridico->cli_jur_nombre }}
               </div>
               <div class="div-texto">
                   <strong>RIF: </strong>{{ $presupuesto->cliente_juridico->cli_jur_identificador."-".$presupuesto->cliente_juridico->cli_jur_rif }}
               </div>
               <div class="div-texto">
                   <strong>Dirección: </strong>{{ $presupuesto->cliente_juridico->cli_jur_direccion.". Par. ".$presupuesto->cliente_juridico->parroquia->par_nombre.". Mun. ".$presupuesto->cliente_juridico->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->cliente_juridico->parroquia->municipio->estado->est_nombre }}
               </div>
               <div class="div-texto">
              <strong>Correos: </strong>
                   @foreach ($presupuesto->cliente_juridico->Contacto_Correos as $correo)
                       {{ $correo->con_cor_correo ." / "}}
                    @endforeach   
               </div>
               <div class="div-texto">
              <strong>Teléfonos: </strong>
                   @foreach ($presupuesto->cliente_juridico->Contacto_telefonos as $tlf)
                       {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
                    @endforeach 
               </div>
            @endif
            
        @endif
        
    </div>

    
@endsection

@section('presupuesto')
    <div class="div-marco">
        <!--<div class="div-texto">
            presupuesto #{ { $presupuesto->id }}
        </div>-->
        <div class="div-texto">
            <strong>Fecha solicitud: </strong>{{ date("d/m/Y", strtotime($presupuesto->pre_fecha_solicitud)) }}
        </div>
        <div class="div-texto">
            @if ($presupuesto->pre_fecha_aprobado !== null)
            <strong>Fecha aprobación: </strong>
            
                {{ date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)) }}
            @endif
        </div>
    
    </div>
@endsection

@section('productos')

    <table class="table table-inverse">
        <thead>
            
            <tr>
                <th class="th_descripcion">Descripción</th>
                <th class="th_codigo">Código</th>
                <th class="th_precio">Precio unitario</th>
                <th class="th_cantidad">Cantidad</th>
                <th class="th_total">Total</th>
            </tr>
        
        </thead>
            <tbody>
                @foreach ($presupuesto->detalles as $detalle)
                    @if ($detalle->producto_computador !== null)
                        <tr>
                            <td class="">{{ $detalle->producto_computador->pro_com_descripcion }}</td>
                            <td class="">{{ $detalle->producto_computador->pro_com_codigo }}</td>
                            <td class="">{{ $detalle->producto_computador->pro_com_precio }}</td>
                            <td class="">{{ $detalle->det_cantidad}}</td>
                            <td class="">{{ $detalle->det_total}}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="">{{ $detalle->producto_articulo->pro_art_descripcion }}</td>
                            <td class="">{{ $detalle->producto_articulo->pro_art_codigo }}</td>
                            <td class="">{{ $detalle->producto_articulo->pro_art_precio }}</td>
                            <td class="">{{ $detalle->det_cantidad}}</td>
                            <td class="">{{ $detalle->det_total}}</td>
                        </tr>
                    @endif
                @endforeach
                
            </tbody>
    </table>
    <div class="total">
        
        <p>
            <strong>SubTotal:</strong> {{ $presupuesto->pre_subtotal }} Bs.<br>
            <strong>Total:</strong>    {{ $presupuesto->pre_subtotal*1.12 }} Bs.
        </p>
    
    </div>
    
@endsection

@section('footer')
     <!-- <p>Indatech C.A. - Venta de productos de computación</p> -->
@endsection