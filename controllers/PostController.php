<?php

require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../config/Database.php';
class PostController
{
    private $model;
    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Post($db);
    }
    // Mostrar la página principal con todos los posts
    public function index()
    {
        $result = $this->model->read();
        $postArr = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $postItem = [
                'idPost' => $idPost,
                'userName' => $userName,
                'title' => $title,
                'description' => $description
            ];
            $postArr[] = $postItem;
        }

        return $postArr;
        //require_once '../views/home/index.php';
    }

    /*public function createView()
    {
        $this->model->create("hola", 6, "hjhjbkh");
        
        //require_once '../views/home/index.php';
    }*/

    public function createView()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $idUser = $_POST['idUser'] ?? 0;
            $description = $_POST['description'] ?? '';

            if (empty($title) || empty($description) || !$idUser) {
                $_SESSION['error'] = "Todos los campos son obligatorios.";
                return;
            }

            $this->model->create($title, $idUser, $description);

            header('Location: ../../views/home/index.php');
            exit();
        }
    }

    public function updateView()
    {

        //$idPost = $_POST['idPost'] ?? null;
        //$title = $_POST['title'] ?? '';
        //$description = $_POST['description'] ?? '';

        if (empty($this->model->title) || empty($this->model->description)) {
            $_SESSION['error'] = "Todos los campos son obligatorios.";
            return;
        }

        if ($this->model->update($this->model->idPost, $this->model->title, $this->model->description)) {
            $_SESSION['mensaje'] = "Post actualizado correctamente.";
        } else {
            $_SESSION['error'] = "Error al actualizar el post.";
        }

        header('Location: ../../views/home/index.php');
        exit();

    }

    public function deleteView()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPost = $_POST['idPost'] ?? null;

            if (empty($idPost)) {
                $_SESSION['error'] = "ID del post es obligatorio.";
                return;
            }

            if ($this->model->delete($idPost)) {
                $_SESSION['mensaje'] = "Post eliminado correctamente.";
            } else {
                $_SESSION['error'] = "Error al eliminar el post.";
            }
            header('Location: ../../views/home/index.php');
            exit();
        }
    }
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }


}


if (isset($_POST['crearPublicacion'])) {

    $db = (new Database())->getConnection();

    $post = new Post($db);

    $post->setIdUser($_POST['idUsuario']);
    $post->setTitle($_POST['tituloNuevoPost']);
    $post->setDescription($_POST['descripcionNuevoPost']);

    $post->create();

    header('Location: ../views/home/index.php');
    exit();

} else if (isset($_POST['eliminarPublicacion'])) {

    $db = (new Database())->getConnection();

    $post = new Post($db);

    $post->delete($_POST['idPost']);

    header('Location: ../views/home/dashboard.php');
    exit();

} else if (isset($_POST['redirectDashboard'])) {

    header('Location: ../views/home/dashboard.php');
    exit();

} else if (isset($_POST['updatePost'])) {

    $db = (new Database())->getConnection();

    $post = new Post($db);

    $post->update($_POST['idPost'], $_POST['title'], $_POST['description']);


    if (isset($_SESSION['error'])) {

        header('Location: ../views/home/dashboard.php');
        exit();

    } else {

        //Redireccionar a la lista de usuarios para visualizar el que se ha creado
        header('Location: ../views/home/dashboard.php');
        exit();

    }


}




/*namespace controllers;

use models\PostModel;

class PostController {
    
    public function index() {
        $postModel = new PostModel();

        $posts = $postModel->getAllPosts();
        var_dump($posts);

        include('../views/home/index.php');
    }

    /**
     * Set the value of model
     *
     * @return  self
     */


?>