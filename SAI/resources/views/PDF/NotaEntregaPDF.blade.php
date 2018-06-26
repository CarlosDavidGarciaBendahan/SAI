@extends('admin.template.mainPDF')


@section('title', 'Nota de entrega')
@section('titulo')
 <div class="titulo">
      <h2>NOTA DE ENTREGA #{{$notaEntrega->id  }}</h2>
    </div>
@endsection
@section('empresa')
    
    
    <div class="div-marco">       
        <div class="div-texto">
           <strong>{{ $notaEntrega->empresa->emp_nombre }} </strong>
        </div>
        <div class="div-texto">
            <strong>RIF: </strong> {{ $notaEntrega->empresa->emp_identificador ."-".$notaEntrega->empresa->emp_rif }} 
        </div>
        <div class="div-texto">
            <strong>Dirección: </strong>{{ $notaEntrega->empresa->emp_direccion.". Par. ".$notaEntrega->empresa->parroquia->par_nombre.". Mun. ".$notaEntrega->empresa->parroquia->municipio->mun_nombre.". Edo. ".$notaEntrega->empresa->parroquia->municipio->estado->est_nombre }}
        </div>
        <div class="div-texto">
          <strong>Correos: </strong>
            @foreach ($notaEntrega->empresa->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
            @endforeach 
        </div>
        <div class="div-texto">
          <strong>Teléfonos: </strong>
            @foreach ($notaEntrega->empresa->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
            @endforeach
        </div>
       
    </div>

    
@endsection

@section('cliente')
  <hr>
    <div class="div-marco">
        @if ($notaEntrega->Venta->cliente_natural !== null)
           <div class="div-texto">
               <strong>Cliente: </strong> {{ $notaEntrega->Venta->cliente_natural->cli_nat_nombre ." ".$notaEntrega->Venta->cliente_natural->cli_nat_nombre2 ." ".$notaEntrega->Venta->cliente_natural->cli_nat_apellido ." ".$notaEntrega->Venta->cliente_natural->cli_nat_apellido2 }}
           </div>
           <div class="div-texto">
               <strong>Cédula: </strong>{{ $notaEntrega->Venta->cliente_natural->cli_nat_identificador."-".$notaEntrega->Venta->cliente_natural->cli_nat_cedula }}
           </div>
           <div class="div-texto">
               <strong>Dirección: </strong>{{ $notaEntrega->Venta->cliente_natural->cli_nat_direccion.". Par. ".$notaEntrega->Venta->cliente_natural->parroquia->par_nombre.". Mun. ".$notaEntrega->Venta->cliente_natural->parroquia->municipio->mun_nombre.". Edo. ".$notaEntrega->Venta->cliente_natural->parroquia->municipio->estado->est_nombre }}
           </div>
           <div class="div-texto">
              <strong>Correos: </strong>
               @foreach ($notaEntrega->Venta->cliente_natural->Contacto_Correos as $correo)
                   {{ $correo->con_cor_correo ." / "}}
                @endforeach   
           </div>
           <div class="div-texto">
              <strong>Teléfonos: </strong>
               @foreach ($notaEntrega->Venta->cliente_natural->Contacto_telefonos as $tlf)
                   {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
                @endforeach 
           </div>
            
        @else
            @if ($notaEntrega->Venta->cliente_juridico !== null)
                <div class="div-texto">
                   <strong>Cliente: </strong>{{ $notaEntrega->Venta->cliente_juridico->cli_jur_nombre }}
               </div>
               <div class="div-texto">
                   <strong>RIF: </strong>{{ $notaEntrega->Venta->cliente_juridico->cli_jur_identificador."-".$notaEntrega->Venta->cliente_juridico->cli_jur_rif }}
               </div>
               <div class="div-texto">
                   <strong>Dirección: </strong>{{ $notaEntrega->Venta->cliente_juridico->cli_jur_direccion.". Par. ".$notaEntrega->Venta->cliente_juridico->parroquia->par_nombre.". Mun. ".$notaEntrega->Venta->cliente_juridico->parroquia->municipio->mun_nombre.". Edo. ".$notaEntrega->Venta->cliente_juridico->parroquia->municipio->estado->est_nombre }}
               </div>
               <div class="div-texto">
                <strong>Correos: </strong>
                   @foreach ($notaEntrega->Venta->cliente_juridico->Contacto_Correos as $correo)
                       {{ $correo->con_cor_correo ." / "}}
                    @endforeach   
               </div>
               <div class="div-texto">
              <strong>Teléfonos: </strong>
                   @foreach ($notaEntrega->Venta->cliente_juridico->Contacto_telefonos as $tlf)
                       {{ $tlf->con_tel_codigo ."-".$tlf->con_tel_numero." / "}}
                    @endforeach 
               </div>
            @endif
            
        @endif
        
    </div>

    
@endsection

@section('presupuesto')
    <div class="div-marco">
        <div class="div-texto ">
            
              <!--<span class="nota_entrega">
                 <strong>Nota de entrega #{{ $notaEntrega->id }}</strong>            
               </span> -->
              <span class="nota_entrega_fecha">
                  <strong>Fecha de emisión: </strong>{{ date("d/m/Y", strtotime($notaEntrega->not_fecha)) }}
              </span>
            
        </div>
    </div>
@endsection

@section('productos')

    
   <div>  
        <table class="table table-inverse">
          <thead>
            <tr>
              <th class="th_nt_codigo">Código</th>
              <th class="th_nt_marca">Marca/Modelo</th>
              <th class="th_nt_tipo">Tipo</th>
              <th class="th_nt_componentes">Componentes/Capacidad</th>
              <th class="th_nt_costo">Costo</th>

            </tr>
          </thead>
          <tbody>

            @foreach ($notaEntrega->venta->ventaPCs as $codigoPC)
              <tr>
                <th scope="row">{{ $codigoPC->cod_pc_codigo }}</th>
                <td>{{ $codigoPC->producto_computador->modelo->marca->mar_marca ." ".$codigoPC->producto_computador->modelo->mod_modelo }}</td> 
                <td>{{ $codigoPC->producto_computador->Tipo_Producto->tip_tipo }}</td>
                  
                <td>
                  @foreach ($codigoPC->CodigoArticulos as $componente)
                    {{ $componente->producto_articulo->pro_art_capacidad." ".$componente->producto_articulo->unidadMedida->uni_medida." / " }}
                  @endforeach
                </td> 
                <td>
                  {{ $codigoPC->producto_computador->pro_com_precio." ".$codigoPC->producto_computador->pro_com_moneda }}
                </td>
                
              </tr>
            @endforeach
            @foreach ($notaEntrega->venta->ventaArticulos as $codigoArticulo)
              <tr>
                <th scope="row">{{ $codigoArticulo->cod_art_codigo }}</th>
                <td>{{ $codigoArticulo->producto_articulo->modelo->marca->mar_marca ." ".$codigoArticulo->producto_articulo->modelo->mod_modelo }}</td> 
                <td>{{ $codigoArticulo->producto_articulo->Tipo_Producto->tip_tipo }}</td>
               <td>
                  {{ $codigoArticulo->producto_articulo->pro_art_capacidad." ".$codigoArticulo->producto_articulo->unidadMedida->uni_medida }}
                </td>
                <td>
                  {{ $codigoArticulo->producto_articulo->pro_art_precio." ".$codigoArticulo->producto_articulo->pro_art_moneda }}
                </td>
                  
              </tr>
            @endforeach

          </tbody>

        </table>
        </div>
        



    <div class="total">
        
        <p>
            <strong>SubTotal:</strong> {{ $notaEntrega->not_subtotal }} Bs.<br>
            <strong>Total:</strong>    {{ $notaEntrega->not_subtotal *1.12 }} Bs.
        </p>
    
    </div>
    
    <!--<div>
      { { $notaEntrega->not_observaciones }}
    </div>-->
    
@endsection

@section('observaciones')
    <div>
      <h3><strong>Observaciones:</strong></h3>
      {{ $notaEntrega->not_observaciones }}
    </div>
@endsection
@section('footer')
     <!-- <p>Indatech C.A. - Venta de productos de computación</p> -->
@endsection