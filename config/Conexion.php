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
                $this->conn = new PDO("mysql:host=". $this->host. ";port=3307;dbname=". $this->baseDatos, $this->usuario, $this->clave);
                $this->conn->exec("set names utf8");
                //echo json_encode(array('conexion'=>'Conexión exitosa'));
               //echo "Conexion Exitosa";
    
            }catch(PDOException $exception){
                //echo json_encode(array('conexion' => 'Error de conexión: ' . $exception->getMessage()));
                //echo"Error de conexión:". $exception->getMessage();
            }
            return $this->conn;
        }
    
    }

    
?>