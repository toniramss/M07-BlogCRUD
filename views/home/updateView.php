<?php

session_start();

require_once '../../models/Post.php';
require_once '../../config/Database.php';
require_once '../../controllers/PostController.php';

// Crear conexión y controlador
$db = (new Database())->getConnection();

$postController = new PostController();

$idPost = $_GET['idPostModifying'];

//echo "Id Post: " . $idPost;



$post = new Post($db);



//Crear un objeto post y buscar el post con el id en la base de datos
//Rellenar los inputs con los datos

$postModifying = $post->selectFromId($idPost);

//print_r($postModifying);

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $post = new Post($db);
    $post->setIdPost($_POST['idPost']);
    $post->setTitle($_POST['title']);
    $post->setDescription($_POST['description']);

    $postController->setModel($post);

    $postController->updateView();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Mostrar mensajes de éxito o error -->
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p style='color:green'>{$_SESSION['mensaje']}</p>";
        unset($_SESSION['mensaje']);
    }

    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    }
    ?>

    <!-- Formulario para actualizar un post -->
    <form action="" method="POST" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Actualizar Publicación</h2>

        <input hidden type="text" name="idPost" value="<?php echo $idPost ?>">

        <!-- Campo de Título -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Nuevo Título:</label>
            <input type="text" id="title" name="title" required value="<?php echo $postModifying['title'] ?>"
                class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>

        <!-- Campo de Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Nueva Descripción:</label>
            <textarea id="description" name="description" required
                class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"><?php echo htmlspecialchars($postModifying['description']); ?></textarea>
        </div>

        <!-- Botón de Enviar -->
        <button type="submit"
            class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
            Actualizar
        </button>
    </form>
</body>

</html>