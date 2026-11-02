<?php
include("conexion_academico.php");

try {
    // 1. Tabla t_curso
    $sqlCurso = "CREATE TABLE IF NOT EXISTS t_curso (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombrecurso VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci";

    $conexion->exec($sqlCurso);
    echo "Tabla 't_curso' creada correctamente.<br>";

    // 2. Tabla t_alumno con relación Foreign Key
    $sqlAlumno = "CREATE TABLE IF NOT EXISTS t_alumno (
        id_alumno INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        ap_paterno VARCHAR(100) NOT NULL,
        ap_materno VARCHAR(100) NOT NULL,
        t_curso_id INT NULL,
        CONSTRAINT fk_alumno_curso FOREIGN KEY (t_curso_id) REFERENCES t_curso(id)
         ON DELETE SET NULL ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci";

    $conexion->exec($sqlAlumno);
    echo "Tabla 't_alumno' creada correctamente con su relación.";

} catch (PDOException $e) {
    echo "Error al crear las tablas: " . $e->getMessage();
}

$conexion = null;
?>
