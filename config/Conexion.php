<?php
    class Conexion{
        private $host = "localhost";
        private $baseDatos="sistema_rank" ;
        private $usuario= "root" ;
        private $clave= "";
        //private $puerto= "3307";
        public $conn;

        public function getConnection(){
            $this->conn= null;
            try{
                $this->conn = new PDO("mysql:host=". $this->host. ";dbname=". $this->baseDatos, $this->usuario, $this->clave);
                $this->conn->exec("set names utf8");
                echo "Conexion Exitosa";
    
            }catch(PDOException $exception){
                echo"Error de conexión:". $exception->getMessage();
            }
            return $this->conn;
        }
    
    }

    
?>