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

<body>

    <?php require_once('../../config/mensajes.php') ?>

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <form action="../../controllers/UserController.php" method="POST"
            class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">

            <h1 class="text-center font-medium text-4xl">Crear usuario</h1>

            <br>

            <div class="flex justify-center items-center">
                <img class="w-1/2" src="../../public/img/usuario.png" alt="Usuario">
            </div>
            <br>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre de usuario:</label>
                <input type="text" id="textViewNombreUsuario" name="userName"
                    class="w-full p-2 border border-gray-300 rounded-lg text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Contraseña:</label>
                <input type="password" id="editTextPassword1" name="password"
                    class="w-full p-2 border border-gray-300 rounded-lg text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Repetir contraseña:</label>
                <input type="password" id="editTextPassword2" name="password2"
                    class="w-full p-2 border border-gray-300 rounded-lg text-gray-600">
            </div>

            <div class="mb-4">
                <label id="textViewErrorContrasenya" class="block text-red-500 text-sm font-medium"></label>
            </div>

            
            <br><br>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Datos Personales</label>
                <hr>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre:</label>
                <input type="text" id="textViewNombre" name="name" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Apellido:</label>
                <input type="text" id="textViewApellido" name="surname" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">E-Mail:</label>
                <input type="email" id="textViewEmail" name="email" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rol de usuario:</label>

                <select name="idRole" class="border border-gray-300 rounded-lg p-2 w-full">
                    <?php foreach ($listaUserRoles as $userRole): ?>
                        <option value="<?php echo $userRole['idRole']; ?>">
                            <?php echo htmlspecialchars($userRole['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit" name="insert"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Crear usuario
                </button>
            </div>

        </form>
    </div>
    </div>
</body>

</html>