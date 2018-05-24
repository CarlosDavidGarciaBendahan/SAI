<!-- Content Header (Page header) -->
              <section class="content-header">
                <h1>
                  @yield('contenido-header-name','Nombre de la ventana')
                  <small>@yield('contenido-header-name2','subtitulo')</small>
                </h1>
                
                @yield('contenido-header-route')
                <!-- ESTE CÓDIGO DEBO AGREGARLO POR CADA VISTA
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                  <li class="active">Dashboard</li>
                </ol>
                -->
              </section>