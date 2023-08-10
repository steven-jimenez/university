<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.php");
    exit();
}

include "conexion.php";


$query = "SELECT nombre FROM usuarios WHERE email = 'admin@admin'";
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
    <title>Administrador</title>
</head>

<body>
    <main class="flex relative">
        <section class="bg-slate-800 text-white w-72 h-3/6">
            <div class="flex border-b p-2">
                <img class="rounded-full w-8 h-8 mr-2 ml-4 shadow-xl" src="./logo.jpg" />
                <p class="pt-1 cursor-pointer">Universidad</p>
            </div>
            <div class="flex flex-col border-b p-3 ">
                <p class="font-bold cursor-pointer">Administrador</p>
                <p class="cursor-pointer "><?php echo $nombre ?></p>
            </div>
            <div class="flex flex-col justify-center items-center pt-4 gap-3">
                <p class="font-bold pb-4 cursor-pointer">MENU ADMINISTRACION</p>
                <a href="permisos.php" class="cursor-pointer hover:border-b-white"><i class="pr-2"><span class="material-symbols-outlined">
                            manage_accounts
                        </span></i> Permisos</a>
                <a href="admin_maestros.php" class="cursor-pointer hover:border-b-white"><i class="pr-2"><span class="material-symbols-outlined">
                            contacts
                        </span></i> Maestros</a>
                <a href="admin.php" class="cursor-pointer hover:border-b-white"><i class="pr-2"><span class="material-symbols-outlined">
                            school
                        </span></i>Alumnos</p>
                    <a href="admin_clases.php" class="cursor-pointer hover:border-b-white"><i class="pr-2"><span class="material-symbols-outlined">
                                library_books
                            </span></i>Clases</a>
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
                <h1 class="text-3xl">Lista de Maestros</h1>
                <div class="flex">
                    <p class="text-blue-700 pr-2">Home</p>
                    <p> / Maestros
                    <p>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg " onclick="openAddModal()">
                    Agregar Maestro
                </button>
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
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Nombre</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Email</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Direccion</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Fec. de Nacimiento</th>
                            <th class="bg-gray-700 border border-gray-700 text-white px-4 py-2">Clase Asignada</th>
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
                        $query = "SELECT id, nombre, matricula, email, direccion, date FROM usuarios WHERE rol = 'maestro'";

                        $result = $conexion->query($query);

                        if ($result) {
                            while ($mostrar = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo  $mostrar['id']  ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo  $mostrar['nombre']  ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['email'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['direccion'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['date'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2"><?php echo $mostrar['clase'] ?></td>
                                    <td class="border border-gray-700 px-4 py-2 gap-4">
                                        <button class="mr-2 text-blue-600" onclick="openEditModal(<?php echo $mostrar['id']; ?>)">
                                            <span class="material-symbols-outlined">edit_square</span>
                                        </button>
                                        <button onclick="deleteRow(<?php echo $mostrar['id']; ?>)" class="text-red-600 cursor-pointer mt-2">
                                            <span class="material-symbols-outlined">delete</span>
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

        <div id="editModal" class="fixed inset-0  justify-center items-center bg-gray-800 bg-opacity-50 z-50 hidden">
            <div class="bg-white w-80 h-96 shadow-xl p-4 rounded-lg">
                <span class="close font-bold text-xl cursor-pointer  top-3 right-3" onclick="closeModal()">&times;</span>
                <h2 class="text-center mb-4">Editar Maestro</h2>
                <form action="edit.php" method="post">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editClase" class="block">Clase Asignada</label>
                        <input type="text" id="editClase" name="Clase" class="border rounded-lg w-full p-2">
                        <label for="editEmail" class="block">Email</label>
                        <input type="text" id="editEmail" name="Email" class="border rounded-lg w-full p-2">
                        <label for="editNombre" class="block">Nombre</label>
                        <input type="text" id="editNombre" name="Nombre" class="border rounded-lg w-full p-2">
                        <label for="editDireccion" class="block">Direccion</label>
                        <input type="text" id="editDireccion" name="Direccion" class="border rounded-lg w-full p-2">
                    </div>

                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Guardar Cambios</button>
                </form>
            </div>
        </div>

        <div id="addModal" class="fixed inset-0 justify-center items-center bg-gray-800 bg-opacity-50 z-50 hidden">
            <div class="bg-white w-80 h-96 shadow-xl p-4 rounded-lg">
                <span class="close font-bold text-xl cursor-pointer top-3 right-3" onclick="closeAddModal()">&times;</span>
                <h2 class="text-center mb-4">Agregar Maestro</h2>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="editClase" class="block">Clase Asignada</label>
                        <input type="text" id="editClase" name="Clase" class="border rounded-lg w-full p-2">
                        <label for="addEmail" class="block">Email</label>
                        <input type="text" id="addEmail" name="Email" class="border rounded-lg w-full p-2">
                        <label for="addNombre" class="block">Nombre</label>
                        <input type="text" id="addNombre" name="Nombre" class="border rounded-lg w-full p-2">
                        <label for="addDireccion" class="block">Direccion</label>
                        <input type="text" id="addDireccion" name="Direccion" class="border rounded-lg w-full p-2">
                    </div>
                    <button type="submit" name="add" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Guardar Cambios</button>
                </form>
            </div>
        </div>



        <script>
            function toggleProfileBar() {
                var profileBar = document.getElementById("profileBar");
                if (profileBar.style.display === "none") {
                    profileBar.style.display = "block";
                } else {
                    profileBar.style.display = "none";
                }
            }

            function openAddModal() {
                var addModal = document.getElementById("addModal");
                addModal.style.display = "flex";
            }

            function closeAddModal() {
                var addModal = document.getElementById("addModal");
                addModal.style.display = "none";
            }
        </script>
        <?php include "add.php"; ?>
        <?php include "edit.php"; ?>

    </main>

</body>

</html>