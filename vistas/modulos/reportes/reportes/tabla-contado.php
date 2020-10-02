<div id="tabla_contado" style="display: none">
    
    <div class="row">

        <div class="col-md-6">

            <div class="card">

                <div class="card-body">                    

                    <div class="row">

                        <div class="col-md-6">

                            <label>Fecha Inicial: </label>

                            <div class="input-group mb-3 pull-left">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                </div>

                               <input type="date" class="form-control" id="fechaInicialContado">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <label>Fecha Final: </label>

                            <div class="input-group mb-3 pull-left">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" onclick="getFocus('nombre')"><i class="fa fa-calendar"></i></span>

                                </div>

                               <input type="date" class="form-control" id="fechaFinalContado"> 

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-3 caja-contado">

            <div class="card" style="min-height: 126px;">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12" style="display: flex">
                            <strong>Fecha actual: </strong><p style="margin-left: 15px;"><?php echo date('Y-m-d')?></p>
                        </div>

                        <div class="col-md-12" style="display: flex">
                            <strong>Total: </strong><p style="margin-left: 15px;" id="total-contado"></p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" id="imprimir-ventas-contado">Imprimir</button>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-bordered table-hover tablaContado">
        <thead>
            <tr>
                <th style="width: 25px">#</th>
                <th>Folio venta</th>
                <th>Cliente</th>
                <th>Direccion</th>
                <th>Num. Telefono</th>
                <th>Articulos</th>
                <th>Fecha</th>
                <th>Total venta</th>
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="modalVerProductos">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Productos de venta</h4>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

        <div class="modal-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Existencia</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="body-table-products">
                    
                </tbody>
            </table>
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

        </div>

    </div>

  </div>

</div>