<?php

  if (isset($_GET["compra"]))
  {
    $proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);
    $folioTag = "Folio de compra: ";
    $buttonTag = "Comprar";
    $altoTag = "height: 325px;";
    $nuevoFolio = Helpers::NuevoFolio("compra");
  }
  else
  {
    $clientes = ControladorClientes::ctrMostrarClientes(null,null,0);
    $folioTag = "Folio de venta: ";
    $buttonTag = "Cobrar";
    $altoTag = "height: 200px;";
    $nuevoFolio = Helpers::NuevoFolio("venta");
  }
  date_default_timezone_set('America/Hermosillo');
?>

<div class="content-wrapper">

  <form role="form" method="post" id="frmCobro" class="formularioVenta">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-4">

          <h1>
            <?php if(isset($_GET["compra"])): ?>
              Compra a proveedor
            <?php else: ?>
              Crear Venta
            <?php endif ?>
          </h1>

        </div>

        <div class="col-sm-8">

          <?php if(isset($_GET["compra"])): ?>

            <div class="pull-right">

              <div class="row">

                <div class="col-md-4">

                  <div class="input-group">

                    <span class="input-group-text"><i class="nav-icon fas fa-calendar"></i></span>

                    <input type="date" name="fecha" class="form-control" value='<?php echo date("Y-m-d");?>'>

                  </div>

                </div>

                <div class="col-md-4">

                  <div class="input-group">

                    <span class="input-group-text"><i class="nav-icon fas fa-truck"></i></span>

                    <select class="form-control" id="idProveedor" name="idProveedor" required>

                      <option value="">Seleccione un proveedor</option>

                      <?php foreach ($proveedores as $key => $value): ?>
                          <option value="<?= $value['Id_proveedor'] ?>"><?= $value['Nombre'] ?></option>
                      <?php endforeach ?>

                    </select>

                  </div>

                </div>

                <div class="col-md-4">

                  <div class="input-group">

                    <button type="button" class="btn btn-primary" id="createProduct" data-toggle="modal" data-target="#modalCrearProducto" disabled>Crear producto</button>

                  </div>

                </div>

              </div>

            </div>

            <?php else: ?>
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                <li class="breadcrumb-item active">Crear Venta</li>
              </ol>
            <?php endif ?>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-5 col-xs-12">

        <div class="card">

            <input type="hidden" name="Id_proveedor" id="Id_proveedor">

            <div class="card-header with-border margin-sale">

              <div class="margin-dis">

                <h5 class="name-user"><?= $folioTag ?></h5>

                <?php if(isset($_GET["compra"])): ?>

                  <div>

                    <input type="text" class="form-control input-xs" name="nuevaVenta" required>

                  </div>

                <?php else : ?>


                    <input type="hidden" id="nuevaVenta" name="nuevaVenta" value="<?php echo $nuevoFolio; ?>">

                  <h5 class="code-sale">

                    <?= $nuevoFolio ?>

                  </h5>

                <?php endif ?>

              </div>

            </div>

            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id"]; ?>">

            <input type="hidden" id="almacenVenta" name="id_almacen" value="<?php echo $_SESSION["almacen"]?>">

            <div class="card-body">

              <?php if (isset($clientes)): ?>

                <div class="input-group ocultar">

                  <span class="input-group-text"><i class="fa fa-users"></i></span>

                  <select class="form-control traerProducto col-md-8" id="seleccionarCliente" name="id_cliente" required>

                    <option></option>

                      <?php foreach($clientes as $key => $value): ?>

                          <option value="<?= $value['id_cliente'] ?>"><?= $value["nombre"] ?>. NUM <?= $value['id_cliente'] ?></option>

                      <?php endforeach ?>

                  </select>

                  <span class="input-group-btn">

                    <button type="button" id="cred" class="btn btn-info tipoCompra">Crédito</button>

                  </span>

                  <input type="hidden" id="tipoVenta" class="tipoVenta" name="tipoVenta" value="0">

                </div>

              <?php endif ?>

              <div id="tableScroll" style="<?= $altoTag ?>">

                <table class="table table-bordered table-striped dt-responsive no-footer nuevoProducto" id="tablaProductos" style="width: 100%;">

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

              <?php if (!isset($_GET["compra"])): ?>

                <div class="form-group row ocultar">
                  <div class="col-xs-6 pull-right">
                  <div class="row">
                  <div class="input-group ">
                      <label for="descuentoP" class="col-sm-8 col-form-label">Descuento:</label>
                      <input type="number" id="descuentoP" name="descuentoP" class="form-control" placeholder="Descuento" pattern="^[0-9]+" min="0">
                      <label for="falioFact" id="folioLabel" class="col-sm-6 col-form-label">CR:</label>
                      <input type="text" id="falioFact" name="falioFact" class="form-control" placeholder="Folio">
                    </div>
                    <div class="input-group ">

                    </div>
                  </div>

                  </div>
                </div>

                <div class="form-group row ocultar">
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

                <div class="form-group row ocultar">
                  <div class="col-xs-6 pull-right">
                    <div class="input-group ">
                      <label for="primerAbono" class="col-sm-6 col-form-label">Fecha de primer pago:</label>
                      <input type="date" id="primerAbono" name="primerAbono" class="form-control" required>
                    </div>
                  </div>
                </div>

              <?php endif ?>

                <div class="row">
                  <?php if (!isset($_GET["compra"])): ?>
                    <div class="col-xs-6 pull-right alto ocultar">
                      <div class="input-group ">
                        <h5>
                          Descuento $<label value="0" id="descuentoT" name="descuentoT" total="">0</label>
                        </h5>
                        <input type="hidden" name="descuentoTH" id="descuentoTH" value="0">
                      </div>
                    </div>
                  <?php endif ?>
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

                    <input type="number" pattern="^[0-9]+" min="0" step="any" class="form-control" id="nuevoValorEfectivo" name="totalPayment" placeholder="Enganche" autocomplete="off">

                  </div>

                </div>

                <div class="col-md-6" id="capturarCambioEfectivo" style="padding-left:0px">

                  <div class="input-group">

                    <div class="input-group-prepend">

                      <span class="input-group-text"><i class="ion ion-social-usd"></i></span>

                    </div>

                    <input type="text" class="form-control" id="nuevoCambioEfectivo" name="cambio" placeholder="Cambio" readonly>

                  </div>

                </div>

              </div>

              <button class="form-control"  title="Cobrar" id="chale" type="submit">Cobrar</button>

            </div>



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
                  <th>Código</th>
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

  <?php
    if(isset($_GET["compra"]))
    {
      $crearCompra = new ControladorCompra();
      $crearCompra->ctrCrearCompra();
    }
  ?>

  </form>

