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
    <link href="../../public/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="p-6 bg-white border border-gray-300 rounded-lg shadow-md space-y-4">
        <!-- Detalles del Post -->
        <div class="flex justify-center space-x-4 gap-4">
            <div>
                <h4 class="font-semibold text-lg text-gray-700">Id Post</h4>
                <h4 class="text-gray-600"><?php echo $postId['idPost'] ?></h4>

                <h4 class="font-semibold text-lg text-gray-700">Usuario</h4>
                <h4 class="text-gray-600"><?php echo $postId['userName'] ?></h4>
            </div>

            <div>
                <h4 class="font-semibold text-lg text-gray-700">Title</h4>
                <h4 class="text-gray-600"><?php echo $postId['title'] ?></h4>

                <h4 class="font-semibold text-lg text-gray-700">Description</h4>
                <h4 class="text-gray-600"><?php echo $postId['description'] ?></h4>
            </div>
        </div>


        <!-- Tabla de comentarios -->
        <div class="mt-6">
            <h4 class="font-bold text-xl text-gray-800 mb-4">Comentarios</h4>
            <table class="table-auto w-full bg-gray-100 border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Usuario</th>
                        <th class="px-6 py-3 text-left">Comentario</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($listaCommentsFromPost as $comment) { ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-700"><?php echo $comment['userName'] ?></td>
                            <td class="px-6 py-4 text-gray-600"><?php echo $comment['description'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>





</body>

</html>