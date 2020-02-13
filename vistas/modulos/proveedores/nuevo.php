<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nuevo Proveedor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="proveedores">Proveedores</a></li>
            <li class="breadcrumb-item active">Crear Proveedor</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">

    <div class="card">

      <form method="post">

        <div class="card-body">

          <div class="row">

            <div class="col-md-6">

              <label class="label-style" for="nombre">Nombre</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fas fa-truck"></i></span>

                  </div>

                  <input type="text" name="nombre" id="nombre" placeholder="Nombre del proveedor" class="form-control form-control-lg capitalize" required>
                  <input type="hidden" name="estado" value="1">

              </div>

            </div>

            <div class="col-md-6">

              <div class="row">

                <div class="col-md-6">

                  <label class="label-style" for="direccion">Dirección</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('direccion')"><i class="fas fa-address-card"></i></span>

                      </div>

                      <input type="text" name="direccion" id="direccion" placeholder="Dirección" class="form-control form-control-lg capitalize" required>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="rfc">RFC</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('rfc')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="rfc" id="rfc" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="RFC" class="form-control form-control-lg" required>

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

                      <input type="number" name="telefono" id="telefono" placeholder="Teléfono" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="ejecutivo">Ejecutivo</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('ejecutivo')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" name="ejecutivo" id="ejecutivo" placeholder="Nombre del ejecutivo" class="form-control form-control-lg" required>

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

                      <input type="email" name="correo" id="correo" placeholder="Correo electronico" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-6">
                  <label class="label-style" for="cuenta_bancaria">Cuenta bancaria</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text" onclick="getFocus('cuenta_bancaria')">
                          <i class="fas fa-money-check-alt"></i></span>
                      </div>
                      <input type="text" id="cuenta_bancaria" name="cuenta_bancaria" placeholder="Cuenta bancaria" class="form-control form-control-lg capitalize" required>
                  </div>
              </div>

              </div>

            </div>
              <div class="col-md-6">
                <div class="row">

                    <div class="col-md-6">
                        <label class="label-style" for="categoria">Categoría</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" onclick="getFocus('categoria')">
                                <i class="fas fa-truck-loading"></i></span>
                            </div>
                            <input type="text" id="categoria" name="categoria" placeholder="Categoría" class="form-control form-control-lg" required>
                        </div>
                    </div>

                </div>
            </div>

          </div>

        </div>

        <div class="card-footer">

          <div class="row">

            <div class="col-md-6">

              <a href="proveedores" class="btn btn-block btn-danger float-left">
                <i class="fa fa-fw fa-plus"></i> Cancelar
              </a>

            </div>

            <div class="col-md-6">

              <button type="submit" class="btn btn-block btn-success float-right">
                <i class="fa fa-fw fa-plus"></i> Guardar
              </button>

            </div>

          </div>

        </div>

        <?php
        include_once "controladores/proveedores.controlador.php";
        $crearProveedor = new ControladorProveedores();
        $crearProveedor->ctrCrearProveedor();
        ?>

      </form>

    </div>

  </section>

</div>