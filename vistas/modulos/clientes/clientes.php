<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administrar Clientes</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <a href="clientes-nuevo" class="btn btn-block btn-primary"><i class="fa fa-fw fa-plus"></i>Agregar Nuevo</a>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <table class="table table-bordered table-hover tablaClientes">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th>Código postal</th>
              <th>T. Casa</th>
              <th>T. Celular</th>
              <th>Ciudad</th>
              <th>Edad</th>
              <th>Acciones</th>
            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="modalEditarCliente">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Editar Cliente</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post">

        <div class="modal-body">

          <div class="row">

              <div class="col-md-6">

                <label class="label-style" for="nombre">Nombre completo</label>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                      <span class="input-group-text" onclick="getFocus('nombre')"><i class="fas fa-user"></i></span>

                    </div>

                    <input type="text" id="nombre" name="nombre" placeholder="Nombres y Apellido" class="form-control form-control-lg capitalize" required>
                    <input type="hidden" name="id_cliente" id="id_cliente">

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="direccion">Dirección</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('direccion')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="form-control form-control-lg capitalize" required>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <label class="label-style" for="edad">Edad</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('edad')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="number" min="18" max="99" id="edad" name="edad" placeholder="Edad" class="form-control form-control-lg" required>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="t_casa">Teléfono de casa</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('t_casa')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="tel" id="t_casa" name="t_casa" placeholder="Teléfono de casa" class="form-control form-control-lg" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <label class="label-style" for="t_celular">Teléfono celular</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('t_celular')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="tel" id="t_celular" name="t_celular" placeholder="Teléfono celular" class="form-control form-control-lg" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

                    </div>

                  </div>

                </div>

              </div>

              <div class="col-md-6">

                <div class="row">

                  <div class="col-md-6">

                    <label class="label-style" for="codigo_postal">Código postal</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('codigo_postal')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Código postal" class="form-control form-control-lg" maxlength="5" data-inputmask="'mask':'99999'" data-mask required>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <label class="label-style" for="ciudad">Ciudad</label>

                    <div class="input-group mb-3">

                        <div class="input-group-prepend">

                          <span class="input-group-text" onclick="getFocus('ciudad')"><i class="fas fa-user"></i></span>

                        </div>

                        <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" class="form-control form-control-lg capitalize" required>

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
          $editarCliente = new ControladorClientes();
          $editarCliente->ctrEditarCliente();
        ?>

      </form>

    </div>

  </div>

</div>

<?php
  $eliminarCliente = new ControladorClientes();
  $eliminarCliente->ctrEliminarCliente();
?>