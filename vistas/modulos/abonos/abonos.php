<?php
$clientes = ControladorClientes::ctrMostrarClientesCredito("1");
?>
<form role="form" method="post" id="frmCobro" class="formularioAbono">
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
        <input type="hidden" name="abonosActuales" id="abonosActuales">
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
      </div>

    </div>

  </section>

</div>

<div class="modal fade" id="modalCobro">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Abonar</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

        <div class="modal-body">

          <label class="label-style" for="nCredito">Crédito</label>

          <div class="input-group mb-3">

              <input type="text" class="form-control form-control-lg" id="nCredito" name="nCredito" readonly required>

          </div>

          <label class="label-style" for="efectivo">Efectivo</label>

          <div class="input-group mb-3">


              <input type="text" class="form-control form-control-lg capitalize" id="efectivo" name="efectivo" placeholder="Efectivo" required>

          </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">Liquidar</button>
          <button type="submit" class="btn btn-primary">Abonar</button>

        </div>

        <?php
            //$crearAlmacen = new ControladorAlmacen();
            //$crearAlmacen->ctrAgregarAlmacen();
          ?>

    </div>

  </div>

</div>
</form>