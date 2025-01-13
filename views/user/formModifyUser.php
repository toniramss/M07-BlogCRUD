<?php

require_once('../../config/Database.php');
require_once('../../models/User.php');
require_once('../../models/UserRoles.php');

$id = $_GET['id'];

//Consulta a la base de datos
$db = (new Database())->getConnection();

$user = new User($db);

$userModifying = $user->selectUserId($user, $id);

$userRole = new UserRoles($db);

$listaUserRoles = $userRole->selectAllRoles();

//var_dump($listaUserRoles);



//var_dump($userModifying);


//echo $userModifying["userName"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify user</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php require_once('../../config/mensajes.php') ?>

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <form action="../../controllers/UserController.php" method="POST"
            class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">

            <h1 class="text-center font-medium text-4xl">Modificar usuario</h1>

            <br>

            <div class="flex justify-center items-center">
                <img class="w-1/2" src="../../public/img/usuario.png" alt="Usuario">
            </div>
            <br>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Id de usuario:</label>
                <input type="hidden" id="textViewIdUsuario" name="newIdUser"
                    value="<?php echo $userModifying['idUser']; ?>">
                <input type="text" id="textViewIdUsuario" name="newIdUser"
                    value="<?php echo $userModifying['idUser']; ?>" disabled
                    class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre de usuario:</label>
                <input type="text" id="textViewNombreUsuario" name="userName" value="<?php echo $userModifying['userName']; ?>" readonly
                    class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nombre:</label>
                <input type="text" id="textViewNombre" name="newName" value="<?php echo $userModifying['name']; ?>"
                    required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Apellido:</label>
                <input type="text" id="textViewApellido" name="newSurname"
                    value="<?php echo $userModifying['surname']; ?>" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">E-Mail:</label>
                <input type="email" id="textViewEmail" name="newEmail" value="<?php echo $userModifying['email']; ?>"
                    required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rol de usuario:</label>

                <select name="newUserRole" class="border border-gray-300 rounded-lg p-2 w-full">
                    <?php foreach ($listaUserRoles as $userRole): ?>
                        <option value="<?php echo $userRole['idRole']; ?>">
                            <?php echo htmlspecialchars($userRole['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex justify-center">
                <button type="submit" name="updateUser"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>


</body>

</html>