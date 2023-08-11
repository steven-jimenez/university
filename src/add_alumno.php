<?php

include "conexion.php";

if (isset($_POST["add"])) {
    $nombre = $_POST["add_nombre"];
    $email = $_POST["add_email"];
    $matricula = $_POST["add_matricula"];
    $direccion = $_POST["add_direccion"];

    $existQuery = "SELECT id FROM usuarios WHERE email = '$email' OR matricula = '$matricula'";
    $result = $conexion->query($existQuery);

    if ($result->num_rows === 0) {
        $insertQuery = "INSERT INTO usuarios (nombre, email, matricula, direccion, rol) VALUES ('$nombre', '$email', '$matricula', '$direccion', 'alumno')";
        $conexion->query($insertQuery);

        header("Location: admin.php");
        exit();
    }
}
