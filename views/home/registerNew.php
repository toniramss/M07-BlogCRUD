<?php

require_once('../../config/Database.php');
require_once('../../models/User.php');
require_once('../../models/UserRoles.php');


$db = (new Database())->getConnection();

$user = new User($db);


$userRole = new UserRoles($db);

$listaUserRoles = $userRole->selectAllRoles();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify user</title>
    <script src="../../scripts/scriptCheckPassword.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-green-400 min-h-screen flex items-center justify-center">

    <?php require_once('../../config/mensajes.php') ?>

    <div class="flex flex-col items-center justify-center min-h-screen p-6">
        <form action="../../controllers/UserController.php" method="POST"
            class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md transform transition hover:scale-105 duration-300">

            <h1 class="text-center font-medium text-4xl text-gray-800 mb-6">Crear Usuario</h1>

            <div class="flex justify-center items-center mb-6">
                <img class="w-1/2" src="../../public/img/usuario.png" alt="Usuario">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre de usuario:</label>
                <input type="text" id="textViewNombreUsuario" name="userName"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Contraseña:</label>
                <input type="password" id="editTextPassword1" name="password"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Repetir contraseña:</label>
                <input type="password" id="editTextPassword2" name="password2"
                    class="w-full p-3 border border-gray-300 rounded-lg text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label id="textViewErrorContrasenya" class="block text-red-500 text-sm font-medium"></label>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Datos Personales</label>
                <hr class="border-gray-300">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre:</label>
                <input type="text" id="textViewNombre" name="name" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Apellido:</label>
                <input type="text" id="textViewApellido" name="surname" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">E-Mail:</label>
                <input type="email" id="textViewEmail" name="email" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rol de usuario:</label>
                <select name="idRole" class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                    <?php foreach ($listaUserRoles as $userRole): ?>
                        <option value="<?php echo $userRole['idRole']; ?>">
                            <?php echo htmlspecialchars($userRole['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit" name="register"
                    class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transform transition duration-300 hover:scale-105">
                    Crear Usuario
                </button>
            </div>

        </form>
    </div>

</body>

</html>
