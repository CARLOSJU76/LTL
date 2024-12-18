<?php

    include_once('./config/Conexion.php');
    include_once('./models/loginModel.php');
    include_once('./funciones/funciones.php');

class LoginController{
    private $db;
    private $loginModel;
    private $objeto;

    public function __construct(){
        $database= new Conexion();
        $this->db= $database->getConnection();
        $this->loginModel= new LoginModel($this->db);
        $this->objeto= new objeto();
    }
    public function login(){
        if($_SERVER["REQUEST_METHOD"]="POST"){
            $usuario=$_POST["usuario"];
            $passw=$_POST["passw"];

    $array= $this->loginModel->verificar( $usuario, $passw);
    $opcion=$array[0];
    $user1=$array[1];
    $this->objeto->notifilogin($opcion, $user1);
        }
    }
}


?>