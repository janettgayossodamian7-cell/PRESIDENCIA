<?php
require_once 'conexion.php';

// Obtener todas las comunidades
$res_comunidades = $conn->query("SELECT * FROM comunidades ORDER BY id DESC");

// Filtrar solicitudes si se selecciona una comunidad específica
$filtro_comunidad = isset($_GET['comunidad_id']) ? intval($_GET['comunidad_id']) : 0;

if ($filtro_comunidad > 0) {
    $stmt = $conn->prepare("SELECT s.*, c.nombre AS comunidad_nombre FROM solicitudes s JOIN comunidades c ON s.comunidad_id = c.id WHERE s.comunidad_id = ? ORDER BY s.id DESC");
    $stmt->bind_param("i", $filtro_comunidad);
    $stmt->execute();
    $res_solicitudes = $stmt->get_result();
} else {
    $res_solicitudes = $conn->query("SELECT s.*, c.nombre AS comunidad_nombre FROM solicitudes s JOIN comunidades c ON s.comunidad_id = c.id ORDER BY s.id DESC");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Comunidades - Topia, Durango</title>
    <link rel="stylesheet" href="estilos.css?v=2.0">
</head>
<body>
<div class="container">
    <header>
        <h1>Sistema de Gestión de Comunidades de Topia</h1>
        <p>Panel de Administración y Control de Solicitudes</p>
    </header>

    <div class="grid">
        <!-- Formulario para agregar nuevas comunidades -->
        <div class="card">
            <h3>+ Registrar Nueva Comunidad</h3>
            <form action="procesar.php" method="POST">
                <input type="hidden" name="accion" value="crear_comunidad">
                
                <label>Nombre de la Comunidad:</label>
                <input type="text" name="nombre" placeholder="Ej. Otra comunidad de Topia" required>
                
                <label>Descripción / Historia:</label>
                <textarea name="descripcion" rows="3" placeholder="Reseña o datos de la comunidad..."></textarea>
                
                <button type="submit">Guardar Comunidad</button>
            </form>
        </div>

        <!-- Acceso rápido a registrar solicitud -->
        <div class="card">
            <h3>📝 Enviar Solicitud de Ingreso</h3>
            <p>¿Deseas mandar una solicitud a alguna de las comunidades?</p>
            <a href="solicitar.php" class="btn btn-approve">Ir al Formulario de Solicitud</a>
        </div>
    </div>

    <!-- Filtro de Comunidades -->
    <div class="card" style="margin-bottom: 20px;">
        <h3>Filtrar Solicitudes por Comunidad</h3>
        <form method="GET" action="index.php">
            <select name="comunidad_id" onchange="this.form.submit()">
                <option value="0">--- Mostrar Todas las Comunidades ---</option>
                <?php 
                $res_comunidades->data_seek(0);
                while($c = $res_comunidades->fetch_assoc()): 
                ?>
                    <option value="<?= $c['id'] ?>" <?= $filtro_comunidad == $c['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nombre']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>

  <!-- Tabla de Solicitudes -->
    <h2>Solicitudes de Ingreso Registradas <span style="font-size: 0.75em; color: #64748b;">(Total: <?= $res_solicitudes->num_rows ?>)</span></h2>
    
    <div class="table-responsive">
        <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Comunidad</th>
                <th>Solicitante</th>
                <th>Contacto</th>
                <th>Motivo de Ingreso</th>
                <th>Estado</th>
                <th>Resolución / Motivo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($res_solicitudes->num_rows > 0): ?>
                <?php while($s = $res_solicitudes->fetch_assoc()): ?>
                    <tr>
                        <td>#<?= $s['id'] ?></td>
                        <td><strong><?= htmlspecialchars($s['comunidad_nombre']) ?></strong></td>
                        <td><?= htmlspecialchars($s['nombre_solicitante']) ?></td>
                        <td><?= htmlspecialchars($s['correo']) ?></td>
                        <td><?= htmlspecialchars($s['motivo_ingreso']) ?></td>
                        <td><span class="badge <?= $s['estado'] ?>"><?= $s['estado'] ?></span></td>
                        <td><?= htmlspecialchars($s['motivo_respuesta'] ?? 'N/A') ?></td>
                        <td>
                            <?php if ($s['estado'] === 'Pendiente'): ?>
                                <form action="procesar.php" method="POST" style="margin: 0;">
                                    <input type="hidden" name="accion" value="responder_solicitud">
                                    <input type="hidden" name="solicitud_id" value="<?= $s['id'] ?>">
                                    
                                    <textarea name="motivo_respuesta" placeholder="Escribe el motivo de aprobación/rechazo..." required style="font-size: 0.8em; margin-bottom: 5px;"></textarea>
                                    
                                    <button type="submit" name="estado" value="Aprobada" class="btn-approve" style="padding: 4px 8px; font-size: 0.8em;">Aprobar</button>
                                    <button type="submit" name="estado" value="Rechazada" class="btn-reject" style="padding: 4px 8px; font-size: 0.8em;">Rechazar</button>
                                </form>
                            <?php else: ?>
                                <em>Procesada</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center;">No hay solicitudes registradas todavía. ¡Prueba enviando una!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
