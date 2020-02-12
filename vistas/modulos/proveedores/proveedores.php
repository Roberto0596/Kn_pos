<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administrar Proveedores</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <a href="proveedores-nuevo" class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus"></i>Agregar Nuevo</a>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <table class="table table-bordered table-hover tablaProveedores">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>RFC</th>
              <th>Teléfono</th>
              <th>Ejecutivo</th>
              <th>Correo</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="modalEditarProveedor">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Editar Proveedor</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post">

        <div class="modal-body">

          <div class="row">

              <div class="col-md-6">

                <label class="label-style" for="nombre">Nombre</label>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                      <span class="input-group-text" onclick="getFocus('nombre')"><i class="fas fa-truck"></i></span>

                    </div>

                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control form-control-lg capitalize" required>
                    <input type="hidden" name="id_proveedor" id="id_proveedor" value="">

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="direccion">Direccion</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('direccion')">
                          <i class="fas fa-address-card"></i>
                          </span>

                        </div>

                        <input type="text" id="direccion" name="direccion" placeholder="Direccion" class="form-control form-control-lg capitalize" required>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <label class="label-style" for="rfc">RFC</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('rfc')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="text" id="rfc" name="rfc" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="RFC" class="form-control form-control-lg" required>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="telefono">Teléfono</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('telefono')"><i class="fas fa-phone"></i></span>

                        </div>

                        <input type="number" id="telefono" name="telefono" placeholder="Teléfono" class="form-control form-control-lg" required>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <label class="label-style" for="ejecutivo">Ejecutivo</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('ejecutivo')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="text" id="ejecutivo" name="ejecutivo" placeholder="Nombre completo" class="form-control form-control-lg" required>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="correo">Correo</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('correo')"><i class="fas fa-at"></i></span>

                        </div>

                        <input type="email" id="correo" name="correo" placeholder="Correo electronico" class="form-control form-control-lg" required>

                    </div>

                  </div>

                </div>

              </div>

            </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

        $editarProveedor = new ControladorProveedores();
        $editarProveedor->ctrEditarProveedor();
        ?>

      </form>

    </div>

  </div>

</div>

<?php
  $eliminarProveedor = new ControladorProveedores();
  $eliminarProveedor->ctrEliminarProveedor();
?>