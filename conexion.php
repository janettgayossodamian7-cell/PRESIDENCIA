<?php
$host = "localhost";
$user = "root";       // Tu usuario de MySQL (por defecto es root)
$pass = "";           // Tu contraseña (por defecto en XAMPP va vacía)
$db   = "topia_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Asegurar soporte de acentos y eñes
$conn->set_charset("utf8mb4");
?>