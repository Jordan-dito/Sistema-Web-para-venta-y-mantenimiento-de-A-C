<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../app/controllers/ventas/listado_de_ventas.php');
include('../app/controllers/almacen/listado_de_productos.php');

include('../app/controllers/clientes/listado_de_clientes.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Ventas</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <?php
                            $contador_de_ventas = 0;
                            foreach ($ventas_datos as $ventas_datos) {
                                $contador_de_ventas++;
                            }
                            ?>
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Venta Nro
                                <input type="text" style="text-align: center;" value="<?php echo $contador_de_ventas + 1; ?>" disabled>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <b>Carrito</b>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                <i class="fa fa-search"></i>
                                Buscar producto
                            </button>

                            <!-- Campo para modificar el IVA -->
                            <br><br>
                            <?php
                            $iva = isset($_GET['iva']) ? floatval($_GET['iva']) / 100 : 0.15;
                            $iva_porcentaje = $iva * 100;
                            ?>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="input_iva"><b>IVA (%)</b></label>
                                    <input type="number" id="input_iva" class="form-control" min="0" max="100" step="1" value="<?php echo $iva_porcentaje; ?>">
                                </div>
                                <div class="col-md-2 align-self-end">
                                    <button class="btn btn-success" id="btn_actualizar_iva">Actualizar IVA</button>
                                </div>
                            </div>

                            <script>
                                $('#btn_actualizar_iva').click(function () {
                                    const nuevoIva = $('#input_iva').val();
                                    const url = new URL(window.location.href);
                                    url.searchParams.set('iva', nuevoIva);
                                    window.location.href = url.toString();
                                });
                            </script>

                      
                            <div class="modal fade" id="modal-buscar_producto">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #1d36b6;color: white">
                                            <h4 class="modal-title">Busqueda del producto</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example1" class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>Nro</center>
                                                            </th>
                                                            <th>
                                                                <center>Selecionar</center>
                                                            </th>
                                                            <th>
                                                                <center>Código</center>
                                                            </th>
                                                            <th>
                                                                <center>Categoría</center>
                                                            </th>
                                                            <th>
                                                                <center>Imagen</center>
                                                            </th>
                                                            <th>
                                                                <center>Nombre</center>
                                                            </th>
                                                            <th>
                                                                <center>Descripción</center>
                                                            </th>
                                                            <th>
                                                                <center>Stock</center>
                                                            </th>
                                                            <th>
                                                                <center>Precio compra</center>
                                                            </th>
                                                            <th>
                                                                <center>Precio venta</center>
                                                            </th>
                                                            <th>
                                                                <center>Fecha compra</center>
                                                            </th>
                                                            <th>
                                                                <center>Usuario</center>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 0;
                                                        foreach ($productos_datos as $productos_dato) {
                                                            $id_producto = $productos_dato['id_producto']; ?>
                                                            <tr>
                                                                <td><?php echo $contador = $contador + 1; ?></td>
                                                                <td>
                                                                    <button class="btn btn-info" id="btn_selecionar<?php echo $id_producto; ?>">
                                                                        Selecionar
                                                                    </button>
                                                                    <script>
                                                                        $('#btn_selecionar<?php echo $id_producto; ?>').click(function() {

                                                                            //alert('<?php echo $id_producto; ?>');

                                                                            var id_producto = "<?php echo $id_producto; ?>";
                                                                            $('#id_producto').val(id_producto);

                                                                            var producto = "<?php echo $productos_dato['nombre']; ?>";
                                                                            $('#producto').val(producto);

                                                                            var descripcion = "<?php echo $productos_dato['descripcion']; ?>";
                                                                            $('#descripcion').val(descripcion);

                                                                            var precio_venta = "<?php echo $productos_dato['precio_venta']; ?>";
                                                                            $('#precio_venta').val(precio_venta);

                                                                            var stock = "<?php echo $productos_dato['stock']; ?>";
                                                                            $('#stock').val(stock);
                                                                            

                                                                            $('#cantidad').focus();



                                                                            //$('#modal-buscar_producto').modal('toggle');

                                                                        });
                                                                    </script>
                                                                </td>
                                                                <td><?php echo $productos_dato['codigo']; ?></td>
                                                                <td><?php echo $productos_dato['categoria']; ?></td>
                                                                <td>
                                                                    <img src="<?php echo $URL . "/almacen/img_productos/" . $productos_dato['imagen']; ?>" width="50px" alt="asdf">
                                                                </td>
                                                                <td><?php echo $productos_dato['nombre']; ?></td>
                                                                <td><?php echo $productos_dato['descripcion']; ?></td>

                                                                <td><?php echo $productos_dato['stock']; ?></td>
                                                                
                                                                <td><?php echo $productos_dato['precio_compra']; ?></td>
                                                                <td><?php echo $productos_dato['precio_venta']; ?></td>
                                                                <td><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                                                <td><?php echo $productos_dato['email']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                    </tfoot>
                                                </table>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Producto</label>
                                                            <input type="text" id="id_producto" hidden>
                                                            <input type="text" id="producto" class="form-control" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Descripcion</label>
                                                            <input type="text" id="descripcion" class="form-control" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Cantidad</label>
                                                            <input type="text" id="cantidad" class="form-control">
                                                        </div>
                                                    </div>

                                                                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock Disponible</label>
                                                        <input type="text" id="stock" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio Unitario</label>
                                                            <input type="text" id="precio_venta" class="form-control" disabled>
                                                        </div>
                                                    </div>

                                                </div>

                                                                          
<button style="float: right;" id="btn_registrar_carrito" class="btn btn-primary">Registrar</button>

                                                <div id="respuesta_carrito">

                                                </div>

                                             

<script>
    $('#btn_registrar_carrito').click(function() {
        var nro_venta = '<?php echo $contador_de_ventas + 1 ?>';
        var id_producto = $('#id_producto').val();
        var cantidad = $('#cantidad').val();
        var stock = parseInt($('#stock').val()); // Obtén el stock del campo

        // Convertir cantidad a número
        cantidad = parseInt(cantidad);
        console.log("Cantidad:", cantidad, "Stock:", stock);

        // Validaciones
        if (id_producto === "") {
            alert("Debe de llenar los campos...");
        } else if (cantidad === "" || isNaN(cantidad) || cantidad <= 0) {
            alert("Debe de llenar la cantidad del producto con un número válido y mayor que cero.");
        } else if (cantidad > stock) {
            // Avisar al usuario si la cantidad supera el stock
            alert("La cantidad solicitada supera el stock disponible (" + stock + ").");
        } else {
            // Realizar la solicitud si todas las validaciones son exitosas
            var url = "../app/controllers/ventas/registrar_carrito.php";
            $.get(url, {
                nro_venta: nro_venta,
                id_producto: id_producto,
                cantidad: cantidad
            }, function(datos) {
                $('#respuesta_carrito').html(datos);
                $('#cantidad').val(''); // Limpiar campo de cantidad
                $('#modal-buscar_producto').modal('hide'); // Cerrar modal si es exitoso
            });
        }
    });
</script>

                                                <br><br>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <br> <br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7; text-align:center">Nro</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Producto</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Descripcion</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Cantidad</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7; text-align:center">Precio SubTotal</th>

                                            <th style="background-color: #e7e7e7; text-align:center">Accion</th>


                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php
                                 
                                 $contador_de_carrito = 0;
                                 $cantidad_total = 0;
                                 $precio_unitario_total = 0;
                                 $precio_total = 0;
                                 $precio_iva = 0;
                                 $iva = isset($_GET['iva']) ? floatval($_GET['iva']) / 100 : 0.15;
                                 $precio_total_iva = 0;
                                 
                                 $nro_venta = $contador_de_ventas + 1;
                                 

                                        //$sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion , pro.precio_venta as precio_venta FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto= pro.id_producto WHERE nro_venta='$nro_venta' ";
                                        $sql_carrito = "SELECT *,pro.nombre as nombre_producto, pro.descripcion as descripcion , pro.precio_venta as precio_venta ,pro.stock as stock, pro.id_producto as id_producto FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto= pro.id_producto WHERE nro_venta='$nro_venta' ORDER BY id_carrito ASC ";
                                        $query_carrito = $pdo->prepare($sql_carrito);
                                        $query_carrito->execute();
                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($carrito_datos as $carrito_dato) {

                                            $id_carrito = $carrito_dato['id_carrito'];
                                            $contador_de_carrito = $contador_de_carrito + 1;
                                            $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                            $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato['precio_venta']);

                                        ?>

                                            <tr>
                                                <td>
                                                    <center><?php echo $contador_de_carrito; ?></center>
                                                    <input type="text" value="<?php echo $carrito_dato['id_producto']; ?>" id="id_producto<?php echo $contador_de_carrito;?>" hidden>
                                                </td>
                                                <td><?php echo $carrito_dato['nombre_producto']; ?></td>
                                                <td><?php echo $carrito_dato['descripcion']; ?></td>
                                                <td>
                                                    <center><span id="cantidad_carrito<?php echo $contador_de_carrito;?>"><?php echo $carrito_dato['cantidad']; ?></span></center>
                                                    <input type="text" value="<?php echo $carrito_dato['stock'];?>" id="stock_de_inventario<?php echo $contador_de_carrito;?>" hidden>
                                                </td>

                                                <td>
                                                    <center><?php echo $carrito_dato['precio_venta']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $cantidad = floatval($carrito_dato['cantidad']);
                                                        $precio_venta = floatval($carrito_dato['precio_venta']);
                                                        echo $subtotal = $cantidad * $precio_venta;
                                                        $precio_total = $precio_total + $subtotal;
                                                        $precio_iva = $precio_iva + $subtotal * $iva;
                                                        $precio_total_iva=$precio_total + $precio_iva;


                                                        ?>
                                                    </center>
                                                </td>


                                                <td>
                                                    <form action="../app/controllers/ventas/borrar_carrito.php" method="post">
                                                        <input type="text" name="id_carrito" value="<?php echo $id_carrito; ?>" hidden>
                                                        <center>
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</button>
                                                        </center>
                                                    </form>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>

                                        <tr>
                                            <th colspan="3" style="background-color: #e7e7e7;text-align:right">Total</th>
                                            <th>
                                                <center>

                                                    <?php echo $cantidad_total; ?>

                                                </center>
                                            </th>
                                            <th>
                                                <center><?php echo  $precio_unitario_total; ?></center>
                                            </th>
                                            <th style="background-color: #fff2cc;">
                                                <center><?php echo  $precio_total; ?></center>
                                            </th>


                                        </tr>

                                        <tr>
                                        <tr>
    <th colspan="3" style="background-color: #e7e7e7;text-align:right">Iva (<?php echo $iva_porcentaje; ?>%) *</th>

                                            <th>
                                                <center>

                                                    <?php echo $cantidad_total; ?>

                                                </center>
                                            </th>
                                            <th>
                                                <center><?php echo  $precio_unitario_total; ?></center>
                                            </th>
                                            <th style="background-color: #FFA07A;">
                                                <center><?php echo  $precio_iva; ?></center>
                                            </th>


                                        </tr>

                                        <tr>
                                        <th colspan="3" style="background-color: #e7e7e7;text-align:right">Total con iva (<?php echo $iva_porcentaje; ?>%)</th>

                                            <th>
                                                <center>

                                                    <?php echo $cantidad_total; ?>

                                                </center>
                                            </th>
                                            <th>
                                                <center><?php echo  $precio_unitario_total; ?></center>
                                            </th>
                                            <th style="background-color: #fff819;">
                                            
                                                <center><?php echo $precio_total_iva; ?></center>
                                            </th>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>

                </div>
            </div>




            <div class="row">
                <div class="col-md-9">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del cliente </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <b>Cliente</b>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_cliente">
                                <i class="fa fa-search"></i>
                                Buscar cliente
                            </button>
                            <!-- modal para visualizar datos de los clientes -->
                            <div class="modal fade" id="modal-buscar_cliente">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #1d36b6;color: white">
                                            <h4 class="modal-title">Busqueda del cliente </h4>
                                            <div style="width:10px"></div>

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-agregar_cliente">
                                <i class="fa fa-users"></i>
                                agregar nuevo cliente
                            </button>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table table-responsive">
                                                <table id="example2" class="table table-bordered table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <center>Nro</center>
                                                            </th>
                                                            <th>
                                                                <center>Selecionar</center>
                                                            </th>
                                                            <th>
                                                                <center>Nombre del cliente</center>
                                                            </th>
                                                            <th>
                                                                <center>CI/RUC</center>
                                                            </th>
                                                            <th>
                                                                <center>Celular</center>
                                                            </th>
                                                            <th>
                                                                <center>Correo</center>
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador_de_clientes = 0;
                                                        foreach ($clientes_datos as $clientes_dato) {
                                                            $id_cliente = $clientes_dato['id_cliente'];
                                                            $contador_de_clientes = $contador_de_clientes + 1; ?>
                                                            <tr>
                                                                <td>
                                                                    <center><?php echo $contador_de_clientes; ?></center>
                                                                </td>
                                                                <td>
                                                                    <center>
                                                                        <button id="btn_pasar_cliente<?php echo $id_cliente; ?>" class="btn btn-info">Seleccionar</button>
                                                                        <script>
                                                                            $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function() {
                                                                                var id_cliente = '<?php echo $clientes_dato['id_cliente']; ?>';
                                                                                $('#id_cliente').val(id_cliente);

                                                                                var nombre_cliente = '<?php echo $clientes_dato['nombre_cliente']; ?>';
                                                                                //alert(nombre_cliente);
                                                                                $('#nombre_cliente').val(nombre_cliente);

                                                                                var nit_ci_cliente = '<?php echo $clientes_dato['nit_ci_cliente']; ?>';
                                                                                $('#nit_ci_cliente').val(nit_ci_cliente);

                                                                                var celular_cliente = '<?php echo $clientes_dato['celular_cliente']; ?>';
                                                                                $('#celular_cliente').val(celular_cliente);

                                                                                var email_cliente = '<?php echo $clientes_dato['email_cliente']; ?>';
                                                                                $('#email_cliente').val(email_cliente);

                                                                                $('#modal-buscar_cliente').modal('toggle');
                                                                            });
                                                                        </script>
                                                                    </center>
                                                                </td>
                                                                <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                                <td>
                                                                    <center><?php echo $clientes_dato['nit_ci_cliente']; ?></center>
                                                                </td>
                                                                <td>
                                                                    <center><?php echo $clientes_dato['celular_cliente']; ?></center>
                                                                </td>
                                                                <td>
                                                                    <center><?php echo $clientes_dato['email_cliente']; ?></center>
                                                                </td>

                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_cliente" hidden>
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" class="form-control" id="nombre_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Ruc/CI del cliente</label>
                                        <input type="text" class="form-control" id="nit_ci_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular del cliente</label>
                                        <input type="text" class="form-control" id="celular_cliente">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Correo del cliente</label>
                                        <input type="text" class="form-control" id="email_cliente">
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Registrar ventas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Monto a cancelar</label>
                                <input type="text" class="form-control" id="total_a_cancelar"
                                style="text-align:center; background-color:#fff819" value="<?php echo $precio_total_iva?>" disabled>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="">Total pagado</label>
                                        <input type="text" class="form-control" id="total_pagado">
                                        <script>
                                     $('#total_pagado').keyup(function(){
                                            //alert('');
                                            var total_a_cancelar =$('#total_a_cancelar').val();
                                            //var total_pagado =$('#total_pagado').val();
                                            var total_pagado =$('#total_pagado').val();

                                            var cambio=parseFloat(total_pagado)-parseFloat(total_a_cancelar);
                                            $('#cambio').val(cambio);
                                            });
                                        </script>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cambio</label>
                                        <input type="text" class="form-control" id="cambio" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                    <button id="btn_guardar_venta" class="btn btn-primary btn-block">Guardar venta</button>
                                    <div id="respuesta_registro_venta"></div>
                                    <script>
                                        $('#btn_guardar_venta').click(function(){
                                            //alert("asdf");
                                            var nro_venta ='<?php echo $contador_de_ventas+1; ?>';
                                            var id_cliente =$('#id_cliente').val();
                                            var total_a_cancelar =$('#total_a_cancelar').val();
                                            //alert(total_a_cancelar);

                                            if(id_cliente==""){
                                                alert("Debe llenar los datos de un cliente");

                                            }else{
                                                //guardar_venta();
                                                actualizar_stock();
                                                guardar_venta();
                                            }

                                            
                                            //alert(n);
                                            function actualizar_stock(){
                                                //var stock= '';
                                                //for(var i=0;0>3;i++){
                                                    var i=1;
                                                    var n='<?php echo $contador_de_carrito;?>';

                                                for(i=1;i<=n;i++){
                                                        //var stock_de_inventario=$('#stock_de_inventario <php echo $id_carrito; ?');
                                                        //var stock_de_inventario='#stock_de_inventario'+i;
                                                        var a='#stock_de_inventario'+i;
                                                        var stock_de_inventario =$(a).val();

                                                        var b='#cantidad_carrito'+i;
                                                        var cantidad_carrito =$(b).html();

                                                        var c='#id_producto'+i;
                                                        var id_producto =$(c).val();

                                                        var stock_calculado = parseFloat(stock_de_inventario-cantidad_carrito);

                                                        //alert(id_producto +" - " + stock_de_inventario +" - "+  cantidad_carrito +" - "+stock_calculado);

                                                        var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                                            $.get(url2, {
                                                                id_producto: id_producto,
                                                                stock_calculado: stock_calculado
                                                            }, function(datos) {
                                                                //$('#respuesta_registro_venta').html(datos);
                                                            });
                                                        
                                                    }
                                            }

                                            function guardar_venta (){
                                                var url = "../app/controllers/ventas/registro_de_ventas.php";
                                                            $.get(url, {
                                                                nro_venta: nro_venta,
                                                                id_cliente: id_cliente,
                                                                total_a_cancelar: total_a_cancelar
                                                            }, function(datos) {
                                                                $('#respuesta_registro_venta').html(datos);
                                                            });
                                            }
                                            
                                        });
                                    </script>
                                </div>

                            
                        </div>
                    </div>
                </div>
            </div>






            <!-- /.row -->


















            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>



<script>
    $(function() {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });


    $(function() {
        $("#example2").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>


<!-- modal para visualizar el formulario para agregar clientes -->
<div class="modal fade" id="modal-agregar_cliente">
                                <!--<div class="modal-dialog modal-lg">-->
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #b6900c;color: white">
                                            <h4 class="modal-title">Nuevo cliente </h4>
                                            <div style="width:10px"></div>

                                        

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                                                <div class="form-group">
                                                    <label for="">Nombre del cliente</label>
                                                    <input type="text" name="nombre_cliente" class="form-control">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Ruc/CI del cliente</label>
                                                    <input type="text" name="nit_ci_cliente" class="form-control">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Celular del cliente</label>
                                                    <input type="text" name="celular_cliente" class="form-control">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Correo del cliente</label>
                                                    <input type="email" name="email_cliente" class="form-control">

                                                </div>
                                                <hr>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-warning btn btn-block">Guardar cliente</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->