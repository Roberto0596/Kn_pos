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

    </div>

    <table class="table table-bordered table-hover tablaContado">
        <thead>
            <tr>
                <th style="width: 25px">#</th>
                <th>Folio venta</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Descuento</th>
                <th>Total venta</th>
                <th>Tipo abono</th>
            </tr>
        </thead>
    </table>
</div>