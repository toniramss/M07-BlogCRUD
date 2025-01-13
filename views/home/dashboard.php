<?php
require_once('../../config/Database.php');
require_once('../../models/User.php');

$db = (new Database())->getConnection();

$user = new User($db);

$usuarios = $user->selectAllUsers($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="../../public/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-5">



    <?php require_once('../../config/mensajes.php') ?>


    <div class="w-full">

        <a href="dashboard.php">
            <img src="">
        </a>

        <a href="index.php" class="flex-right">
            Publicaciones
        </a>

        <a href="">
            Cerrar sesión
        </a>


    </div>



    <h1 class="text-4xl font-semibold text-gray-800 mb-4 text-center">Gestión de usuarios</h1>

    <br>

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-6 py-3 text-left border-b text-center">Id</th>
                <th class="px-6 py-3 text-left border-b text-center">Nombre de usuario</th>
                <th class="px-6 py-3 text-left border-b text-center">Nombre</th>
                <th class="px-6 py-3 text-left border-b text-center">Apellido</th>
                <th class="px-6 py-3 text-left border-b text-center">Email</th>
                <th class="px-6 py-3 text-left border-b text-center">Contraseña</th>
                <th class="px-6 py-3 text-left border-b text-center">Rol</th>
                <th class="px-6 py-3 text-center border-b text-center">Editar</th>
                <th class="px-6 py-3 text-center border-b text-center">Cambiar contraseña</th>
                <th class="px-6 py-3 text-center border-b text-center">Eliminar usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) { ?>
                <tr class="odd:bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['idUser'] ?></td>
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['userName'] ?></td>
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['name'] ?></td>
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['surname'] ?></td>
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['email'] ?></td>
                    <td class="px-6 py-4 border-b text-center text-4xl">·······</td>
                    <td class="px-6 py-4 border-b text-center"><?php echo $usuario['urName'] ?></td>
                    <td class="px-6 py-4 border-b text-center ">
                        <a href="../user/formModifyUser.php?id=<?php echo $usuario['idUser']; ?>">
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none transition">Editar</button>
                        </a>
                    </td>
                    <td class="px-6 py-4 border-b text-center">
                        <a href="../user/formModifyUserPassword.php?id=<?php echo $usuario['idUser']; ?>">
                            <button
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none transition">Regenerar
                                contraseña</button>
                        </a>
                    </td>
                    <td class="px-6 py-4 border-b text-center">
                        <a href="../user/formDeleteUser.php?id=<?php echo $usuario['idUser']; ?>">
                            <button
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none transition">Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="fixed bottom-4 right-4">
        <a href="register.php">
            <button
                class=" w-16 h-16 bg-orange-500 text-white rounded-full shadow-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 text-4xl text-center">
                +
            </button>
        </a>
    </div>


</body>

</html>