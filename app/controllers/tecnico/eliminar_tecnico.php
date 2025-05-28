<?php
// Incluir el archivo de conexión a la base de datos
include '../../config.php'; // Asegúrate de que la ruta sea correcta

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idHorarioTecnico = $_POST['ID_HorarioTecnico'];

    try {
        $stmt = $pdo->prepare("DELETE FROM horariostecnicos WHERE ID_HorarioTecnico = :idHorarioTecnico");
        $stmt->bindParam(':idHorarioTecnico', $idHorarioTecnico, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Técnico eliminado correctamente']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido']);
}
