<?php

require_once('../../../config/Database.php');
require_once('../../../models/User.php');
require_once('../../../models/Post.php');
require_once('../../../models/UserRoles.php');

$id = $_GET['id'];

//Consulta a la base de datos
$db = (new Database())->getConnection();

$post = new Post($db);

$postModifying = $post->selectFromId($id);

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

    <?php require_once('../../../config/mensajes.php') ?>

    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <form action="../../../controllers/PostController.php" method="POST"
            class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">

            <h1 class="text-center font-medium text-4xl">Modificar publicación</h1>

            <br>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Id de publicación:</label>
                <input type="hidden" name="idPost"
                    value="<?php echo $id ?>">
                <input type="text" value="<?php echo $id ?>" disabled
                    class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Usuario:</label>
                <input type="text" name="userName" value="<?php echo $postModifying['userName']; ?>" readonly
                    class="w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Título:</label>
                <input type="text" id="textViewNombre" name="title" value="<?php echo $postModifying['title']; ?>"
                    required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Descripción:</label>
                <textarea type="text" name="description" required
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php echo $postModifying['description']; ?>
                </textarea>

            </div>

            <div class="flex justify-center">
                <button type="submit" name="updatePost"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Guardar cambios
                </button>
            </div>

        </form>
    </div>


</body>

</html>