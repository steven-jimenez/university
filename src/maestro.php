<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'maestro') {
    header("Location: index.php");
    exit();
}

require "conexion.php"; // Incluir el archivo de conexión

$query = "SELECT nombre FROM usuarios WHERE email = 'maestro@maestro'";
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
    <script src="./remove.js" defer></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Maestro</title>
</head>

<body>
    <main class="flex relative">
        <section class="bg-slate-800 text-white w-72 h-3/6">
            <div class="flex border-b p-2">
                <img class="rounded-full w-8 h-8 mr-2 ml-4 shadow-xl" src="./logo.jpg" />
                <p class="pt-1 cursor-pointer">Universidad</p>
            </div>
            <div class="flex flex-col border-b p-3 ">
                <p class="font-bold cursor-pointer">Maestro</p>
                <p class="cursor-pointer "><?php echo $nombre ?></p>
            </div>
            <div class="flex flex-col justify-center items-center pt-4 gap-3">
                <p class="font-bold pb-4 cursor-pointer">MENU MAESTROS</p>
                <p class="cursor-pointer hover:border-b-white"><i class="pr-2"><span class="material-symbols-outlined">
                            school
                        </span></i>Alumnos</p>

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
                <a class="pl-6 pr-96 pt-2 hover:text-blue-600" href="alumno.php">Home</a>
                <div class="flex pt-2">
                    <div id="toggleUser" onclick="toggleProfileBar()" class="flex flex-col  cursor-pointer p-4">
                        <h1 class="flex  hover:bg-slate-500 p-1 rounded-lg"><?php echo $nombre ?> <i><span class="material-symbols-outlined">
                                    expand_more
                                </span></i></h1>
                        <div id="profileBar" style="display: none;" class=" pt-2 pb-2 cursor-pointer rounded-lg  shadow-lg w-full">
                            <i class="pr-2"><span class="material-symbols-outlined">
                                    person
                                </span></i><a href="profile.php">Mi Perfil</a><br>
                            <i class="pr-2 text-red-600"><span class="material-symbols-outlined">
                                    logout
                                </span></i><a class="text-red-600" href="logout.php">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex justify-between pt-2 pl-3">
                <h1 class="text-3xl">Alumnos de la clase de Matematicas</h1>
                <div class="flex">
                    <p class="text-blue-700 pr-2">Home</p>
                    <p> / Maestro
                    <p>
                </div>
            </div>
            <div class="flex justify-between mt-3 ">
                <div class="flex gap-6 bg-slate-600 text-white w-96 pl-3 ml-3 mt-3 rounded-lg">
                    <p class="cursor-pointer">Copy</p>
                    <p class="cursor-pointer">Excel</p>
                    <p class="cursor-pointer">PDF</p>
                    <p class="cursor-pointer flex">Column Visibilty <i><span class="material-symbols-outlined">
                                arrow_drop_down
                            </span></i></p>
                </div>
                <div class="flex mt-3">
                    <p class="pr-2">Search :</p>
                    <input class="w-32 h-8 border ">
                </div>
            </div>

            <div>
                <table id="employeeTable" class=" w-full table-auto mb-4 ml-4 mt-3">
                    <thead>
                        <tr>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">#</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Clase</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Calificacion</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Mensajes</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Accion</th>
                        </tr>

                    </thead>

                    <tbody>
                        <?php
                        $conexion = new mysqli('localhost', 'root', '', 'PF_php');

                        if ($conexion->connect_error) {
                            die("Error de conexión: " . $conexion->connect_error);
                        }

                        // Consulta para obtener los usuarios con el rol de maestro
                        $query = "SELECT id, nombre, matricula, email, direccion, date FROM usuarios WHERE rol = 'alumno'";

                        $result = $conexion->query($query);

                        if ($result) {
                            while ($mostrar = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo  $mostrar['id']  ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['nombre'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['calificacion'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['mensaje'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2 gap-4">
                                        <button class="mr-2 text-blue-600">
                                            <span class="material-symbols-outlined">
                                                note_add
                                            </span>
                                        </button>
                                        <button class="text-blue-600 cursor-pointer mt-2 ">
                                            <span class="material-symbols-outlined">
                                                send
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "Error en la consulta: " . $conexion->error;
                        }

                        $conexion->close();
                        ?>
                    </tbody>
                </table>
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