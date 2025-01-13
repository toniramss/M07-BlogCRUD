<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../public/output.css" rel="stylesheet">
</head>
<body class="bg-red-500">

    <div class="flex flex-col items-center justify-center">

        <img src="../../public/img/usuario.png">

        <form action="../../controllers/UserController.php" method="POST">

            <label>Nombre de usuario:</label>
            <input type="text" id="textViewNombreUsuario" name="nombreUsuario">

            <label>Contraseña:</label>
            <input type="password" id="textViewContrasenya" name="contrasenya">

            <button type="submit" name="login">Log In</button>

        </form>

        

    </div>

    <div>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>

                <?php foreach ($usuario as $usuarios) { ?>

                    <tr>
                        <td><?php echo $usuario['idUser']?></td>
                        <td><?php echo $usuario['userName']?></td>
                    </tr>

                <?php } ?>
            </tr>
        </table>
    </div>

    
</body>
</html>