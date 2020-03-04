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

                <h5 class="name-user"><?php echo $_SESSION["nombre"];?></h5>

                <h5 class="code-sale">
                  <?= $nuevoFolio ?>
                  <input type="hidden" id="nuevaVenta" name="nuevaVenta" value="<?php echo $nuevoFolio; ?>" >

                </h5>

              </div>

            </div>

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id"]; ?>">

            <input type="hidden" id="almacenVenta" name="id_almacen" value="<?php echo $_SESSION["almacen"]?>">

            <div class="card-body">

              <div class="input-group">

                <div class="input-group-prepend">

                  <span class="input-group-text"><i class="fa fa-users"></i></span>

                </div>

                <select class="form-control traerProducto" id="seleccionarCliente" name="id_cliente" required>
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

                <span class="input-group-addon">
                  <button type="button" class="btn btn-info tipoCompra">Crédito</button>
                </span>

              </div>
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

              <input type="hidden" id="listaProductos" name="listaProductos">



              <div class="row">

                <div class="col-xs-6 pull-right alto">

                  <table class="table table-p">

                    <tbody>

                      <tr>

                        <td class="size-td">

                            <h4 class="letter-type">

                              <label for="total">Total</label>

                            </h4>

                        </td>

                        <td class="size-td-two">

                          <div class="input-group">

                            <h4>

                              $<label value="0" id="nuevoTotalVenta" name="nuevoTotalVenta" total="">0</label>
                            </h4>

                            <input type="hidden" name="totalVenta" id="totalVenta" value="0">

                          </div>

                        </td>

                      </tr>

                    </tbody>

                  </table>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                    </div>

                    <input type="number" min="1" step="any" class="form-control" id="nuevoValorEfectivo" name="totalPayment" placeholder="Efectivo" required autocomplete="off">

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
