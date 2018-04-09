@extends('admin.template.mainPDF')


@section('title', 'Presupuesto')

@section('empresa')
    
    
    <div class="div-marco">       
        <div class="div-texto">
           {{ $presupuesto->empresa->emp_nombre }} 
        </div>
        <div class="div-texto">
            {{ $presupuesto->empresa->emp_identificador ."-".$presupuesto->empresa->emp_rif }} 
        </div>
        <div class="div-texto">
            {{ $presupuesto->empresa->emp_direccion.". Par. ".$presupuesto->empresa->parroquia->par_nombre.". Mun. ".$presupuesto->empresa->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->empresa->parroquia->municipio->estado->est_nombre }}
        </div>
        <div class="div-texto">
            @foreach ($presupuesto->empresa->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
            @endforeach 
        </div>
        <div class="div-texto">
            @foreach ($presupuesto->empresa->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
            @endforeach
        </div>
       
    </div>

    
@endsection

@section('cliente')

    <div class="div-marco">
        @if ($presupuesto->cliente_natural !== null)
           <div class="div-texto">
               {{ $presupuesto->cliente_natural->cli_nat_nombre ." ".$presupuesto->cliente_natural->cli_nat_nombre2 ." ".$presupuesto->cliente_natural->cli_nat_apellido ." ".$presupuesto->cliente_natural->cli_nat_apellido2 }}
           </div>
           <div class="div-texto">
               {{ $presupuesto->cliente_natural->cli_nat_identificador."-".$presupuesto->cliente_natural->cli_nat_cedula }}
           </div>
           <div class="div-texto">
               {{ $presupuesto->cliente_natural->cli_nat_direccion.". Par. ".$presupuesto->cliente_natural->parroquia->par_nombre.". Mun. ".$presupuesto->cliente_natural->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->cliente_natural->parroquia->municipio->estado->est_nombre }}
           </div>
           <div class="div-texto">
               @foreach ($presupuesto->cliente_natural->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
                @endforeach   
           </div>
           <div class="div-texto">
               @foreach ($presupuesto->cliente_natural->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
                @endforeach 
           </div>
            
        @else
            @if ($presupuesto->cliente_juridico !== null)
                <div class="div-texto">
                   {{ $presupuesto->cliente_juridico->cli_jur_nombre }}
               </div>
               <div class="div-texto">
                   {{ $presupuesto->cliente_juridico->cli_jur_identificador."-".$presupuesto->cliente_juridico->cli_jur_rif }}
               </div>
               <div class="div-texto">
                   {{ $presupuesto->cliente_juridico->cli_jur_direccion.". Par. ".$presupuesto->cliente_juridico->parroquia->par_nombre.". Mun. ".$presupuesto->cliente_juridico->parroquia->municipio->mun_nombre.". Edo. ".$presupuesto->cliente_juridico->parroquia->municipio->estado->est_nombre }}
               </div>
               <div class="div-texto">
                   @foreach ($presupuesto->cliente_juridico->Contacto_Correos as $correo)
                       {{ $correo->con_cor_correo ." / "}}
                    @endforeach   
               </div>
               <div class="div-texto">
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
        <div class="div-texto">
            presupuesto #{{ $presupuesto->id }}
        </div>
        <div class="div-texto">
            Solicitado :{{ date("d/m/Y", strtotime($presupuesto->pre_fecha_solicitud)) }}
        </div>
        <div class="div-texto">
            Aprobado  :{{ date("d/m/Y", strtotime($presupuesto->pre_fecha_aprobado)) }}
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
                            <td class="th_descripcion">{{ $detalle->producto_computador->pro_com_descripcion }}</td>
                            <td class="th_codigo">{{ $detalle->producto_computador->pro_com_codigo }}</td>
                            <td class="th_precio">{{ $detalle->producto_computador->pro_com_precio }}</td>
                            <td class="th_cantidad">{{ $detalle->det_cantidad}}</td>
                            <td class="th_total">{{ $detalle->det_total}}</td>
                        </tr>
                    @else
                        <tr>
                            <td class="th_descripcion">{{ $detalle->producto_articulo->pro_art_descripcion }}</td>
                            <td class="th_codigo">{{ $detalle->producto_articulo->pro_art_codigo }}</td>
                            <td class="th_precio">{{ $detalle->producto_articulo->pro_art_precio }}</td>
                            <td class="th_cantidad">{{ $detalle->det_cantidad}}</td>
                            <td class="th_total">{{ $detalle->det_total}}</td>
                        </tr>
                    @endif
                @endforeach
                
            </tbody>
    </table>
    <div>
        
        <p>
            SubTotal: {{ $presupuesto->pre_subtotal }} Bs.<br>
            Total:    {{ $presupuesto->pre_subtotal }} Bs.
        </p>
    
    </div>
    
@endsection

@section('footer')
     <!-- <p>Indatech C.A. - Venta de productos de computación</p> -->
@endsection