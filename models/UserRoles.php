<?php

//require_once ('../config/Database.php');
class UserRoles
{
    public $conn;
    public $irRole;
    public $name;
    public $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function selectAllRoles() {

        $sentenciaText = "SELECT idRole, name FROM UserRoles";

        $sentencia = $this->conn->prepare($sentenciaText);
        $sentencia->execute();

        //Devuelve un array asociativo
        $resultado = $sentencia->fetchAll();


        return $resultado;
    }

    // Leer todos los posts
    public function read()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' ORDER BY idUser DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Crear un nuevo post
    public function create($title, $content, $author_id)
    {
        // Implementa la lógica para insertar un post
    }
    // Actualizar un post existente
    public function update($id, $title, $content, $author_id)
    {
        // Implementa la lógica para actualizar un post
    }
    // Eliminar un post
    public function delete($id)
    {
        // Implementa la lógica para eliminar un post
    }
}
