<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Productos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="productos-nuevo" class="btn btn-block btn-primary">
                            <i class="fa fa-fw fa-plus"></i>Agregar Nuevo
                        </a>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover tablaProductos">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Proveedor</th>
                            <th>Stock</th>
                            <th>Ventas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="modalEditarProducto">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="label-style" for="codigo">Código</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" onclick="getFocus('codigo')">
                                    <i class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" id="codigo" name="codigo" placeholder="Código" class="form-control form-control-lg" required>
                                <input type="hidden" name="id_producto" id="id_producto" value="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="label-style" for="nombre">Nombre</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" onclick="getFocus('nombre')">
                                            <i class="fas fa-dolly"></i></span>
                                        </div>
                                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control form-control-lg capitalize" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="label-style" for="precio_compra">Precio de compra</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" onclick="getFocus('precio_compra')">
                                            <i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" id="precio_compra" name="precio_compra" placeholder="Precio de compra" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="label-style" for="precio_venta">Precio de venta</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" onclick="getFocus('precio_venta')">
                                            <i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" id="precio_venta" name="precio_venta" placeholder="Precio de venta" class="form-control form-control-lg" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="label-style" for="idProveedor">Proveedor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" onclick="getFocus('idProveedor')">
                                            <i class="fas fa-truck"></i></span>
                                        </div>
                                        <?php
                                        echo ControladorProductos::traerProveedores();
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    <?php
                    $editarProducto = new ControladorProductos();
                    $editarProducto->ctrEditarProducto();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalModificarStock">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Modificar Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="label-style" for="nombreS">Nombre</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" onclick="getFocus('nombreS')">
                                    <i class="fas fa-dolly"></i></span>
                                </div>
                                <input type="text" id="nombreS" name="nombreS" placeholder="Nombre" class="form-control form-control-lg capitalize" readonly required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">

                            <div class="col-md-6">
                                <label class="label-style" for="stock">Stock</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" onclick="getFocus('stock')">
                                        <i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="number" id="stock" name="stock" placeholder="Cantidad" class="form-control form-control-lg" required>
                                    <input type="hidden" name="id_productos" id="id_productos" value="">
                                </div>
                            </div>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    <?php
                    $editarStock = new ControladorProductos();
                    $editarStock->ctrModificarStock();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
  $eliminarProducto = new ControladorProductos();
  $eliminarProducto->ctrEliminarProducto();
?>