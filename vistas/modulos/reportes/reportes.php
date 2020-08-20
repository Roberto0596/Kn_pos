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

                <select id="select-concepto" class="form-control capitalize">
                  
                  <option value="abonos">Abonos</option>
                  <option value="credito">Ventas Credito</option>
                  <option value="contado">Ventas Contado</option>
                  <option value="abonos-atrasados">Abonos atrasados</option>
                  <option value="compras">Compras</option>

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

          <?php include "reportes/tabla-abonos.php" ?>
          <?php include "reportes/tabla-retrasos.php" ?>
          <?php include "reportes/tabla-compras.php" ?>
          <?php include "reportes/tabla-contado.php" ?>
          <?php include "reportes/ventas.php" ?>

      </div>

    </div>

  </section>

</div>
