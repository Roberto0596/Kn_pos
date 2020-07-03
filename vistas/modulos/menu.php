<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a href="reportes" class="brand-link">

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

          <?php if ($_SESSION["perfil"]=="Gerente General"): ?>          
          

          <li class="nav-item">
            <a href="reportes" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Reportes
                <!--<span class="right badge badge-danger">Building</span>-->
              </p>
            </a>
          </li>

          <?php endif ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crearventa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?ruta=crearventa&compra=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compra</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="abonos" class="nav-link">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Abonar cuenta
                <!--<span class="right badge badge-danger">Building</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="clientes" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clientes
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="solicitud" class="nav-link">
              <i class="nav-icon fas fa-clone"></i>
              <p>
                Solicitudes
                <!--<span class="right badge badge-danger">new</span>-->
              </p>
            </a>
          </li>

          <?php if ($_SESSION["perfil"]=="Gerente General"): ?> 

          <li class="nav-item">
            <a href="proveedores" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Proveedores
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="productos" class="nav-link">
              <i class="nav-icon fas fa-dolly"></i>
              <p>
                Productos
                <!--<span class="right badge badge-danger">Building</span> -->
              </p>
            </a>
          </li>

<!--
          <li class="nav-item">
            <a href="descuentos" class="nav-link">
              <i class="nav-icon fas fa-percent"></i>
              <p>
                Descuentos
                <span class="right badge badge-danger">Building</span>
              </p>
            </a>
          </li>
-->
          <li class="nav-item">
            <a href="usuarios" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="almacen" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Almacenes
                <!--<span class="right badge badge-danger">New</span>-->
              </p>
            </a>
          </li>
<<<<<<< HEAD
=======

          <?php endif ?>

>>>>>>> 11e678bb1944be4daf4267177a7dd91b7e74b529
        </ul>
      </nav>
    </div>
  </aside>