<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="productos">Productos</a></li>
                        <li class="breadcrumb-item active">Crear Producto</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <form method="post">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="label-style" for="codigo">Código</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" onclick="getFocus('codigo')">
                                    <i class="fas fa-barcode"></i></span>
                                </div>
                                <input type="text" id="codigo" name="codigo" placeholder="Código del producto" class="form-control form-control-lg capitalize" required>
                                <input type="hidden" name="estado" value="1">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="label-style" for="direccion">Nombre</label>
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
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="productos" class="btn btn-block btn-danger float-left">
                                <i class="fa fa-fw fa-plus"></i> Cancelar
                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block btn-success float-right">
                                <i class="fa fa-fw fa-plus"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
                <?php
                include_once "controladores/productos.controlador.php";
                $crearProducto = new ControladorProductos();
                $crearProducto->ctrCrearProducto();
                ?>
            </form>
        </div>
    </section>
</div>