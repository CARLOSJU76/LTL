<?php

include_once 'config/Conexion.php';
include_once 'models/loginModel.php';
include_once 'funciones/funciones.php';
include_once 'controller/loginController.php';
class LoginController1{
    private $db;
    private $loginModel;
    private $objeto;

    public function __construct(){
        $database= new Conexion();
        $this->db= $database->getConnection();
        $this->loginModel= new LoginModel($this->db);
        $this->objeto= new objeto();
    }

    public function verificar($user, $pasww){
        return $this->loginModel->verificar($user, $pasww);
    }
    public function getUserEmail($user){
        return $this->loginModel->get_user_email($user);
    }
    public function get_mail_Verified($user){
        return $this->loginModel->get_mail_verified($user);
    }
}

$objeto2=new LoginController();

$action= $_GET['action'] ?? 'principal';

    switch ($action){

        case 'iniciar_sesion':    
            $objeto2->login();
            
            break;

    }




//echo "El correo es: ".$array1[0]['email'];//Resultado ok para fetchAll.
//echo "El correo es: ".$array1['email'];//Resultado ok para fetch.
//echo "El correo es: ".$array1; //Resultado ok para fetchColumn(1);




//función verrificar ✓✓
//función getUserEmail ✓✓

        
?>