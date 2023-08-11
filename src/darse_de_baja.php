<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
    header("Location: index.php");
    exit();
}

include "conexion.php";

$claseId = $_GET['claseId'];
$alumnoEmail = $_SESSION['email'];

$query = "DELETE FROM inscripciones WHERE clase_id = $claseId AND alumno_email = '$alumnoEmail'";

if ($conexion->query($query)) {
    echo "Darse de baja exitoso.";
} else {
    echo "Error en darse de baja: " . $conexion->error;
}
