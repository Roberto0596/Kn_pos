<?php 
  
  $clientes = ControladorClientes::ctrMostrarClientes(null,null,0);
  $proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);

?>
<div class="content-wrapper">

  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Reportes</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="#">Home</a></li>

            <li class="breadcrumb-item active">Reportes</li>

          </ol>

        </div>

      </div>

    </div>

  </section>

  <section class="content">

    <div class="card">

      <div class="card-header">

        <div class="row">

          <div class="col-md-3">

            <div class="input-group mb-3">

                <select id="tipo" class="form-control capitalize">

                  <option value="credito">Vendas credito</option>
                  <option value="credito">Vendas contado</option>
                  <option value="compras">Compras</option>

                </select>

            </div>

          </div>

          <div class="col-md-2">
            
            <div class="input-group mb-3 abonos">

                <select id="nombre" class="form-control capitalize">

                  <option value="abonos">Abonos</option>

                </select>

            </div>

          </div>

          <div class="col-md-3">
            
            <div class="input-group mb-3 cliente">

                <select class="form-control capitalize select2" id="client" >

                  <option value=""># cliente</option>

                  <?php  foreach($clientes as $value): ?>

                    <?php if($value["id_cliente"]!=1):?>

                      <option value="<?= $value['id_cliente'] ?>"><?= $value['nombre'] ?></option>

                    <?php endif ?>

                  <?php endforeach?>

                </select>

            </div>

            <div class="input-group mb-3 proveedor">

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

              <button class="btn btn-success" id="generar">Generar</button>

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
          <?php include "reportes/tabla-proveedor.php" ?>
      </div>

    </div>

  </section>

</div>
