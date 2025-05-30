<?php
include ('../../config.php');

$id_producto = $_GET['id_producto'];
$nro_compra = $_GET['nro_compra'];
$fecha_compra = $_GET['fecha_compra'];
$id_proveedor = $_GET['id_proveedor'];
$comprobante = $_GET['comprobante'];
$id_usuario = $_GET['id_usuario'];
$cantidad_compra = $_GET['cantidad_compra'];
$stock_total = $_GET['stock_total'];

$iva = $_GET['iva']; // nuevo
$precio_total = $_GET['precio_total']; // nuevo
$precio_compra = $precio_total; // guardar como precio final con IVA incluido

$fechaHora = date("Y-m-d H:i:s");

$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO tb_compras
    (id_producto, nro_compra, fecha_compra, id_proveedor, comprobante, id_usuario, 
     precio_compra, cantidad, fyh_creacion, iva, precio_total) 
VALUES 
    (:id_producto, :nro_compra, :fecha_compra, :id_proveedor, :comprobante, :id_usuario, 
     :precio_compra, :cantidad, :fyh_creacion, :iva, :precio_total)");

$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':nro_compra', $nro_compra);
$sentencia->bindParam(':fecha_compra', $fecha_compra);
$sentencia->bindParam(':id_proveedor', $id_proveedor);
$sentencia->bindParam(':comprobante', $comprobante);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':cantidad', $cantidad_compra);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
$sentencia->bindParam(':iva', $iva);
$sentencia->bindParam(':precio_total', $precio_total);

if ($sentencia->execute()) {
    // Actualiza el stock
    $updateStock = $pdo->prepare("UPDATE tb_almacen SET stock = :stock WHERE id_producto = :id_producto");
    $updateStock->bindParam(':stock', $stock_total);
    $updateStock->bindParam(':id_producto', $id_producto);
    $updateStock->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se registró la compra correctamente.";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/compras";
    </script>
    <?php
} else {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos.";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/compras/create.php";
    </script>
    <?php
}
