<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Abonar</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="card-body">
        <table class="table table-bordered table-striped dt-responsive tablaAlmacen">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>ubicacion</th>
              <th>estado</th>
              <th>acciones</th>
            </tr>

          </thead>


        </table>

      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="modalAgregarAlmacen">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Agregar Almacen</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post">

        <div class="modal-body">

          <label class="label-style" for="nuevoAlmacen">Nombre de almacen</label>

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text" onclick="getFocus('nuevoAlmacen')"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" id="nuevoAlmacen" name="nuevoAlmacen" placeholder="Ingrese Nombre" required>

          </div>

          <label class="label-style" for="nuevaUbicacion">Ubicacion</label>

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text" onclick="getFocus('nuevaUbicacion')"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" id="nuevaUbicacion" name="nuevaUbicacion" placeholder="Ubicacion" required>

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php
            $crearAlmacen = new ControladorAlmacen();
            $crearAlmacen->ctrAgregarAlmacen();
          ?>

      </form>

    </div>

  </div>

</div>

<div class="modal fade" id="modalEditarAlmacen">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Editar Almacen</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post">

        <div class="modal-body">

          <label class="label-style" for="editarAlmacen">Nombre de almacen</label>

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text" onclick="getFocus('editarAlmacen')"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" name="editarAlmacen" id="editarAlmacen" required>
              <input type="hidden" name="id_almacen" id="id_almacen">

          </div>

          <label class="label-style" for="editarUbicacion">Ubicacion</label>

          <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text" onclick="getFocus('editarUbicacion')"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg capitalize" name="editarUbicacion" id="editarUbicacion" required>

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php
            $crearAlmacen = new ControladorAlmacen();
            $crearAlmacen->ctrEditarAlmacen();
          ?>

      </form>

    </div>

  </div>

</div>