<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrar usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-block btn-primary" data-toggle="modal" data-target = "#modalAgregarUsuario"><i class="fa fa-fw fa-plus"></i>Agregar Nuevo</button>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-hover tablaUsuarios">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>
                <?php
                  $item = null;
                  $valor = null;
                  $respuesta = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
                  echo '<select class="selectAlmacen" id="almacenUsuarios">
                        <option value="todos" selected>Todos los almacenes</option>';
                  foreach ($respuesta as $key => $value)
                  {
                     echo '<option value="'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
                  }
                  echo '</select>';
                ?>
              </th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
            </thead>
        </table>
      </div>
    </div>
  </section>

</div>

<div class="modal fade" id="modalAgregarUsuario">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Agregar usuario</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post" autocomplete="off" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" name="nuevoNombre" placeholder="Ingresar nombre" required>

          </div>

          <div class="row">

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-key"></i></span>

                  </div>

                  <input type="text" class="form-control form-control-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="usuarioNew" required>

              </div>

            </div>

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-lock"></i></span>

                  </div>

                  <input type="password" class="form-control form-control-lg" name="nuevoPassword" placeholder="Ingresar contraseña" autocomplete="off" required>

              </div>

            </div>

            <div class="col-md-6">

            <?php

              $usuario = $_SESSION["perfil"];

              if ($usuario == "Gerente General")
              {
                 echo '<div class="form-group">

                      <div class="input-group">

                        <span class="input-group-text"><i class="fas fa-building"></i></span>';

                          $item = null;
                          $valor = null;
                          $respuesta = ControladorAlmacen::ctrMostrarAlmacen($item,$valor);
                          echo '<select class="form-control form-control-lg" name="nuevoAlmacen">
                                <option value="todos" selected>Todos los almacenes</option>';
                          foreach ($respuesta as $key => $value)
                          {
                             echo '<option value="'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
                          }
                          echo '</select>';

                      echo '</div>

                    </div>';
              }
              else
              {
                $usuario = $_SESSION["id"];
                $item = "id";
                $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item,$usuario);
                echo '<input type="hidden" name = "nuevoAlmacen" value="'.$respuesta["almacen"].'">';
              }

            ?>

            </div>

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-users"></i></span>

                  </div>

                  <select class="form-control form-control-lg" name="nuevoPerfil">

                      <option value="">Selecionar perfil</option>

                      <option value="Administrador">Administrador</option>

                      <option value="Vendedor">Vendedor</option>

                      <option value="Gerente General">Gerente General</option>

                  </select>

              </div>

            </div>

          </div>

          <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php
            $crearAlmacen = new ControladorUsuarios();
            $crearAlmacen->ctrCrearUsuario();
          ?>

      </form>

    </div>

  </div>

</div>

<div class="modal fade" id="modalEditarUsuario">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Editar Usuario</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post" autocomplete="off">

        <div class="modal-body">

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" id="editarNombre" name="editarNombre" value="" required>

          </div>

          <div class="row">

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-key"></i></span>

                  </div>

                  <input type="text" class="form-control form-control-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

              </div>

            </div>

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-lock"></i></span>

                  </div>

                  <input type="password" class="form-control form-control-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                  <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <div class="col-md-6">

            <?php

              $usuario = $_SESSION["perfil"];

              if ($usuario == "Gerente General")
              {
                  echo '
                  <!-- ENTRADA PARA EL ALMACEN -->

                 <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-text"><i class="fa fa-building"></i></span>

                    <input type="text" class="form-control form-control-lg" id="editarAlmacen" name="editarAlmacen" value="" required="">

                  </div>

                </div>';
              }
            ?>

            </div>

            <div class="col-md-6">

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text"><i class="fas fa-users"></i></span>

                  </div>

                  <select class="form-control form-control-lg" name="editarPerfil">

                    <option value="" id="editarPerfil"></option>

                    <option value="Administrador">Administrador</option>

                    <option value="Especial">Especial</option>

                    <option value="Vendedor">Vendedor</option>

                  </select>

              </div>

            </div>

          </div>

          <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php
            $crearAlmacen = new ControladorUsuarios();
            $crearAlmacen->ctrEditarUsuario();
          ?>

      </form>

    </div>

  </div>

</div>
