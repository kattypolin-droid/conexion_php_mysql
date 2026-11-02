<?php
include("conexion_academico.php");

try {
    $conexion->beginTransaction();

    // Insertar Cursos
    $stmtCurso = $conexion->prepare("INSERT INTO t_curso (id, nombrecurso) VALUES (:id, :nombre)");
    $stmtCurso->execute([':id' => 1, ':nombre' => 'Desarrollo Web con PHP 8']);
    $stmtCurso->execute([':id' => 2, ':nombre' => 'Base de Datos MySQL y PDO']);
    $stmtCurso->execute([':id' => 3, ':nombre' => 'JavaScript y Frontend']);
    $stmtCurso->execute([':id' => 4, ':nombre' => 'Programación Orientada a Objetos']);
    $stmtCurso->execute([':id' => 5, ':nombre' => 'Arquitectura y Servicios Web']);

    // Insertar Alumnos
    $stmtAlumno = $conexion->prepare("INSERT INTO t_alumno (id_alumno, nombre, ap_paterno, ap_materno, t_curso_id) VALUES (:id, :nom, :pat, :mat, :curso)");
    $stmtAlumno->execute([':id' => 1, ':nom' => 'Carlos Alberto', ':pat' => 'Mendoza', ':mat' => 'Rios', ':curso' => 1]);
    $stmtAlumno->execute([':id' => 2, ':nom' => 'Ana Sofía', ':pat' => 'Gómez', ':mat' => 'Torres', ':curso' => 1]);
    $stmtAlumno->execute([':id' => 3, ':nom' => 'Luis Fernando', ':pat' => 'Silva', ':mat' => 'Vargas', ':curso' => 2]);
    $stmtAlumno->execute([':id' => 4, ':nom' => 'Maria Elena', ':pat' => 'Rojas', ':mat' => 'Castro', ':curso' => 3]);
    $stmtAlumno->execute([':id' => 5, ':nom' => 'Kevin Alexander', ':pat' => 'Pérez', ':mat' => 'Suárez', ':curso' => 4]);

    $conexion->commit();
    echo "Registros insertados exitosamente en ambas tablas.";

} catch (PDOException $e) {
    $conexion->rollBack();
    echo "Error al insertar registros: " . $e->getMessage();
}

$conexion = null;
?>