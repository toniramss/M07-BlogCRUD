<?php

    require_once('../../config/Database.php');
    require_once('../../models/User.php');
    //require_once('../../models/UserModel.php');

    $id = $_GET['id'];

    $db = (new Database())->getConnection();

    $user = new User($db);

    //Consulta a la base de datos
    $userModifying = $user->selectUserId($user, $id);



    //var_dump($userModifying);


    //echo $userModifying["userName"];
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

        <h1 class="text-center font-medium text-2xl mb-6">Regenerar contraseña</h1>

        <div class="mb-4">
            <label for="editTextIdUsuario" class="block text-gray-700 font-medium mb-2">Id de usuario:</label>
            <input type="hidden" name="newIdUser" value="<?php echo $userModifying['idUser']; ?>">
            <input type="text" id="editTextIdUsuario" name="newIdUser"
                value="<?php echo $userModifying['idUser']; ?>" readonly
                class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
        </div>

        <div class="mb-4">
            <label for="editTextNombreUsuario" class="block text-gray-700 font-medium mb-2">Nombre de usuario:</label>
            <input type="text" id="editTextNombreUsuario" value="<?php echo $userModifying['userName']; ?>" readonly
                class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
        </div>

        <div class="mb-4">
            <label for="editTextPassword1" class="block text-gray-700 font-medium mb-2">Nueva contraseña:</label>
            <input type="password" id="editTextPassword1" name="newPassword" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="editTextPassword2" class="block text-gray-700 font-medium mb-2">Repite la contraseña:</label>
            <input type="password" id="editTextPassword2" name="newPassword2" required
                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label id="textViewErrorContrasenya" class="block text-red-500 text-sm font-medium"></label>
        </div>

        <div class="flex justify-center">
            <button type="submit" name="updateUserPassword"
                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Guardar cambios
            </button>
        </div>
    </form>
</div>

    
</body>
</html>