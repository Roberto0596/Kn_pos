<?php
  $nuevoFolio = Helpers::NuevoFolio();
?>

<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Crear Venta</h1>

        </div>

        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Venta</li>
          </ol>
        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-5 col-xs-12">

        <div class="card">

          <form role="form" method="post" id="frmCobro" class="formularioVenta">

            <div class="card-header with-border margin-sale">


              <div class="margin-dis">
              <input type="hidden" id="nuevaVenta" name="nuevaVenta" value="<?php echo $nuevoFolio; ?>" >
                <h5 class="name-user">Folio de venta: </h5>
                <h5 class="code-sale">
                  <?= $nuevoFolio ?>
                </h5>

              </div>

            </div>

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id"]; ?>">

            <input type="hidden" id="almacenVenta" name="id_almacen" value="<?php echo $_SESSION["almacen"]?>">

            <div class="card-body">
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-users"></i></span>
                <select class="form-control traerProducto col-md-8" id="seleccionarCliente" name="id_cliente" required>
                  <option></option>
                  <?php
                    $clientes = ControladorClientes::ctrMostrarClientes(null,null,0);
                    foreach ($clientes as $key => $value)
                    {
                      if($value["id_cliente"] > 1)
                        echo '<option value="'.$value["id_cliente"].'">'.$value["nombre"].'</option>';
                    }
                  ?>
                </select>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info tipoCompra">Crédito</button>
                </span>
                <input type="hidden" id="seleccionarClienteH" class="seleccionarCliente" name="id_cliente" value="1" disabled="true">
              </div>
            <div id="tableScroll">
              <table class="table table-bordered table-striped dt-responsive no-footer nuevoProducto" style="width: 480px;">
                <thead>
                  <tr role="row">
                    <th class="sorting" colspan="1" style="width: 10px;">E</th>
                    <th class="sorting" colspan="1" style="width: 130px;">Producto</th>
                    <th class="sorting" colspan="1" style="width: 30px;">P.U.</th>
                    <th class="sorting" colspan="1" style="width: 30px;">Cantidad</th>
                    <th class="sorting" colspan="1" style="width: 30px;">Importe</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
              <input type="hidden" id="listaProductos" name="listaProductos">

              <div class="form-group row">
                <div class="col-xs-6 pull-right">
                  <div class="input-group ">
                    <label for="descuentoP" class="col-sm-6 col-form-label">Descuento:</label>
                    <input type="number" max="99" id="descuentoP" name="descuentoP" class="form-control" placeholder="Descuento">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6 pull-right">
                  <div class="input-group ">
                  <label for="primerAbono" class="col-sm-4 col-form-label">Tipo de abonos:</label>
                    <select name="tipoTiempo" id="tipoTiempo" required>
                      <option disabled selected>Tipo de abonos</option>
                      <option value="Semanal">Semanal</option>
                      <option value="Quincenal">Quincenal</option>
                      <option value="Mensual">Mensual</option>
                    </select>
                    <input type="number" min="1" step="any" class="form-control" id="cantidadTiempo" name="cantidadTiempo" placeholder="Cantidad" required autocomplete="off">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6 pull-right">
                  <div class="input-group ">
                    <label for="primerAbono" class="col-sm-6 col-form-label">Fecha de primero pago:</label>
                    <input type="date" id="primerAbono" name="primerAbono" class="form-control" required>
                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-xs-6 pull-right alto">
                  <div class="input-group ">
                    <h5>
                      Descuento $<label value="0" id="descuentoT" name="descuentoT" total="">0</label>
                    </h5>
                    <input type="hidden" name="descuentoTH" id="descuentoTH" value="0">
                  </div>
                </div>
                <div class="col-xs-6 pull-right alto">
                  <div class="input-group ">
                    <h5>
                      Total $<label value="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="">0</label>
                    </h5>
                    <input type="hidden" name="totalVenta" id="totalVenta" value="0">
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                    </div>

                    <input type="number" step="any" class="form-control" id="nuevoValorEfectivo" name="totalPayment" placeholder="Enganche" autocomplete="off">

                  </div>

                </div>

                <div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                    </div>

                    <input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="Cambio" readonly required>

                  </div>

                </div>

              </div>

            </div>

            <div class="card-footer">

              <button type="submit" class="btn btn-primary pull-right">Cobrar</button>

            </div>

          </form>

        </div>

      </div>

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="card">

          <div class="card-header with-border">

            <div class="input-group">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fa fa-dolly"></i></span>

              </div>

                <input type="text" class="form-control codigoBarra" id="codigoDVenta" name="codigoDVenta" placeholder="Producto" autofocus>

            </div>

          </div>

          <div class="card-body">

            <table class="table table-bordered table-striped dt-responsive tablaVentas">

               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Codigo</th>
                  <th>Producto</th>
                  <th>Precio</th>
                  <th>Existencia</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>

      </div>

    </div>

  </section>

</div>

<style>

.dataTables_filter {
  display: none !important;
}

.dataTables_length
{
  display: none !important;
}

</style>

<?php
$CrearVenta = new ControladorVentas();
$CrearVenta->ctrCrearVenta();
?>
