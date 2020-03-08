<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear descuentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Crear descuentos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-xs-12">
                <div class="card">
                    <form role="form" method="post" id="frmDescuentos" class="formularioDescuentos">
                        <div class="card-header with-border margin-sale">
                            <div class="margin-dis">
                                <h5 class="name-user">Especial: </h5>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <button type="button" class="btn btn-info">Toda la tienda</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id"]; ?>">
                        <input type="hidden" id="almacenVenta" name="id_almacen" value="<?php echo $_SESSION["almacen"]?>">
                        <div class="card-body">
                            <div id="tableScroll">
                                <table class="table table-bordered table-striped dt-responsive no-footer nuevoProducto" style="width: 480px;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting" colspan="1" style="width: 10px;">E</th>
                                        <th class="sorting" colspan="1" style="width: 130px;">Producto</th>
                                        <th class="sorting" colspan="1" style="width: 30px;">Precio</th>
                                        <th class="sorting" colspan="1" style="width: 30px;">Stock</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="listaProductos" name="listaProductos">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Descuento:</span>
                                        </div>
                                        <input type="number" min="1" max="99" step="any" class="form-control" id="porcentaje" name="porcentaje" placeholder="Porcentaje" required autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="descuentos" class="btn btn-danger pull-left">Cancelar</a>
                            <button type="submit" class="btn btn-success pull-right">Guardar</button>
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
                        <table class="table table-bordered table-striped dt-responsive tablaProductos">
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
//$CrearVenta = new ControladorVentas();
//$CrearVenta->ctrCrearVenta();
?>
