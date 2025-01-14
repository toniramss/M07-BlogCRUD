<?php

require_once('../../config/Database.php');
require_once('../../models/User.php');
require_once('../../models/Post.php');
require_once('../../models/Comment.php');
require_once('../../models/UserRoles.php');

$idPost = $_GET['id'];

$db = (new Database())->getConnection();

$post = new Post($db);
$postId = $post->selectFromId($idPost);

$comment = new Comment($db);

$listaCommentsFromPost = $comment->selectAllCommentsFromPost($idPost);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-purple-400 via-pink-500 to-orange-400 min-h-screen flex items-center justify-center py-10">
    <div class="max-w-5xl w-full p-8 bg-white bg-opacity-90 border border-gray-200 rounded-xl shadow-2xl space-y-8">
        <!-- Detalles del Post -->
        <div class="border-b pb-6">
            <h2 class="text-3xl font-bold text-gray-800">Detalles del Post</h2>
            <div class="grid grid-cols-2 gap-6 mt-6">
                <div>
                    <p class="text-sm text-gray-500 font-semibold">ID Post</p>
                    <p class="text-lg text-gray-800 font-medium"><?php echo $postId['idPost'] ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-semibold">Usuario</p>
                    <p class="text-lg text-gray-800 font-medium"><?php echo $postId['userName'] ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-semibold">Título</p>
                    <p class="text-lg text-gray-800 font-medium"><?php echo $postId['title'] ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-semibold">Descripción</p>
                    <p class="text-lg text-gray-800 font-medium"><?php echo $postId['description'] ?></p>
                </div>
            </div>
        </div>

        <!-- Tabla de Comentarios -->
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Comentarios</h2>
            <div class="overflow-hidden border border-gray-300 rounded-lg shadow-sm">
                <table class="w-full text-left table-auto bg-gradient-to-br from-white via-gray-100 to-gray-200">
                    <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-sm font-semibold">Usuario</th>
                            <th class="px-6 py-3 text-sm font-semibold">Comentario</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        <?php foreach ($listaCommentsFromPost as $comment) { ?>
                            <tr class="hover:bg-purple-100">
                                <td class="px-6 py-4 text-gray-800 font-medium"><?php echo $comment['userName'] ?></td>
                                <td class="px-6 py-4 text-gray-600"><?php echo $comment['description'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón Volver -->
        <div class="flex justify-end mt-6">
            <a href="dashboard.php"
                class="text-white bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 font-medium px-6 py-2 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                Volver Atrás
            </a>
        </div>
    </div>
</body>

</html>

