<div id="tabla-retrasos" style="display: none">

<!--     <div class="row select-ventas-credito-cliente" style="display: none">

        <div class="col-md-4">

            <div class="card">

                <div class="card-body">                    

                    <label>Seleccione la venta: </label>

                    <div class="input-group mb-3 pull-left">

                       <select class="form-control" id="ventas-credito-cliente"></select>                                 
                
                    </div>

                </div>

            </div>

        </div>

    </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <button class="btn btn-success" id="imprimir-abonos-retrasos">Imprimir</button>
            </div>
        </div>
    </div>
    <br>
    <table class="table table-bordered table-hover tableRetrasos">
        <thead>
            <tr>
                <th style="width: 25px">#</th>
                <th>Nombre</th>
                <th>Folio</th>
                <th>Abono</th>
                <th>F. Vencimiento</th>
                <th>Fecha de hoy</th>
                <th>Fecha Prox. pago</th>
<!--                 <th>Acciones</th>
 -->            </tr>
        </thead>
    </table>
</div>

<script src="vistas/js/reportes-atrasos.js"></script>