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
        <input type="hidden" name="nAbono" id="nAbono">
        <input type="hidden" name="ultimoSaldo" id="ultimoSaldo">
        <input type="hidden" name="descuentoTotal" id="descuentoTotal">
        <input type="hidden" name="fechaVence" id="fechaVence">
        <input type="hidden" name="fechaProximo" id="fechaProximo">
        <table class="table table-bordered table-striped dt-responsive table-hover tablaAbonos">
          <thead>
            <tr role="row">
              <th class="sorting" colspan="1" style="width: 10px;">#</th>
              <th class="sorting" colspan="1" style="width: 60px;">Vencimiento</th>
              <th class="sorting" colspan="1" style="width: 30px;">Folio de pago</th>
              <th class="sorting" colspan="1" style="width: 60px;">Fecha de pago</th>
              <th class="sorting" colspan="1" style="width: 30px;">Cantidad</th>
              <th class="sorting" colspan="1" style="width: 30px;">Abonar</th>
              <th class="sorting" colspan="1" style="width: 30px;">Saldo</th>
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

          <label class="label-style">Crédito <span id="nCreditoS"></span> | Saldo actual $<span id="saldoActual"></span></label><br />
          <div class="oculto" style="visibility: hidden;">
            <label class="label-style" for="descuentoP">Descuento</label>
            <div class="input-group">
              <input type="number" max="99" id="descuentoP" name="descuentoP" class="form-control" placeholder="Descuento" pattern="^[0-9]+" min="0" disabled>
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-percent"></i></span>
              </div>
          </div>
          </div>
          <label class="label-style" for="abono">Abono</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
            </div>
            <input type="text" class="form-control" id="abono" name="abono" placeholder="Abono" required>
          </div>

          <label class="label-style" for="efectivo">Efectivo</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
            </div>
            <input type="number" pattern="^[0-9]+" min="0" step="any" class="form-control" id="efectivo" name="efectivo" placeholder="Efectivo" autocomplete="off" required>
          </div>

          <label class="label-style" for="cambio">Cambio</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
            </div>
            <input type="text" class="form-control" id="cambio" name="cambio" placeholder="0" readonly required>
          </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary btnCambiar">Liquidar</button>
          <button type="submit" class="btn btn-primary">Pagar</button>

        </div>

        <?php
            $crearAbono = new ControladorAbonos();
            $crearAbono->ctrRegistrarAbono();
            //print_r($_POST);
          ?>

    </div>

  </div>

</div>
</form>