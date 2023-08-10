<?php

$conexion = new mysqli('localhost', 'root', '', 'PF_php');

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['add'])) {
    $addNombre = mysqli_real_escape_string($conexion, $_POST["Nombre"]);
    $addMatricula = mysqli_real_escape_string($conexion, $_POST["Matricula"]);
    $addEmail = mysqli_real_escape_string($conexion, $_POST["Email"]);
    $addDireccion = mysqli_real_escape_string($conexion, $_POST["Direccion"]);

    $addDatos = "INSERT INTO usuarios (nombre, matricula, email, direccion) VALUES ('$addNombre', '$addMatricula', '$addEmail', '$addDireccion')";

    $query = mysqli_query($conexion, $addDatos);

    if ($query) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar los datos: " . mysqli_error($conexion);
    }
}
