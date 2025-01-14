<?php

//require_once ('../config/Database.php');
class Post
{
    private $conn;
    private $table_name = 'posts';
    public $idPost;
    public $idUser;
    public $title;
    public $description;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Leer todos los posts
    public function read()
    {
        //$query = 'SELECT * FROM ' . $this->table_name .  ' ORDER BY idUser DESC';
        $query = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description 
        FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser ORDER BY userName"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function selectFromId($idPost)
    {
        //$query = 'SELECT * FROM ' . $this->table_name .  ' ORDER BY idUser DESC';
        $query = "SELECT p.idPost, p.idUser, p.title, u.userName, p.description 
        FROM Posts p INNER JOIN Users u ON p.idUser = u.idUser WHERE p.idPost = :idPost";

        $sentencia = $this->conn->prepare($query);

        $sentencia->bindParam(':idPost', $idPost);
        $sentencia->execute();



        //Devuelve un array
        $resultado = $sentencia->fetchAll();

        if ($resultado) {
            return $resultado[0];
        } else {
            return null;
        }
        
    }
    // Crear un nuevo post
    /*public function create($title, $idUser, $description)
    {
        // Implementa la lógica para insertar un post
        try
    {

        $sentenciaText = "INSERT INTO Posts (idUser, title, description) VALUES (:idUser, :title, :description)";

        $sentencia = $this->conn->prepare($sentenciaText);
        $sentencia->bindParam(':idUser', $idUser);
        $sentencia->bindParam(':title', $title);
        $sentencia->bindParam(':description', $description);


        $sentencia->execute();

        $_SESSION['mensaje'] = "Registro insertado correctamente";


    } catch (PDOException $e){
        $_SESSION['error'] = errorMessage($e);
    }
    return $sentencia;
    }*/

    public function create()
{
    try {
        $query = "INSERT INTO Posts (idUser, title, description) VALUES (:idUser, :title, :description)";
        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(':idUser', $this->idUser, PDO::PARAM_INT);
        $stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);

        $stmt->execute();

        $_SESSION['mensaje'] = "Registro insertado correctamente";
        return true;

    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        return false;
    }
}


    // Actualizar un post existente
    public function update($idPost, $title, $description)
    {
        try {
            $query = "UPDATE Posts SET title = :title, description = :description WHERE idPost = :idPost";
            $stmt = $this->conn->prepare($query);

            // Enlazar los parámetros
            $stmt->bindParam(':idPost', $idPost, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

    // Eliminar un post
    public function delete($idPost)
    {
        try {
            $query = "DELETE FROM Posts WHERE idPost = :idPost";
            $stmt = $this->conn->prepare($query);

            // Enlazar el parámetro
            $stmt->bindParam(':idPost', $idPost, PDO::PARAM_INT);

            $stmt->execute();
            
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    }

    /**
     * Get the value of idPost
     */ 
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */ 
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }
}


