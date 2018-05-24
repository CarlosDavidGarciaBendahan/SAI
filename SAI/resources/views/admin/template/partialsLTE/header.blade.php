<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('cliente_natural.index') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IDT</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Indatech</b>C.A.</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="/adminLTE/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <span class="hidden-xs">AQUI PUEDO PONER UN @ yield('usuario','default')</span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar">aqui puedo salir header<i class="fa fa-gears"></i></a>
            
          </li>
        </ul>
      </div>
    </nav>
  </header>