<?php
require_once 'conexion.php';
$comunidades = $conn->query("SELECT * FROM comunidades ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitud de Ingreso - Topia</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="container" style="max-width: 600px;">
    <header>
        <h1>Solicitud de Ingreso</h1>
        <p>Comunidades del Municipio de Topia, Durango</p>
    </header>

    <div class="card">
        <form action="procesar.php" method="POST">
            <input type="hidden" name="accion" value="crear_solicitud">

            <label for="comunidad">Selecciona la Comunidad:</label>
            <select name="comunidad_id" id="comunidad" required>
                <option value="">-- Selecciona una comunidad --</option>
                <?php while($c = $comunidades->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                <?php endwhile; ?>
            </select>

            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Tu nombre completo">

            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" required placeholder="correo@ejemplo.com">

            <label for="motivo">Motivo de Ingreso / Solicitud:</label>
            <textarea name="motivo" id="motivo" rows="4" required placeholder="Explica brevemente por qué deseas ingresar..."></textarea>

            <button type="submit" class="btn-approve" style="width: 100%;">Enviar Solicitud</button>
        </form>
        <br>
        <a href="index.php">← Volver al Panel Principal</a>
    </div>
</div>
</body>
</html>