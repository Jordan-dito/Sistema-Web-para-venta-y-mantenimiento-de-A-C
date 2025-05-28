<?php
// Incluir el archivo de conexión a la base de datos
include '../../config.php'; // Ruta correcta a la configuración

header('Content-Type: application/json');  // La respuesta será siempre JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obtener los datos del formulario
        $idHorarioTecnico = $_POST['id_horario_tecnico'];  // ID del horario técnico
        $diaInicio = $_POST['dia_inicio_semana'];
        $diaFin = $_POST['dia_fin_semana'];
        $horarioInicio = $_POST['horario_inicio'];
        $horarioFin = $_POST['horario_fin'];

        // Verificar si el horario técnico existe en la base de datos
        $query = $pdo->prepare("SELECT * FROM horariostecnicos WHERE ID_HorarioTecnico = :idHorarioTecnico");
        $query->bindParam(':idHorarioTecnico', $idHorarioTecnico);
        $query->execute();
        $horarioTecnico = $query->fetch(PDO::FETCH_ASSOC);

        if ($horarioTecnico) {
            // Actualizar el horario técnico
            $sql = "UPDATE horariostecnicos SET Dia_Inicio_Semana = :diaInicio, Dia_Fin_Semana = :diaFin, Horario_Inicio = :horarioInicio, Horario_Fin = :horarioFin WHERE ID_HorarioTecnico = :idHorarioTecnico";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':diaInicio', $diaInicio);
            $stmt->bindParam(':diaFin', $diaFin);
            $stmt->bindParam(':horarioInicio', $horarioInicio);
            $stmt->bindParam(':horarioFin', $horarioFin);
            $stmt->bindParam(':idHorarioTecnico', $idHorarioTecnico);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Datos guardados correctamente']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se pudo actualizar el registro.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'El registro no existe en la base de datos.']);
        }

        exit;
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido']);
    exit;
}