</div>

<div class="modal fade" id="modalCrearProducto">

  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Agregar Producto</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <form method="post" class="crear_producto">

        <div class="modal-body">

          <div class="row">

            <div class="col-md-6">

              <label class="label-style" for="codigo">Código</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                      <span class="input-group-text" onclick="getFocus('codigo')">
                      <i class="fas fa-barcode"></i></span>

                  </div>

                  <input type="text" id="nuevo_codigo_producto" placeholder="Código del producto" class="form-control form-control-lg capitalize" required>

                  <input type="hidden" id="nuevo_estado_producto" name="estado" value="1">

              </div>

            </div>

            <div class="col-md-6">

                <label class="label-style" for="direccion">Nombre</label>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('nombre')">
                        <i class="fas fa-dolly"></i></span>

                    </div>

                    <input type="text" id="nuevo_nombre_producto" placeholder="Nombre" class="form-control form-control-lg capitalize" required>

                </div>

            </div>

            <div class="col-md-6">

                <label class="label-style" for="precio_compra">Precio de compra</label>

                <div class="input-group mb-3">

                    <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('precio_compra')">
                        <i class="fas fa-dollar-sign"></i></span>

                    </div>

                    <input type="number" id="nuevo_precio_compra" placeholder="Precio de compra" class="form-control form-control-lg" required>

                </div>

            </div>

            <div class="col-md-6">

              <label class="label-style" for="precio_venta">Precio de venta</label>

              <div class="input-group mb-3">

                  <div class="input-group-prepend">

                      <span class="input-group-text" onclick="getFocus('precio_venta')">
                      <i class="fas fa-dollar-sign"></i></span>

                  </div>

                  <input type="number" id="nuevo_precio_venta" placeholder="Precio de venta" class="form-control form-control-lg" required>
              </div>

              <div class="row">

                <div class="col-xs-6" style="margin-top: 10px; margin-right: 10px;">

                  <div class="input-group">

                    <label><input type="checkbox" class="minimal porcentaje" checked>Utilizar porcentaje</label>

                  </div>

                </div>

                <div class="col-xs-6" style="padding: 0">

                  <div class="input-group">

                    <input type="number" step="any" id="porcent" class = "form-control form-control-lg nuevoPorcentaje" min="0" value="40">

                    <div class="input-group-prepend">

                        <span class="input-group-text" onclick="getFocus('porcent')">
                        <i class="fa fa-percent"></i></i></span>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" id="guardarProducto" class="btn btn-primary">Guardar</button>

        </div>

      </form>

    </div>

  </div>

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
  if(isset($_GET["compra"]))
  {
    echo '<script src="vistas/js/compra.js"></script>';
  }
  else
  {
    echo '<script src="vistas/js/venta.js"></script>';
    $CrearVenta = new ControladorVentas();
    $CrearVenta->ctrCrearVenta();
  }
?>
