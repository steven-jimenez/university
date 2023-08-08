<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'alumno') {
    header("Location: index.php");
    exit();
}

require "conexion.php"; // Incluir el archivo de conexión

$query = "SELECT nombre FROM usuarios WHERE email = 'alumno@alumno'";
$resultado = $conexion->query($query);

$nombre = "";

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila["nombre"];
    } else {
        echo "No se encontraron registros en la base de datos.";
    }
} else {
    echo "Error en la consulta: " . $conexion->error;
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
                <p class="font-bold cursor-pointer">Alumno</p>
                <p class="cursor-pointer "><?php echo $nombre ?></p>
            </div>
            <div class="flex flex-col justify-center items-center pt-4 gap-3">
                <p class="font-bold pb-4 cursor-pointer">MENU ALUMNOS</p>
                <p class="cursor-pointer"><i><span class="material-symbols-outlined">
                            task
                        </span></i> Ver Calificaciones</p>
                <p class="cursor-pointer"><i><span class="material-symbols-outlined">
                            library_books
                        </span></i> Administra tus clases</p>
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
                <h1 class="pl-6 pr-96 pt-2">Home</h1>
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
                <h1 class="text-3xl ml-3 mt-3">Editar Perfil</h1>
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