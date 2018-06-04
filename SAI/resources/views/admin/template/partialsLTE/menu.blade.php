<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!--<div class="user-panel">
        <div class="pull-left image">
          <img src="/adminLTE/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ PRINCIPAL</li>
        <!-- MENU DE UBICACION-->
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-globe"></i> <span>Ubicación</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('estado.index') }}"><i class="fa fa-circle-o"></i> Estado </a></li>
            <li><a href="{{ route('municipio.index') }}"><i class="fa fa-circle-o"></i> Municipio </a></li>
            <li><a href="{{ route('parroquia.index') }}"><i class="fa fa-circle-o"></i> Parroquia </a></li>
          </ul>
        </li>
        <!-- /MENU DE UBICACION-->


        <!-- MENU DE PRODUCTO-->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>Productos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('catalogo') }}"><i class="fa fa-circle-o"></i> Catálogo </a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Computador
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('producto_computador.index') }}"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="{{ route('codigoPC.index') }}"><i class="fa fa-circle-o"></i> Especifico</a></li>
                  <!--<li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> Level Two
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    </ul>
                  </li>-->
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Artículo
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('producto_articulo.index') }}"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="{{ route('codigoArticulo.index') }}"><i class="fa fa-circle-o"></i> Especifico</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Marca
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('marca.index') }}"><i class="fa fa-circle-o"></i> Marca</a></li>
                <li><a href="{{ route('modelo.index') }}"><i class="fa fa-circle-o"></i> Modelo</a></li>
              </ul>
            </li>

            <li class="treeview">
              <li><a href="{{ route('tipo_producto.index') }}"><i class="fa fa-circle-o"></i> Tipo de producto</a></li>
            </li>

            <li class="treeview">
              <li><a href="{{ route('unidadmedida.index') }}"><i class="fa fa-circle-o"></i> Unidad de medida</a></li>
            </li>

            <li class="treeview">
              <li><a href="{{ route('lote.index') }}"><i class="fa fa-circle-o"></i> Lote</a></li>
            </li>

          </ul>
        </li>
        <!-- /MENU DE PRODUCTO-->


        <!-- MENU DE OFICINA-->
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Oficina</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Empresa
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('empresa.index') }}"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> Oficina
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{ route('oficina.index') }}"><i class="fa fa-circle-o"></i> Oficina</a></li>
                      <li><a href="{{ route('sector.index') }}"><i class="fa fa-circle-o"></i> Sector</a></li>
                      <li><a href="{{ route('fuenteventa.index') }}"><i class="fa fa-circle-o"></i> Fuente de ventas</a></li>
                    </ul>
                  </li>
                <li><a href="{{ route('banco.index') }}"><i class="fa fa-circle-o"></i> Banco</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Personal
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('personal.index') }}"><i class="fa fa-circle-o"></i> Empleado</a></li>
                <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> Usuario</a></li>
                <li><a href="{{ route('rol.index') }}"><i class="fa fa-circle-o"></i> Rol</a></li>
                
              </ul>
            </li>
            
                
          </ul>
        </li>
        <!-- /MENU DE OFICINA-->



        <!-- MENU DE CLIENTE-->
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-child"></i> <span>Cliente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
                
                <li class="treeview">
                    <a href="#"><i class="fa fa-circle-o"></i> Tipo de cliente
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="{{ route('cliente_juridico.index') }}"><i class="fa fa-circle-o"></i> Empresa</a></li>
                      <li><a href="{{ route('cliente_natural.index') }}"><i class="fa fa-circle-o"></i> Persona</a></li>
                    </ul>
                  </li>
            
            <li><a href="{{ route('presupuesto.index') }}"><i class="fa fa-circle-o"></i> Presupuesto </a></li>
            <li><a href="{{ route('venta.index') }}"><i class="fa fa-circle-o"></i> Venta </a></li>
            <li><a href="{{ route('registroPago.listarRegistroPago',0) }}"><i class="fa fa-circle-o"></i> Registro de pago </a></li>
            <li><a href="{{ route('notaEntrega.index') }}"><i class="fa fa-circle-o"></i> Nota de entrega </a></li>
            <li><a href="{{ route('solicitud.index') }}"><i class="fa fa-circle-o"></i> Solicitud </a></li>
            
          </ul>
        </li>
        <!-- /MENU DE CLIENTE-->

        <!-- MENU DE REPORTE-->
        <li class=" treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ route('reporteCliente.index') }}"><i class="fa fa-circle-o"></i> Clientes </a></li>
            <li class="active"><a href="{{ route('reportesolicitud.index') }}"><i class="fa fa-circle-o"></i> Solicitudes </a></li>
            <li class="active"><a href="{{ route('reporteventa.index') }}"><i class="fa fa-circle-o"></i> Ventas </a></li>
          </ul>
        </li>
        <!-- /MENU DE REPORTE-->
         
    </section>
    <!-- /.sidebar -->
  </aside>