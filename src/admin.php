<<?php
    session_start();

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    require "conexion.php";

    $query = "SELECT nombre FROM usuarios WHERE email = 'admin@admin'";
    $resultado = $conexion->query($query);

    $nombre = "";

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $nombre = $fila["nombre"];
        } else {
            echo "No se encontraron registros en la base de datos.";
        }
    } else {
        echo "Error en la consulta: " . $conexion->error;
    }
    ?> <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./output.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <title>Alumno</title>
    </head>

    <body>
        <h1>Panel de Administración</h1>
        <ul>
            <li><a href="manage_teachers.php">Administrar Maestros</a></li>
            <li><a href="manage_students.php">Administrar Alumnos</a></li>
            <li><a href="manage_classes.php">Administrar Clases</a></li>
        </ul>
        <a href="logout.php">Cerrar Sesión</a>

    </body>

    </html>