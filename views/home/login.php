<?php
// Puedes incluir lógica PHP aquí si es necesario
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../public/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-green-400 to-red-600 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">

        <div class="flex flex-col items-center">
            <img src="../../public/img/usuario.png" alt="Usuario" class="w-20 h-20 mb-4">
            <h2 class="text-2xl font-bold mb-6 text-gray-700">Bienvenido</h2>
        </div>

        <form action="../../controllers/UserController.php" method="POST" class="space-y-6">
            <div class="flex flex-col items-center mb-4">
                <label for="textViewNombreUsuario"
                    class="block text-sm font-medium text-gray-700 text-center w-full">Nombre de usuario</label>
                <input type="text" id="textViewNombreUsuario" name="nombreUsuario"
                    class="mt-1 block w-full max-w-xs px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                    required>
            </div>

            <div class="flex flex-col items-center mb-4">
                <label for="textViewContrasenya"
                    class="block text-sm font-medium text-gray-700 text-center w-full">Contraseña</label>
                <input type="password" id="textViewContrasenya" name="contrasenya"
                    class="mt-1 block w-full max-w-xs px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                    required>
            </div>

            <div class="text-center">
                <a href="registerNew.php" class="text-gray-500 hover:underline">¿Eres nuevo? ¡Crea tu cuenta ahora!</a>
            </div>

            <div class="text-center">
                <button type="submit" name="login"
                    class="bg-orange-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg shadow">Iniciar
                    sesión
                </button>
            </div>

        </form>
    </div>
</body>

</html>