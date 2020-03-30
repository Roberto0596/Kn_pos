<?php
$clientes = ControladorClientes::ctrMostrarClientesCredito("1");
?>
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
      <form role="form" method="post" id="frmCobro" class="formularioAbono">
      <div class="input-group">
        <span class="input-group-text"><i class="fa fa-users"></i></span>
        <select class="form-control col-md-5" id="seleccionarCliente" name="id_cliente" required>
          <option></option>
          <?php if (isset($clientes)): ?>
            <?php foreach($clientes as $key => $value): ?>
                <option value="<?= $value['id_cliente'] ?>"><?= $value["nombre"] ?>. NUM <?= $value['id_cliente'] ?></option>
            <?php endforeach ?>
          <?php endif ?>
        </select> <span class="input-group-text"><i class="fa fa-users"></i></span>
        <select class="form-control col-md-3" id="seleccionarCredito" name="nCredito" required>
          <option></option>
        </select>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="card datosClienteH" style="visibility: hidden;">
            <div class="card-body datosCliente">

            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card conceptoCompra"  style="visibility: hidden;">
            <div class="card-body">
              <p><strong>Concepto: </strong>
                <div id="conceptoCompra"></div>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row datosCredito">
      </div>
        <div class="row m-2 tablaAbonosD">
        <input type="hidden" name="folioCompra" id="folioCompra">
        <table class="table table-bordered table-striped dt-responsive table-hover tablaAbonos">
          <thead>
            <tr role="row">
              <th class="sorting" colspan="1" style="width: 10px;">#</th>
              <th class="sorting" colspan="1" style="width: 60px;">Vencimiento</th>
              <th class="sorting" colspan="1" style="width: 30px;">Folio de pago</th>
              <th class="sorting" colspan="1" style="width: 60px;">Fecha de pago</th>
              <th class="sorting" colspan="1" style="width: 30px;">Cantidad</th>
              <th class="sorting" colspan="1" style="width: 30px;">Saldo</th>
              <th class="sorting" colspan="1" style="width: 30px;">Abonar</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>

        </div>
        <button class='btn btn-primary pull-right' title="Cobrar" type="submit">Abonar</button>
        </form>
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