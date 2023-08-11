<?php

include "conexion.php";

if (isset($_POST["add_clases"])) {
    $nombre = $_POST["Clase"];
    $maestro = $_POST["Maestro"];


    $existQuery = "SELECT id FROM clases WHERE nombre = '$nombre' OR maestro = '$maestro'";
    $result = $conexion->query($existQuery);

    if ($result->num_rows === 0) {
        $insertQuery = "INSERT INTO clases (nombre, maestro) VALUES ('$nombre', '$maestro')";
        $conexion->query($insertQuery);

        header("Location: admin_clases.php");
        exit();
    }
}
