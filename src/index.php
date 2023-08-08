<?php
session_start();

// Verificar si el usuario ya está autenticado y redirigir según el rol
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] === 'admin') {
        header("Location: admin.php");
        exit();
    } elseif ($_SESSION['rol'] === 'maestro') {
        header("Location: maestro.php");
        exit();
    } elseif ($_SESSION['rol'] === 'alumno') {
        header("Location: alumno.php");
        exit();
    }
}

// Verificar si se enviaron datos de inicio de sesión
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Validar credenciales en la base de datos (pseudocódigo)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simulación de autenticación
    // Estos usuarios deben coincidir con los datos de acceso que proporcionaste
    $usuarios = array(
        array("email" => "admin@admin", "password" => "admin", "rol" => "admin"),
        array("email" => "maestro@maestro", "password" => "maestro", "rol" => "maestro"),
        array("email" => "alumno@alumno", "password" => "alumno", "rol" => "alumno")
    );

    foreach ($usuarios as $usuario) {
        if ($usuario['email'] === $email && $usuario['password'] === $password) {
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: index.php"); // Redirigir para cargar la página correspondiente según el rol
            exit();
        }
    }

    // Credenciales inválidas, mostrar mensaje de error
    $mensaje_error = "Credenciales inválidas.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Registro de Usuarios</title>
</head>

<body class="bg-amber-100">
    <main class="justify-center items-center  flex flex-col bg-amber-100">
        <img src="./logo.jpg" class="w-48" />

        <div class=" bg-white mb-4 w-4/12 h-64 flex flex-col justify-center items-center rounded-lg gap-3 shadow-lg">
            <h1 class=" font-bold">Bienvenido ingresa con tu cuenta</h1>
            <form class="flex flex-col bg-white gap-3 relative" action="index.php" method="post">
                <div>
                    <i class="ml-80 mt-1 pl-8 absolute text-slate-600"><span class="material-symbols-outlined">
                            mail
                        </span></i>
                    <input class=" text-black rounded-lg bg-white h-9 w-96 border pl-2 " name="email" type=" email" placeholder="Email" required>
                </div>
                <div>
                    <i class="ml-80 mt-1 pl-8 absolute text-slate-600 "><span class="material-symbols-outlined">
                            lock
                        </span></i>
                    <input class="text-black rounded-lg bg-white h-9 w-96 border pl-2" name="password" type="password" placeholder="password" required>
                </div>
                <div class="flex justify-end">
                    <button class="bg-blue-600 text-white w-24 h-9 rounded-lg mt-2" type="submit">Ingresar</button>
                </div>
            </form>
        </div>


        <div class="bg-white m-2 p-4 shadow-lg">
            <p class="border-b-2 font-bold"> informacion Acesso</p>
            <p class="text-lg pt-2 font-bold">Admin</p>
            <p>user: admin@admin</p>
            <p> pass: admin</p>
            <p class="text-lg pt-2 font-bold">Maestro</p>
            <p>user: maestro@maestro</p>
            <p>pass: maestro</p>
            <p class="text-lg pt-2 font-bold">Alumno</p>
            <p>user: alumno@alumno</p>
            <p>pass: alumno</p>

        </div>
    </main>
</body>

</html>