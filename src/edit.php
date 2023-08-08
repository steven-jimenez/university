<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require "conexion.php"; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    // Preparar y ejecutar la consulta para actualizar el registro
    $query = "UPDATE usuarios SET nombre=?, matricula=?, email=?, direccion=? WHERE id=?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ssssi", $nombre, $matricula, $email, $direccion, $id);

    if ($stmt->execute()) {
        header("Location: admin.php"); // Redirigir después de editar
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
