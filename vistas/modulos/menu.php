<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a href="inicio" class="brand-link">

    <img src="vistas/img/plantilla/logo.png" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8">

    <span class="brand-text font-weight-light">Karina</span>

  </a>

    <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"] ?></a>
        </div>
      </div>

      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="crearventa" class="nav-link">
              <i class="nav-icon fas fa-barcode"></i>
              <p>
                Crear venta
                <span class="right badge badge-danger">Building</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="clientes" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="solicitud" class="nav-link">
              <i class="nav-icon fas fa-clone"></i>
              <p>
                Solicitudes
                <span class="right badge badge-danger">Building</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="proveedores" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Proveedores
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="productos" class="nav-link">
              <i class="nav-icon fas fa-dolly"></i>
              <p>
                Productos
                <span class="right badge badge-danger">Building</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="almacen" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Almacenes
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>

        </ul>

      </nav>

    </div>

  </aside>