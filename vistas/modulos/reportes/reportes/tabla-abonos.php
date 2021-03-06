<div id="tabla-abonos">

    <div class="row">

        <div class="col-md-3">

            <div class="card">

                <div class="card-body"> 

                    <label>¿Que desea hacer?</label>
            
                    <div class="input-group mb-3">

                        <select class="form-control capitalize" id="concepto-abonos">

                          <option value="0">Corte diario de abonos</option>
                          <option value="1">Rango de fechas</option>
                          <option value="2">Abonos por cliente</option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4 hide-element" style="display: none">

            <div class="card">

                <div class="card-body"> 

                    <label>Seleccione un cliente: </label>
            
                    <div class="input-group mb-3" id="cliente">

                        <select class="form-control capitalize select2" id="abonos-cliente">

                          <option value=""># cliente</option>

                          <?php  foreach($clientes as $value): ?>

                            <?php if($value["id_cliente"]!=1):?>

                              <option value="<?= $value['id_cliente'] ?>"><?= $value['nombre'] ?></option>

                            <?php endif ?>

                          <?php endforeach?>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-5 hide-element" style="display: none">

            <div class="card">

                <div class="card-body">                    

                    <label>Seleccione la venta: </label>

                    <div class="input-group mb-3 pull-left">

                       <select class="form-control" id="ventas-cliente"></select>                                 
                
                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-6 rango-fechas" style="display: none">

            <div class="card">

                <div class="card-body"> 

                    <div class="row">

                        <div class="col-md-6">

                            <label>Fecha Inicial: </label>

                            <div class="input-group mb-3 pull-left">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                </div>

                               <input type="date" class="form-control" id="fechaInicial">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <label>Fecha Final: </label>

                            <div class="input-group mb-3 pull-left">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                </div>

                               <input type="date" class="form-control" id="fechaFinal"> 

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 caja">

            <div class="card" style="min-height: 126px;">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12" style="display: flex">
                            <strong>Fecha actual: </strong><p style="margin-left: 15px;"><?php echo date('Y-m-d')?></p>
                        </div>

                        <div class="col-md-12" style="display: flex">
                            <strong>Recibido: </strong><p style="margin-left: 15px;" id="total"></p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div id="tabla-abonos-1" style="display: none">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <button class="btn btn-success" id="imprimir-abonos-cliente">Imprimir</button>
                </div>
            </div>
        </div>
        <br>
        <table class="table tablaAbonos table-bordered table-hover" id="tablaAbonos" >
            <thead>
                <tr>
                    <th style="width: 25px">#</th>
                    <th>Folio venta</th>
                    <th>Folio pago</th>
                    <th>Fecha de vencida</th>
                    <th>Fecha de pago</th>
                    <th>Fecha Prox. pago</th>
                    <th>cantidad</th>
                    <th>Saldo</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="tabla-abonos-2">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <button class="btn btn-success" id="imprimir-abonos-corte">Imprimir</button>
                </div>
            </div>
        </div>
        <br>
        <table class="table tablaCorteAbonos table-bordered table-hover" id="tablaCorteAbonos">
            <thead>
                <tr>
                    <th style="width: 25px">#</th>
                    <th>Folio venta</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Fecha</th>
                    <th>cantidad</th>
                    <th>Saldo</th>
                </tr>
            </thead>
        </table> 
    </div>
    



</div>

<script src="vistas/js/reportes-abonos.js"></script>