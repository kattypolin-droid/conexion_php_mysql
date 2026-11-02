<?php
include("conexion_academico.php");

try {
    echo "<h2>RESULTADOS DE LA ACTIVIDAD PRÁCTICA</h2>";

    // 1. Obtener todos los cursos disponibles en la tabla t_curso
    echo "<h3>1. Cursos Disponibles:</h3>";
    $stmt1 = $conexion->query("SELECT * FROM t_curso");
    $cursos = $stmt1->fetchAll();
    foreach ($cursos as $curso) {
        echo "ID: " . $curso['id'] . " | Curso: " . $curso['nombrecurso'] . "<br>";
    }

    echo "<hr>";

    // 2. Obtener todos los alumnos de la tabla t_alumno
    echo "<h3>2. Lista General de Alumnos:</h3>";
    $stmt2 = $conexion->query("SELECT * FROM t_alumno");
    $alumnos = $stmt2->fetchAll();
    foreach ($alumnos as $alumno) {
        echo "ID: " . $alumno['id_alumno'] . " | Nombre: " . $alumno['nombre'] . " " . $alumno['ap_paterno'] . " " . $alumno['ap_materno'] . "<br>";
    }

    echo "<hr>";

    // 3. Obtener todos los alumnos ordenados por su apellido paterno (ASC)
    echo "<h3>3. Alumnos Ordenados por Apellido Paterno (A-Z):</h3>";
    $stmt3 = $conexion->query("SELECT * FROM t_alumno ORDER BY ap_paterno ASC");
    $alumnosOrdenados = $stmt3->fetchAll();
    foreach ($alumnosOrdenados as $alumno) {
        echo $alumno['ap_paterno'] . " " . $alumno['ap_materno'] . ", " . $alumno['nombre'] . "<br>";
    }

    echo "<hr>";

    // 4. Obtener la cantidad de alumnos matriculados por curso
    echo "<h3>4. Cantidad de Alumnos Matriculados por Curso:</h3>";
    $sqlCantidad = "SELECT C.nombrecurso, COUNT(A.id_alumno) AS cantidad_alumnos
                    FROM t_curso C
                    LEFT JOIN t_alumno A ON C.id = A.t_curso_id
                    GROUP BY C.id, C.nombrecurso";
    $stmt4 = $conexion->query($sqlCantidad);
    $conteo = $stmt4->fetchAll();
    foreach ($conteo as $row) {
        echo "Curso: " . $row['nombrecurso'] . " — <strong>" . $row['cantidad_alumnos'] . " Alumno(s)</strong><br>";
    }

    echo "<hr>";

    // 5. Obtener la lista de alumnos junto con el nombre del curso en el que están inscritos
    echo "<h3>5. Alumnos con sus Respectivos Cursos (JOIN):</h3>";
    $sqlJoin = "SELECT A.nombre, A.ap_paterno, A.ap_materno, C.nombrecurso
                FROM t_alumno A
                JOIN t_curso C ON A.t_curso_id = C.id";
    $stmt5 = $conexion->query($sqlJoin);
    $listaJoin = $stmt5->fetchAll();
    foreach ($listaJoin as $row) {
        echo "Alumno: " . $row['nombre'] . " " . $row['ap_paterno'] . " " . $row['ap_materno'] . " — <strong>Curso: " . $row['nombrecurso'] . "</strong><br>";
    }

} catch (PDOException $e) {
    echo "Error en las consultas: " . $e->getMessage();
}

$conexion = null;
?>
