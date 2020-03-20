<nav class="main-header navbar navbar-expand navbar-white navbar-light" role = "navigation">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <div class="navbar-custom-menu ml-auto">

    <ul class="nav navbar-nav" style="margin-right: 1vh;">

      <li style="padding-top: 8px;    padding-right: 20px;">
        <?php
            $usuario = $_SESSION["id"];
            $item = "id";
            $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$usuario);
            $almacen = $respuesta["almacen"];
            $respuesta = ControladorAlmacen::ctrGetNombreAlmacen($almacen);
            echo '<h5><b>'."Sucursal: ".$respuesta["nombre"].'</b></h5>';
        ?>
      </li>

      <li class="dropdown user user-menu generic">

            <a href="#" class = "dropdown-toggle" data-toggle="dropdown">                        
              <?php 
                  if ($_SESSION["foto"] != "")
                  {
                      echo '<img src="'.$_SESSION["foto"].'" class="user-image">';
                  }
                  else
                  {
                     echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
                  }
                  $text = $_SESSION["nombre"];
                  echo '<span class = "hidden-xs">'.$text.'</span>';
              ?> 
            </a>

            <ul class="dropdown-menu">
        
              <li class="user-body">
                <div class = "pull-right">

                  <a href="salir" class="btn btn-default btn-flat">salir</a>
                  
                </div>
              </li>
            </ul>

      </li>
               
    </ul>

  </div>

</nav>