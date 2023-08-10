<?php
session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: index.php");
    exit();
}

include "conexion.php";

$email = $_SESSION['email']; // Obtener el email del usuario actual

$query = "SELECT id, nombre, matricula, email, direccion, date FROM usuarios WHERE email = '$email'";
$resultado = $conexion->query($query);

$nombre = "";
$matricula = "";
$direccion = "";
$date = "";

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila["nombre"];
        $matricula = $fila["matricula"];
        $direccion = $fila["direccion"];
        $date = $fila["date"];
    }
} else {
    echo "Error en la consulta: " . $conexion->error;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $matricula = $_POST["matricula"];
    $direccion = $_POST["direccion"];
    $date = $_POST["date"];

    // Actualizar los datos en la base de datos
    $query = "UPDATE usuarios SET matricula = '$matricula', direccion = '$direccion', date = '$date' WHERE email = '$email'";

    if ($conexion->query($query) === TRUE) {
        echo "Cambios guardados correctamente.";
    } else {
        echo "Error al guardar los cambios: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Profile</title>
</head>

<body>
    <main class="flex">
        <section class="bg-slate-800 text-white w-72 h-3/6">
            <div class="flex border-b p-2">
                <img class="rounded-full w-8 h-8 mr-2 ml-4 shadow-xl" src="./logo.jpg" />
                <p class="pt-1 cursor-pointer">Universidad</p>
            </div>
            <div class="flex flex-col border-b p-3 ">
                <p class="font-bold cursor-pointer">Mi Perfil</p>
                <p class="cursor-pointer "><?php echo $nombre ?></p>
            </div>
            <div class="flex flex-col justify-center items-center pt-4 gap-3">
                <p class="font-bold pb-4 cursor-pointer">MENU</p>

            </div>
            <div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </section>
        <section>
            <nav class="flex justify-between space-x-96 shadow-lg ">
                <a class="pl-6 pr-96 pt-2 cursor-pointer hover:text-blue-600" href="alumno.php">Home</a>
                <div class="flex    ">
                    <div id="toggleUser" onclick="toggleProfileBar()" class="flex flex-col  cursor-pointer p-4">
                        <h1 class="flex  hover:bg-slate-500 p-1 rounded-lg"><?php echo $nombre ?> <i><span class="material-symbols-outlined">
                                    expand_more
                                </span></i></h1>
                        <div id="profileBar" style="display: none;" class=" pt-2 pb-2 cursor-pointer rounded-lg  shadow-lg w-full">
                            <i class="pr-2"><span class="material-symbols-outlined">
                                    person
                                </span></i><a href="#">Mi Perfil</a><br>
                            <i class="pr-2 text-red-600"><span class="material-symbols-outlined">
                                    logout
                                </span></i><a class="text-red-600" href="logout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div>
                <div class="flex justify-between pt-2 pl-3">
                    <h1 class="text-3xl">Editar Perfil</h1>
                    <div class="flex">
                        <p class="text-blue-700 pr-2">Home</p>
                        <p> / Clases
                        <p>
                    </div>
                </div>

                <form method="POST" action="alumno.php" class="mt-3 ml-3 flex flex-col">
                    <label class="font-bold">Matrícula:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="text" name="matricula"><br>

                    <label class="font-bold">Correo:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="email" name="email"><br>

                    <label class="font-bold">Contraseña:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="password" name="password"><br>

                    <label class="font-bold">Nombre Completo:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="text" name="nombre"><br>

                    <label class="font-bold">Dirección:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="text" name="direccion"><br>

                    <label class="font-bold">Fecha de Nacimiento:</label>
                    <input class="cursor-pointer border-2 rounded-lg" type="date" name="date"><br>

                    <input class="bg-blue-600 cursor-pointer text-white w-48 rounded-lg font-semibold p-1  mt-3" type="submit" value="Guardar Cambios">
                </form>
            </div>

        </section>

        <script>
            function toggleProfileBar() {
                var profileBar = document.getElementById("profileBar");
                if (profileBar.style.display === "none") {
                    profileBar.style.display = "block";
                } else {
                    profileBar.style.display = "none";
                }
            }
        </script>

    </main>
</body>

</html>