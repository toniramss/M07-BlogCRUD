<?php

    //require_once('../config/Database.php');

class Comment extends Database
{

    public $conn;
    private $idComment;
    private $idUser;
    private $idPost;
    private $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }






    function selectAllCommentsFromPost($idPost)
    {

        try {

            $sentenciaText = "SELECT u.userName, c.description FROM Comments c INNER JOIN Users u ON c.idUser = u.idUser WHERE c.idPost = :idPost";

            $sentencia = $this->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idPost', $idPost);

            $sentencia->execute();

            //Devuelve un array
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

        return $resultado;
    }

    function selectCommentId($idComment)
    {

        try {
            
            $sentenciaText = "SELECT idComment, description FROM Comments WHERE idComment = :idComment";

            $sentencia = $this->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idComment', $idComment);

            $sentencia->execute();

            //Devuelve un array
            $resultado = $sentencia->fetchAll();

        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

        return $resultado[0];

    }

    function insertComment($idUser, $idPost, $description)
    {
        try {

            $sentenciaText = "INSERT INTO Comments (idUser, idPost, description) VALUES (:idUser, :idPost, :description)";

            $sentencia = $this->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idUser', $idUser);
            $sentencia->bindParam(':idPost', $idPost);
            $sentencia->bindParam(':description', $description);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Comentario publicado correctamente";

            //return "Exito";

        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

            //return errorMessage($e);
        }
    }

    function updateComment($idComment, $description)
    {
        try {

            $sentenciaText = "UPDATE Comments SET description = :description WHERE idComment = :idComment";

            $sentencia = $this->conn->prepare($sentenciaText);
            $sentencia->bindParam(':description', $description);
            $sentencia->bindParam(':idComment', $idComment);


            $sentencia->execute();

            $_SESSION['mensaje'] = "Comentario actualizado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    function deleteComment($idComment)
    {

        try {
            $sentenciaText = "DELETE FROM Comments WHERE idComment = :idComment";

            $sentencia = $this->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idComment', $idComment);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Comentario eliminado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }


    }
}

