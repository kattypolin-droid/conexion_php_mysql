<?php
include("conex.php");

try {
    // Consulta SQL para crear la base de datos academico
    $sql = "CREATE DATABASE IF NOT EXISTS academico CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci";

    $conexion->exec($sql);
    echo "<br>Base de datos 'academico' creada exitosamente";
} catch (PDOException $e) {
    echo "<br>Error al crear la base de datos: " . $e->getMessage();
}

$conexion = null;
?>