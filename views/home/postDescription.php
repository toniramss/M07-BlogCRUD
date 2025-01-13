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
    <title> <?php echo $resultado['title'] ?> </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php require_once('../../config/mensajes.php') ?>

    <h5> Usuario: <?php echo $resultado['userName'] ?> </h5>

    <h1> Titulo: <?php echo $resultado['title'] ?> </h1>

    <h3> Descripción: <?php echo $resultado['description'] ?> </h3>


    <form action="../../controllers/CommentController.php" method="POST" class="bg-gray-100 border border-gray-300 rounded-lg p-4 mb-4 shadow">
        <input type="hidden" value="<?php echo ($_SESSION['idUser']) ?>" name="idUser">
        <input type="hidden" value="<?php echo ($idPost) ?>" name="idPost">

        

        <textarea class=" w-full text-lg font-semibold text-blue-600" placeholder="Comentar..." name="description" required></textarea>
        <button type="submit" name="insertComment">Enviar</button>
    </form>

    <?php foreach ($listaCommentsFromPost as $comment): ?>

        <div class="bg-gray-100 border border-gray-300 rounded-lg p-4 mb-4 shadow">
            <h4 class="text-lg font-semibold text-blue-600">Usuario: <?php echo htmlspecialchars($comment['userName']) ?>
            </h4>
            <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($comment['description']) ?></p>
        </div>


    <?php endforeach; ?>

</body>

</html>