<?php
$servername = "localhost";
$username   = "root";
$password   = "";

try {
    // Definición del DSN
    $dsn = "mysql:host={$servername};charset=utf8mb4";
    
    // Instancia PDO
    $conexion = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ]);

    echo "Conectado exitosamente al servidor MySQL";
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>