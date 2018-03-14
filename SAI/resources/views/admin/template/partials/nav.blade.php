<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Lugar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('estado.index') }}">Estado</a>
          <a class="dropdown-item" href="{{ route('municipio.index') }}">Municipio</a>
          <a class="dropdown-item" href="{{ route('parroquia.index') }}">Parroquia</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Producto
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('producto_computador.index') }}">Computadoras</a>
          <a class="dropdown-item" href="{{ route('producto_articulo.index') }}">Artículos</a>
          <a class="dropdown-item" href="{{ route('tipo_producto.index') }}">Tipo producto</a>
          <a class="dropdown-item" href="{{ route('marca.index') }}">Marca</a>
          <a class="dropdown-item" href="{{ route('modelo.index') }}">Modelo</a>
          <a class="dropdown-item" href="{{ route('unidadmedida.index') }}">Unidad de medida</a>
          <a class="dropdown-item" href="{{ route('lote.index') }}">Lote</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Oficina
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('empresa.index') }}">Empresa</a>
          <a class="dropdown-item" href="{{ route('oficina.index') }}">Oficina</a>
          <a class="dropdown-item" href="{{ route('sector.index') }}">Sector</a>
          <a class="dropdown-item" href="{{ route('personal.index') }}">Personal</a>
          <a class="dropdown-item" href="{{ route('cliente_natural.index') }}">Cliente natural</a>
          <a class="dropdown-item" href="{{ route('cliente_juridico.index') }}">Cliente juridico</a>
          <a class="dropdown-item" href="{{ route('rol.index') }}">Roles</a>
          <a class="dropdown-item" href="{{ route('permiso.index') }}">Permisos</a>
          <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>  
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('banco.index') }}"> Banco <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>