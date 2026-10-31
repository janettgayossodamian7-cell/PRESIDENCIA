<?php
require_once 'conexion.php';

$accion = $_POST['accion'] ?? '';

// 1. Agregar nueva comunidad personalizada por el usuario
if ($accion === 'crear_comunidad') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);

    if (!empty($nombre)) {
        $stmt = $conn->prepare("INSERT INTO comunidades (nombre, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $descripcion);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php");
    exit();
}

// 2. Registrar nueva solicitud de ingreso
if ($accion === 'crear_solicitud') {
    $comunidad_id = intval($_POST['comunidad_id']);
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $motivo = trim($_POST['motivo']);

    if ($comunidad_id > 0 && !empty($nombre) && !empty($correo)) {
        $stmt = $conn->prepare("INSERT INTO solicitudes (comunidad_id, nombre_solicitante, correo, motivo_ingreso) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $comunidad_id, $nombre, $correo, $motivo);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php?msg=solicitud_enviada");
    exit();
}

// 3. Responder a solicitud (Aprobar o Rechazar con motivo)
if ($accion === 'responder_solicitud') {
    $id = intval($_POST['solicitud_id']);
    $estado = $_POST['estado']; // 'Aprobada' o 'Rechazada'
    $motivo_respuesta = trim($_POST['motivo_respuesta']);

    if ($id > 0 && in_array($estado, ['Aprobada', 'Rechazada'])) {
        $stmt = $conn->prepare("UPDATE solicitudes SET estado = ?, motivo_respuesta = ? WHERE id = ?");
        $stmt->bind_param("ssi", $estado, $motivo_respuesta, $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php");
    exit();
}
?>