<?php

class Database {
    private $host = '172.17.131.35';
    //private $host = 'localhost:3308';
    private $db_name = 'blog_db';
    private $username = 'Toni';
    //private $username = 'root';
    private $password = '1234';
    public $conn;
    public function getConnection() {
    $this->conn = null;
    try {
    $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
   $this->username, $this->password);
    $this->conn->exec('set names utf8');
    } catch(PDOException $exception) {
    echo 'Error de conexión: ' . $exception->getMessage();
    }
    return $this->conn;
    }
   }

   function errorMessage($e) {

        //errorInfo es un array
        //Si la posicion 1 no esta vacia hace el if
        if (!empty($e->errorInfo[1])){

            //Segun error muestra el mensaje
            switch ($e->errorInfo[1]) {
                case 1062:
                    $mensaje = "Registro duplicado";
                    break;
                case 1451:
                    $mensaje = "Registro con elementos relacionados";
                    break;
                default:
                    $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                    break;
            }

            //Hay errores de la base de datos que no vienen en errorInfo -> utilizamos el errorCode
        } else {
            switch ($e->getCode()) {
                case 1044:
                    $mensaje = "Usuario y/o password incorrecto";
                    break;
                case 1049:
                    $mensaje = "Base de datos desconocida";
                    break;
                case 2002:
                    $mensaje = "No se encuentra el servidor";
                    break;
                default:
                    $mensaje = $e->getCode() . ' - ' . $e->getMessage();
                    break;
            }
        }

        return $mensaje;
    }



/*
    function openBd() {

        $servername = '172.17.131.35';
        $db_name = 'blog_db';
        $username = 'Toni';
        $password = '1234';

        $conexion = new PDO("mysql:host=" . $servername . ";dbname=" . $db_name, $username, $password);

        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conexion->exec("set names utf8");

        return $conexion;

    }

    function closeBd() {
        return null;
    }

    }*/


    /*private $host = 'localhost';
    private $db_name = 'blog_db';
    private $username = 'root';
    private $password = '1234';

    public $conn; //Definir conexion

    public function getConnection()
    {
        $this -> conn = null;  // Inicializar conexion

        try {

            //Crear una conexión a la base de datos utilizando PDO
            $this -> conn = new PDO(

                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                $this->username, 
                $this->password

            );
                
            //Configurar la conexión para usar codificación UTF-8
            $this -> conn -> exec("set names utf8");

        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this -> conn;
    }
}*/