<?php
include('../../config.php'); // Ruta a tu archivo de conexión

header('Content-Type: application/json');

// Obtener el JSON enviado
$input = json_decode(file_get_contents("php://input"), true);

// Validar campos
if (!$input || empty($input['id_mantenimiento']) || empty($input['fecha_mantenimiento'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
    exit;
}

$id = $input['id_mantenimiento'];
$fechaMantenimiento = $input['fecha_mantenimiento'];

// Calcular la nueva fecha de próximo mantenimiento (6 meses después)
try {
    $fechaProximo = (new DateTime($fechaMantenimiento))->add(new DateInterval('P6M'))->format('Y-m-d H:i:s');

    // Actualizar en base de datos
    $stmt = $pdo->prepare("UPDATE ordenes_mantenimiento 
                           SET fecha_mantenimiento = :fecha_mantenimiento,
                               fecha_proximo_mantenimiento = :fecha_proximo
                           WHERE id_mantenimiento = :id");

    $stmt->execute([
        ':fecha_mantenimiento' => $fechaMantenimiento,
        ':fecha_proximo' => $fechaProximo,
        ':id' => $id
    ]);

    echo json_encode(['success' => true, 'proximo_mantenimiento' => $fechaProximo]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en BD: ' . $e->getMessage()]);
}
