<?php
require_once('../../config/Database.php');
require_once('../../models/User.php');
require_once('../../models/Post.php');

$db = (new Database())->getConnection();

$user = new User($db);

$usuarios = $user->selectAllUsers($user);

$post = new Post($db);

$listaPosts = $post->read();

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

<body style="background-image: url('../../public/img/fondo_dashboard.jpg');">



    <?php require_once('../../config/mensajes.php') ?>


    <header class="bg-blue-600 text-white py-6 flex justify-between items-center px-8">
        <h1 class="text-4xl font-bold">Blog de Comida</h1>
 
        <div class="flex gap-4">
            <form action="index.php" method="POST">
                <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                    Publicaciones
                </button>
            </form>
 
            <form action="../../server/logout.php" method="POST">
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </header>

    <br>


    <h1 class="text-4xl font-semibold text-gray-800 mb-4 text-center">Gestión de usuarios</h1>


    <div class="h-80 overflow-auto w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <table class="table-auto w-full bg-white border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Id Usuario</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Nombre de usuario</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Nombre</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Apellido</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Email</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Contraseña</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Rol</th>
                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Editar</th>
                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Cambiar contraseña
                    </th>
                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Eliminar usuario
                    </th>
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
    </div>

    <br>

    <h1 class="text-4xl font-semibold text-gray-800 mb-4 text-center">Gestión de publicaciones</h1>

    <div class="h-80 overflow-auto w-full bg-white border border-gray-300 rounded-lg shadow-md">
        <table class="table-auto w-full bg-white border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Id Post</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Usuario</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Título</th>
                    <th class="px-6 py-3 text-left border-b text-center sticky top-0 bg-gray-200">Descripción</th>

                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Ver comentarios</th>
                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Editar</th>
                    <th class="px-6 py-3 text-center border-b text-center sticky top-0 bg-gray-200">Eliminar usuario
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaPosts as $post) { ?>
                    <tr class="bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-6 py-4 border-b text-center"><?php echo $post['idPost'] ?></td>
                        <td class="px-6 py-4 border-b text-center"><?php echo $post['userName'] ?></td>

                        <td class="px-6 py-4 border-b text-center"><?php echo $post['title'] ?></td>
                        <td class="px-6 py-4 border-b text-center "><?php echo $post['description']; ?></td>
                        <td class="px-6 py-4 border-b text-center">
                            <a href="commentsView.php?id=<?php echo $post['idPost']; ?>">
                                <button
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none transition">Comentarios</button>
                            </a>
                        </td>
                        <td class="px-6 py-4 border-b text-center">
                            <a href="../home/post/formModifyPost.php?id=<?php echo $post['idPost']; ?>">
                                <button
                                    class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none transition">Editar</button>
                            </a>
                        </td>
                        <td class="px-6 py-4 border-b text-center">
                            <a href="../home/post/formDeletePost.php?id=<?php echo $post['idPost']; ?>">
                                <button
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none transition">Eliminar</button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

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