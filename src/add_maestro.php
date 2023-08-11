<?php

include "conexion.php";

if (isset($_POST["add_maestro"])) {
    $clase = $_POST["clase"];
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

    $existQuery = "SELECT id FROM usuarios WHERE email = '$email' OR matricula = '$matricula'";
    $result = $conexion->query($existQuery);

    if ($result->num_rows === 0) {
        $insertQuery = "INSERT INTO usuarios (nombre, email, clase, direccion, rol) VALUES ('$nombre', '$email', '$clase', '$direccion', 'maestro')";
        $conexion->query($insertQuery);

        header("Location: admin_maestro.php");
        exit();
    }
}
