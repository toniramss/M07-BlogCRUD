<?php

    require_once('../../config/Database.php');
    require_once('../../models/User.php');
    //require_once('../../models/UserModel.php');

    $id = $_GET['id'];

    $db = (new Database())->getConnection();

    $user = new User($db);

    //Consulta a la base de datos
    $userDeleting = $user->selectUserId($user, $id);

    //var_dump($userDeleting);

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

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-6 rounded-lg shadow-xl w-96">
        <form action="../../controllers/UserController.php" method="POST">

            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Confirmación de Eliminación</h2>
            <h5 class="text-lg text-gray-600 text-center mb-6">
                ¿Está seguro de eliminar el usuario <span class="font-semibold text-red-500"><?php echo $userDeleting['userName'] ?></span>?
            </h5>

            <input type="hidden" id="textViewIdUsuario" name="idUser" value="<?php echo $userDeleting['idUser'] ?>">

            <div class="flex justify-around space-x-4">
                <button type="submit" name="deleteUser" class="bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                    Sí
                </button>
                <button type="submit" name="redirectDashboard" class="bg-gray-300 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Cancelar
                </button>
            </div>

        </form>
    </div>

</div>

</body>

</html>