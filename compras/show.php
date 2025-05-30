<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/proveedores/listado_de_proveedores.php');
include('../app/controllers/compras/cargar_compra.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12 d-flex justify-content-between align-items-center">
                <h1 class="m-0">Compra nro <?php echo $nro_compra; ?></h1>
                <a href="index.php" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Volver a compras
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la compra</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="card-body" style="display: block;">
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" hidden>
                                                        <label for="">Código:</label>
                                                        <input type="text" class="form-control" value="<?= $codigo; ?>" id="codigo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoría:</label>
                                                        <div style="display: flex">
                                                            <input type="text" value="<?= $nombre_categoria; ?>" class="form-control" id="categoria" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" name="nombre" value="<?= $nombre_producto; ?>" id="nombre_producto" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Usuario</label>
                                                        <input type="text" value="<?= $nombres_usuario; ?>" class="form-control" id="usuario_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Descripción del producto:</label>
                                                        <textarea name="descripcion" id="descripcio_producto" cols="30" rows="2" class="form-control" disabled><?= $descripcion; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number" value="<?= $stock; ?>" name="stock" id="stock" class="form-control" style="background-color: #fff819" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock mínimo:</label>
                                                        <input type="number" value="<?= $stock_minimo; ?>" name="stock_minimo" id="stock_minimo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock máximo:</label>
                                                        <input type="number" value="<?= $stock_maximo; ?>" name="stock_maximo" id="stock_maximo" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="number" value="<?= $precio_compra_producto; ?>" name="precio_compra" id="precio_compra" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="number" value="<?= $precio_venta_producto; ?>" name="precio_venta" id="precio_venta" class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha de ingreso:</label>
                                                        <input type="date" value="<?= $fecha_ingreso; ?>" name="fecha_ingreso" id="fecha_ingreso" class="form-control" disabled>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del producto</label>
                                                <center>
                                                    <img src="<?php echo $URL . "/almacen/img_productos/" . $imagen; ?>" id="img_producto" width="50%" alt="">
                                                </center>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div style="display: flex">
                                        <h5>Datos del proveedor </h5>
                                    </div>
                                    <hr>

                                    <div class="container-fluid" style="font-size: 12px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="id_proveedor" hidden>
                                                    <label for="">Nombre del proveedor </label>
                                                    <input type="text" value="<?= $nombre_proveedor_tabla; ?>" id="nombre_proveedor_tabla" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Celular</label>
                                                    <input type="number" value="<?= $celular_proveedor; ?>" id="celular" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Teléfono</label>
                                                    <input type="number" value="<?= $telefono_proveedor; ?>" id="telefono" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" value="<?= $email_proveedor; ?>" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <textarea name="" id="direccion" cols="30" rows="3" class="form-control" disabled><?= $direccion_proveedor; ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Detalle de la compra</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Número de la compra</label>
                                                <input type="text" value="<?php echo $id_compra_get; ?>" style="text-align: center" class="form-control" disabled>
                                                <input type="text" value="<?php echo $id_compra_get; ?>" id="nro_compra" hidden>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Fecha de la compra</label>
                                                <input type="date" value="<?= $fecha_compra; ?>" class="form-control" id="fecha_compra" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Comprobante de la compra</label>
                                                <input type="text" value="<?= $comprobante; ?>" class="form-control" id="comprobante" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Precio de la compra</label>
                                                <input type="text" value="<?= $precio_compra; ?>" class="form-control" id="precio_compra_controlador" disabled>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Cantidad de la compra</label>
                                                <input type="number" value="<?= $cantidad; ?>" id="cantidad_compra" style="text-align: center" class="form-control" disabled>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">IVA aplicado (%)</label>
                                                <input type="text" value="<?= $iva; ?>" class="form-control" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Precio total con IVA</label>
                                                <input type="text" value="<?= number_format($precio_total, 2); ?>" class="form-control" disabled>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Usuario</label>
                                                <input type="text" class="form-control" value="<?php echo $nombres_usuario; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                </div>

                            </div>

                        </div>


                    </div>


                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>