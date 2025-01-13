<?php

require_once('../config/Database.php');
require_once('../models/User.php');
require_once('../models/Comment.php');

class CommentController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Post($db);
    }
    // Mostrar la página principal con todos los posts





}







if (isset($_POST['insertComment'])) {

    $db = (new Database())->getConnection();

    $comment = new Comment($db);

    $comment->insertComment($_POST['idUserLogin'], $_POST['idPost'], $_POST['description']);

    if (isset($_SESSION['error'])) {

        echo "Se ha producido un error";

        //Cambiar a pagina de descripcion del post
        header('Location: ../views/home/postDescription.php?idPost=' . $_POST['idPost']);
        exit();


    } else {

        echo "Se ha insertado correctamente";

        //Si todo funciona correctamente mostramos todos los usuarios con el nuevo al final

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/home/postDescription.php?idPost=' . $_POST['idPost']);
        exit();

    }

} else if (isset($_POST['updateComment'])) {

    $db = (new Database())->getConnection();

    $comment = new Comment($db);

    $comment->updateComment($_POST['idComment'], $_POST['$description']);

    if (isset($_SESSION['error'])) {

        //Cambiar a pagina de descripcion del post
        header('Location: ../views/home/home.php');
        exit();


    } else {

        //Si todo funciona correctamente mostramos todos los usuarios con el nuevo al final

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/home/home.php');
        exit();

    }

} else if (isset($_POST['deleteComment'])) {

    $db = (new Database())->getConnection();

    $comment = new Comment($db);

    $comment->deleteComment($_POST['idComment']);

    if (isset($_SESSION['error'])) {

        //Cambiar a pagina de descripcion del post
        header('Location: ../views/home/home.php');
        exit();


    } else {

        //Si todo funciona correctamente mostramos todos los usuarios con el nuevo al final

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/home/home.php');
        exit();

    }

}
?>