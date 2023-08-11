<?php
include "conexion.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre = $_POST["Nombre"];
    $email = $_POST["Email"];
    $matricula = $_POST["Matricula"];
    $direccion = $_POST["Direccion"];

    $query = "UPDATE usuarios SET nombre = '$nombre', email = '$email', matricula = '$matricula', direccion = '$direccion' WHERE id = $id";

    $resultado = $mysqli->query($query);
}
