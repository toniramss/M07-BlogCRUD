<?php

session_start();

require_once('../../config/Database.php');
require_once('../../models/Post.php');
require_once('../../models/Comment.php');
require_once('../../controllers/PostController.php');

$idPost = $_GET['idPost'];

$db = (new Database())->getConnection();
$post = new Post($db);
$postController = new PostController();

$resultado = $post->selectFromId($idPost);

//var_dump($resultado);

$comment = new Comment($db);

$listaCommentsFromPost = $comment->selectAllCommentsFromPost($idPost);

//$listaComentarios = 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $resultado['title']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-center bg-no-repeat min-h-screen flex flex-col items-center py-8" style="background-image: url('../../public/img/fondo_post.jpg');">

    <?php require_once('../../config/mensajes.php'); ?>

    <div class="bg-gradient-to-r from-gray-300 to-gray-500 rounded-lg shadow-lg p-6 max-w-4xl w-full">
        <!-- Header Section -->
        <div class="mb-6">
            <h5 class="text-xl font-semibold text-gray-700">Usuario: <span class="text-blue-600"><?php echo htmlspecialchars($resultado['userName']); ?></span></h5>
            <h1 class="text-3xl font-bold text-gray-900 mt-2"><?php echo htmlspecialchars($resultado['title']); ?></h1>
            <h3 class="text-gray-600 mt-4"><?php echo htmlspecialchars($resultado['description']); ?></h3>
        </div>

        <!-- Form Section -->
        <form action="../../controllers/CommentController.php" method="POST" class="mb-6">
            <input type="hidden" value="<?php echo htmlspecialchars($_SESSION['idUser']); ?>" name="idUser">
            <input type="hidden" value="<?php echo htmlspecialchars($idPost); ?>" name="idPost">

            <textarea 
                class="w-full p-4 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                placeholder="Comentar..." name="description" rows="4" required></textarea>

            <div class="flex justify-between items-center mt-4">
                <a href="index.php" class="text-blue-600 hover:text-blue-800 transition duration-200">Volver atrás</a>
                <button type="submit" name="insertComment"
                    class="bg-blue-500 text-white py-2 px-6 rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-200">
                    Enviar
                </button>
            </div>
        </form>

        <!-- Comments Section -->
        <?php foreach ($listaCommentsFromPost as $comment): ?>
            <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 mb-4 shadow hover:shadow-lg transition duration-200">
                <h4 class="text-lg font-semibold text-blue-600">Usuario: <?php echo htmlspecialchars($comment['userName']); ?></h4>
                <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($comment['description']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>
