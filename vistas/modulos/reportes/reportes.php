<?php 
  
  $clientes = ControladorClientes::ctrMostrarClientes(null,null,0);
  $proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);
?>

<div class="content-wrapper">

  <section class="content">

    <div class="card">

      <div class="card-header">

        <div class="row">

          <div class="col-md-3">

            <div class="input-group mb-3">

                <select id="concepto" class="form-control capitalize">

                  <option value="credito">Vendas Credito</option>
                  <option value="contado">Vendas Contado</option>
                  <option value="compras">Compras</option>
                  <option value="ventas">Ventas General</option>

                </select>

            </div>

          </div>

          <div class="col-md-2" id="abonos">
            
            <div class="input-group mb-3">

                <select id="select-modalidad" class="form-control capitalize">

                  <option value="abonos">Abonos</option>
                  <option value="vencidos">Vencidos</option>

                </select>

            </div>

          </div>

          <div class="col-md-3">
            
            <div class="input-group mb-3" id="cliente">

                <select class="form-control capitalize select2" id="credito-abono-cliente" >

                  <option value=""># cliente</option>

                  <?php  foreach($clientes as $value): ?>

                    <?php if($value["id_cliente"]!=1):?>

                      <option value="<?= $value['id_cliente'] ?>"><?= $value['nombre'] ?></option>

                    <?php endif ?>

                  <?php endforeach?>

                </select>

            </div>

            <div class="input-group mb-3" id="proveedor" style="display: none;">

                <select class="form-control capitalize select2" id="provider" >

                  <option value=""># proveedor</option>

                  <?php  foreach($proveedores as $value): ?>

                      <option value="<?= $value['Id_proveedor'] ?>"><?= $value['Nombre'] ?></option>

                  <?php endforeach?>

                </select>

            </div>

          </div>

          <div class="col-md-2">

            <div class="btn-group">

              <button class="btn btn-info" id="generar">Imprimir</button>

            </div>

          </div>

        </div>

      </div>

      <div class="card-body">

          <?php include "reportes/tabla-credito.php" ?>
          <?php include "reportes/tabla-retrasos.php" ?>
          <?php include "reportes/tabla-proveedor.php" ?>
          <?php include "reportes/tabla-contado.php" ?>
          <?php include "reportes/ventas.php" ?>

      </div>

    </div>

  </section>

</div>
