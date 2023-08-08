<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require "conexion.php"; // Incluir el archivo de conexión

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar el registro
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php"); // Redirigir después de eliminar
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}
