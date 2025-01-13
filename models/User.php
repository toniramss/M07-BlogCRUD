<?php

//require_once('../config/Database.php');

class User extends Database
{

    public $conn;
    private $idUser;
    private $userName;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $idRole;

    public function __construct($db)
    {

        $this->conn = $db;

    }



    //Getters y setters





    public function selectUserId($user, $idUser)
    {

        $sentenciaText = "SELECT u.idUser, u.userName, u.name, u.surname, u.email, u.password, u.idRole, ur.name AS urName FROM Users u INNER JOIN UserRoles ur ON u.idRole = ur.idRole WHERE idUser = :idUser";

        $sentencia = $user->conn->prepare($sentenciaText);

        $sentencia->bindParam(':idUser', $idUser);
        $sentencia->execute();

        //Devuelve un Objeto User
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);


        return $resultado;
    }

    public function selectAllUsers($user)
    {
        $sentenciaText = "SELECT u.idUser, u.userName, u.name, u.surname, u.email, u.password, u.idRole, ur.name AS urName FROM Users u INNER JOIN UserRoles ur ON u.idRole = ur.idRole";

        $sentencia = $user->conn->prepare($sentenciaText);
        $sentencia->execute();

        //Devuelve un array asociativo
        $resultado = $sentencia->fetchAll();


        return $resultado;
    }
    public function selectUserWithName($userName)
    {

        $sentenciaText = "SELECT idUser, userName, name, surname, email, password, idRole FROM Users WHERE userName = :userName";

        $sentencia = $this->conn->prepare($sentenciaText);

        $sentencia->bindParam(':userName', $userName);
        $sentencia->execute();

        // Devuelve un array asociativo
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            // Crea una nueva instancia de User y llena los datos usando los setters
            $userResponse = new User($this->conn);
            $userResponse->setIdUser($resultado['idUser']);
            $userResponse->setUserName($resultado['userName']);
            $userResponse->setName($resultado['name']);
            $userResponse->setSurname($resultado['surname']);
            $userResponse->setEmail($resultado['email']);
            $userResponse->setPassword($resultado['password']);
            $userResponse->setIdRole($resultado['idRole']);

            return $userResponse;
        }

        // Si no se encontró el usuario, devuelve null
        return null;

    }

    public function insertUser($user)
    {

        try {

            $sentenciaText = "INSERT INTO Users (userName, name, surname, email, password, idRole) VALUES (:userName, :name, :surname, :email, :password, :idRole)";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':userName', $user->userName);
            $sentencia->bindParam(':name', $user->name);
            $sentencia->bindParam(':surname', $user->surname);
            $sentencia->bindParam(':email', $user->email);
            $sentencia->bindParam(':password', $user->password);
            $sentencia->bindParam(':idRole', $user->idRole);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Registro insertado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function updateUser($user)
    {

        try {

            $sentenciaText = "UPDATE Users SET name = :newName, surname = :newSurname, email = :newEmail, idRole = :newIdRole WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':newName', $user->name);
            $sentencia->bindParam(':newSurname', $user->surname);
            $sentencia->bindParam(':newEmail', $user->email);
            $sentencia->bindParam(':newIdRole', $user->idRole);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Registro actualizado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function updateUserPassword($user)
    {

        try {

            $sentenciaText = "UPDATE Users SET password = :newPassword WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':newPassword', $user->password);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Contraseña actualizada correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

    }

    public function deleteUser($user)
    {

        try {

            $sentenciaText = "DELETE FROM Users WHERE idUser = :idUser";

            $sentencia = $user->conn->prepare($sentenciaText);
            $sentencia->bindParam(':idUser', $user->idUser);

            $sentencia->execute();

            $_SESSION['mensaje'] = "Usuario eliminado correctamente";


        } catch (PDOException $e) {
            $_SESSION['error'] = errorMessage($e);

        }

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

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of idRole
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set the value of idRole
     *
     * @return  self
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;

        return $this;
    }
}

