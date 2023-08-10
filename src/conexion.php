<?php

$host = "localhost";
$usuario = "root";
$password = "";
$bsd = "PF_php";


$conexion = mysqli_connect($host, $usuario, $password, $bsd);

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}
