<?php
session_start();
$idUser = $_SESSION['idUser'];

require_once('../../config/Database.php');
require_once('../../models/Post.php');
require_once('../../controllers/PostController.php');

$db = (new Database())->getConnection();
$post = new Post($db);
$postController = new PostController();

$resultado = $postController->index();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicaciones - Blog</title>
    <link href="../../public/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100" style="background-image: url('../../public/img/fondo_blog.png');">

    <!-- Header -->
    <header class="bg-blue-600 text-white py-6 flex justify-between items-center px-8">
        <h1 class="text-4xl font-bold">Blog de Comida</h1>

        <form action="../../server/logout.php" method="POST">
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition duration-200">
                Cerrar Sesión
            </button>
        </form>
    </header>

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


    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-blue-200 border rounded-lg shadow-lg p-6">
                <form action="../../controllers/PostController.php" method="POST">

                    <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Crear nueva publicación</h2>

                    <br>

                    <input hidden type="text" name="idUsuario" value="<?php echo $idUser ?>"></input>

                    <input type="text" class="text-gray-600 mb-4 w-full rounded p-2" placeholder="Título" name="tituloNuevoPost"></input>

                    <textarea class="text-gray-500 w-full h-[100px] rounded p-2" placeholder="Escribe aqui..." name="descripcionNuevoPost"></textarea>
                    
                    <br><br>

                    <button type="submit" name="crearPublicacion" class="bg-green-500 text-black font-bold py-2 px-4 mr-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">Publicar</button>
                </form>


            </div>
            <?php if (!empty($resultado)): ?>

                <?php foreach ($resultado as $post): ?>
                    <div class="bg-blue-200 border rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($post['description']); ?></p>
                        <p class="text-sm text-gray-500">Publicado por Usuario: <span
                                class="font-semibold"><?php echo htmlspecialchars($post['userName']); ?></span></p>

                        <br>


                        <a href="postDescription.php?idPost=<?php echo $post['idPost'] ?>"
                            class="bg-green-500 text-black font-bold py-2 px-4 mr-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                            Ver
                        </a>

                        <a href="updateView.php?idPostModifying=<?php echo $post['idPost'] ?>"
                            class="bg-yellow-500 text-black font-bold py-2 px-4 mr-2 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                            Editar
                        </a>

                        <a href="deleteView.php?idPostDeleting=<?php echo $post['idPost'] ?>"
                            class="bg-red-500 text-black font-bold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                            Eliminar
                        </a>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-lg text-gray-500">No hay publicaciones disponibles.</p>
            <?php endif; ?>
        </div>

        <div class="fixed bottom-4 right-4">
            <a href="../../public/index.php">
                <button
                    class="bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 text-2xl">
                    💬
                </button>
            </a>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <p class="text-center">&copy; <?php echo date('Y'); ?> Blog de Comida. Todos los derechos reservados.</p>
    </footer>

</body>

</html>