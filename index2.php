<?php 

include_once('./config/Conexion.php');
include_once('./funciones/funciones.php');
include_once('./models/loginModel.php');
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
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = $_POST["usuario"];
            $array=[];
            $array[2]= 11111;
            $array[3]= "email";
            $array[1]=$usuario;
           
           
                       
            $estado= $this->loginModel->verificarUser($usuario);
            $array[0]=$estado;
            $opcion= $array[0];
            $user1= $array[1];
            $perfil=$array[2];
            $email=$array[3];
           
        } 
        $this->objeto->notifilogin($opcion, $user1, $perfil, $email);
    }
}
$controller = new LoginController();
$controller->login();