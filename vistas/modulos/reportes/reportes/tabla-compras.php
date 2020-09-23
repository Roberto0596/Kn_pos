<?php 
    $proveedores = ControladorProveedores::ctrMostrarProveedores(null,null);
 ?>
<div id="tabla-compras" style="display: none">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-12">

                        <select class="form-control capitalize form-control-lg" id="provider-pro" style="width: 100%">

                          <option value=""># proveedor</option>

                          <?php  foreach($proveedores as $value): ?>

                              <option value="<?= $value['Id_proveedor'] ?>"><?= $value['Nombre'] ?></option>

                          <?php endforeach?>

                        </select>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 ocultar" style="display: none">
          <div class="card">
            <div class="card-body">

                <div class="row">
                    
                    <div class="col-md-3">
                        <p><strong>Ejecutivo: </strong>
                            <div id="ejecutivo"></div>
                        </p>
                    </div>

                    <div class="col-md-3">
                        <p><strong>Cuenta: </strong>
                            <div id="cuenta"></div>
                        </p>
                    </div>

                    <div class="col-md-6">

                        <div class="row">

                            <div class="col-md-6">

                                <label>Fecha Inicial: </label>

                                <div class="input-group mb-3 pull-left">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                    </div>

                                   <input type="date" class="form-control" id="fechaInicialProveedores" value="none">

                                </div>

                            </div>

                            <div class="col-md-6">

                                 <label>Fecha Final: </label>

                                <div class="input-group mb-3 pull-left">

                                    <div class="input-group-prepend">

                                        <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                    </div>

                                   <input type="date" class="form-control" id="fechaFinalProveedores" value="none"> 

                                </div>

                            </div>

                        </div>                            

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <label>Compras: </label>
                        <div class="input-group mb-3 pull-left">

                           <select id="compras-realizadas" class="form-control">
                               
                           </select> 

                        </div>

                    </div>

                    <div class="col-md-2" style="display: flex">
                        <strong>Fecha: </strong><br><p style="margin-left: 15px;" id="fecha"></p>
                    </div>

                    <div class="col-md-2" style="display: flex">
                        <strong>Monto: </strong><br><p style="margin-left: 15px;" id="monto"></p>
                    </div>

                </div>
                    
            </div>
          </div>
        </div>
    </div>

    <table class="table tableProveedor table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 25px">#</th>
                <th>Folio</th>
                <th>Proveedor</th>
                <th>Ejecutivo</th>
                <th>Fecha</th>
                <th>Articulo</th>
                <th>Unidades</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
    </table>

</div>

<script src="vistas/js/reportes-compras.js"></script>