<?php
include "conexion.php";

if (isset($_POST["editar"])) {
    $id = $_POST["id"];
    $email = $_POST["Email"];
    $permiso = $_POST["Permiso"];
    $estado = isset($_POST["toggle"]) ? 'activo' : 'inactivo';

    $updateQuery = "UPDATE usuarios SET email = '$email', rol = '$permiso', estado = '$estado' WHERE id = $id";

    if ($conexion->query($updateQuery) === TRUE) {
        header("Location: permisos.php");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
