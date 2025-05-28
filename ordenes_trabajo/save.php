<?php
include('../../config.php');

// Capturar los datos del formulario
$fecha_orden = $_POST['fecha_orden'] ?? null;
$numero_factura = $_POST['numero_factura'] ?? null;
$cedula = $_POST['cedula'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$correo = $_POST['correo'] ?? null;
$id_horario_tecnico = $_POST['tecnico_id'] ?? null;
$fecha_instalacion = $_POST['fecha_instalacion'] ?? null;

$id_producto = $_POST['id_producto'] ?? null;
$iva_porcentaje = $_POST['iva_porcentaje'] ?? 0.00;
$precio_venta = $_POST['precio_venta'] ?? 0.00;
$valor_iva = $_POST['valor_iva'] ?? 0.00;
$total_con_iva = $_POST['total_con_iva'] ?? 0.00;
$datos_extras = $_POST['datos_extras'] ?? null;

$fyh_creacion = date('Y-m-d H:i:s');

try {
    $sql = "INSERT INTO ordenes_instalacion (
        fecha_orden, numero_factura, cedula, nombre_cliente, correo_cliente, id_horario_tecnico,
        fecha_instalacion, id_producto, iva_porcentaje, precio_venta, valor_iva, total_con_iva, datos_extras, fyh_creacion
    ) VALUES (
        :fecha_orden, :numero_factura, :cedula, :nombre_cliente, :correo_cliente, :id_horario_tecnico,
        :fecha_instalacion, :id_producto, :iva_porcentaje, :precio_venta, :valor_iva, :total_con_iva, :datos_extras, :fyh_creacion
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fecha_orden' => $fecha_orden,
        ':numero_factura' => $numero_factura,
        ':cedula' => $cedula,
        ':nombre_cliente' => $nombre,
        ':correo_cliente' => $correo,
        ':id_horario_tecnico' => $id_horario_tecnico,
        ':fecha_instalacion' => $fecha_instalacion,
        ':id_producto' => $id_producto,
        ':iva_porcentaje' => $iva_porcentaje,
        ':precio_venta' => $precio_venta,
        ':valor_iva' => $valor_iva,
        ':total_con_iva' => $total_con_iva,
        ':datos_extras' => $datos_extras,
        ':fyh_creacion' => $fyh_creacion
    ]);

    echo "Guardado correctamente";

} catch (PDOException $e) {
    http_response_code(500);
    echo "Error al guardar: " . $e->getMessage();
}
catch (Exception $e) {
    http_response_code(500);
    echo "Error inesperado: " . $e->getMessage();
}
catch (Error $e) {
    http_response_code(500);
    echo "Error fatal: " . $e->getMessage();
}