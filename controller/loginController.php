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
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = $_POST["usuario"];
            $passw = $_POST["passw"];
    
            $array = $this->loginModel->verificar($usuario, $passw);
            $opcion = $array[0];
            $user1 = $array[1];
            $perfil = $array[2];
            $email= $array[3];

            if($opcion=== 5){
                $opcion=5;
            }else if($opcion=== 1){
                $estado = $this->loginModel->get_mail_verified($usuario);
                if($estado === 1){
                    $opcion = 1;
                    
                                 }else {
                    $opcion = -2;
                }
            }else{
                $opcion=0;
            }

            $this->objeto->notifilogin($opcion, $user1, $perfil, $email);
          
        }
    }
   
//=================================================RECUPERACIÓN DE CONTRASEÑA============================
    public function recover_pass_request(){
        $error=0;
        
        if (isset($_GET['email']) && !empty($_GET['email'])) {
// Capturamos el correo desde la URL
            $usuario = $_GET['email'];

            $datos=$this->loginModel->get_user_email($usuario);
            
            return $datos;
        }else{
            return $error;
        }

    }
//==================================================ESTABLECER NUEVA CONTRASEÑA==========================
    public function establecer_newpass(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $usuario=$_POST["usuario"];
            $clave=$_POST['clave'];
            $confirm=$_POST['confirm'];

            if($confirm===$clave){
                if($this->loginModel->setPass($usuario, $clave)){
                  echo"<div class='success'>La contraseña ha sido reestablecida exitosamente.<br>
                            <a href='index.php?actio=principal'>Volver a la página de inicio</a>
                        </div>";
                }else{
                    echo"hubo un error al tratar de actualizar la contraseña";
                }
            }else{
                echo "Los campos de las contraseñas deben coincidir";
            }
        }
    }
    public function getUserEmail($usuario){
        return $this->loginModel->get_user_email($usuario);

    }
    public function getPerfil($email){
        return $this->loginModel->getPerfil($email);
    }
    public function get_email_user(){
    // Verificar si se ha enviado el valor
        if (isset($_POST['valor'])) {
        $email_user = $_POST['valor'];

        return $email_user;
        
        }
    }  
}
    ?>           