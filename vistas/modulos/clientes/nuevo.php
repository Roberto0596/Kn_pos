<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nuevo Cliente</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="clientes">Clientes</a></li>
            <li class="breadcrumb-item active">Crear Cliente</li>
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

              <label class="label-style" for="nombre">Nombre completo</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fas fa-user"></i></span>

                  </div>

                  <input type="text" id="nombre" name="nombre" placeholder="Nombres y Apellido" class="form-control form-control-lg capitalize" required>
                  <input type="hidden" name="tipo" value="0">

              </div>

            </div>

            <div class="col-md-6">

              <div class="row">

                <div class="col-md-12">

                  <label class="label-style" for="direccion">Dirección</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('direccion')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="form-control form-control-lg capitalize" required>

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

                <div class="col-md-4">

                  <label class="label-style" for="edad">Edad</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('edad')"><i class="fas fa-user"></i></span>

                      </div>

                      <input type="number" min="18" max="99" id="edad" name="edad" placeholder="Edad" class="form-control form-control-lg" required>

                  </div>

                </div>

                <div class="col-md-8">

                  <label class="label-style" for="ciudad">Ciudad</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('ciudad')"><i class="fas fa-user"></i></span>

                      </div>

                      <select class="form-control form-control-lg" id="ciudad" name="ciudad" required>

                      </select>

                  </div>

                </div>

              </div>

            </div>

            <div class="col-md-12">

              <div class="row">

                <div class="col-md-6">

                  <label class="label-style" for="codigo_postal">Código postal</label>

                  <div class="input-group mb-3">

                      <select class="form-control form-control-lg select2" id="codigo_postal" name="codigo_postal" required>

                      </select>

                  </div>

                </div>

                <div class="col-md-6">

                  <label class="label-style" for="codigo_postal">Colonia</label>

                  <div class="input-group mb-3">

                      <select class="form-control form-control-lg select2" id="asentamiento" name="asentamiento" readonly required>

                      </select>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="card-footer">

          <div class="row">

            <div class="col-md-6">

              <button type="button" destino="clientes" class="btn btn-block btn-danger float-left cancelar">
                <i class="fa fa-fw fa-plus"></i> Cancelar
              </button>

            </div>

            <div class="col-md-6">

              <button type="submit" class="btn btn-block btn-success float-right">
                <i class="fa fa-fw fa-plus"></i> Guardar
              </button>

            </div>

          </div>

        </div>

        <?php
          $crearCliente = new ControladorClientes();
          $crearCliente->ctrCrearCliente();
        ?>

      </form>

    </div>

  </section>

</div>