<?php
session_start();
require_once '../../models/Post.php';
require_once '../../config/Database.php';
require_once '../../controllers/PostController.php';

$idPost = $_GET['idPostDeleting'];
//echo $idPost;

// Crear conexión y controlador
$database = new Database();
$db = $database->getConnection();
$postController = new PostController();

// Procesar el formulario si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $postController->deleteView();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['redirect'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
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

    <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="max-w-lg bg-white p-6 rounded-lg shadow-md border border-gray-200">
            <!-- Título -->
            <h1 class="text-xl font-semibold text-gray-800 mb-4 text-center">
                ¿Está seguro de eliminar el post seleccionado?
            </h1>

            <form action="" method="POST" class="space-y-4">
                <!-- Campo oculto para el ID del post -->
                <input type="hidden" name="idPost" value="<?php echo $idPost ?>">

                <!-- Botones de acción -->
                <div class="flex justify-between">
                    <!-- Botón Cancelar -->
                    <button type="submit" name="redirect"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-400 transition duration-200">
                        Cancelar
                    </button>

                    <!-- Botón Eliminar -->
                    <button type="submit" name="action"
                        class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition duration-200">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>