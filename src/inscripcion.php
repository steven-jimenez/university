<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
    header("Location: index.php");
    exit();
}

include "conexion.php";

$claseId = $_GET['claseId'];
$alumnoEmail = $_SESSION['email'];
$query = "INSERT INTO inscripciones (clase_id, email) VALUES ($claseId, '$alumnoEmail')";

if ($conexion->query($query)) {
    echo "Inscripción exitosa.";
} else {
    echo "Error en la inscripción: " . $conexion->error;
}
