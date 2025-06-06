<?php

    include_once('./config/Conexion.php');
    include_once('./models/signupModel.php');
    include_once('./funciones/funciones.php');
    include_once ('funciones/Mailer.php');
    include 'vendor/autoload.php';

    class SignupController{
        private $db;
        private $signUpModel;
        private $objeto;
        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->signUpModel= new SignupModel($this->db);
            $this->objeto= new objeto();
        }
        public function registrar(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $user=$_POST['username'];
                $email= $_POST['email'];
                $clave=$_POST['password'];
                $confirmacion=$_POST['confirmacion'];                   
            }
            $conteo=$this->objeto->clavesIguales($clave, $confirmacion);
            if($conteo===0){
                echo json_encode(array('status'=> 'error','message'=> 'Los campos de las contraseñas deben tener el mismo valor', 'conteo'=>$conteo));//hasta aquí todo bien!!
            }else{
                $conteo=$this->signUpModel->verificarCredenciales($user, $email);
                //$this->userModel->registrando($conteo,$user, $email, $clave);
                if($registrando= $this->signUpModel->registrando($conteo,$user, $email, $clave)){
                    $token=$this->signUpModel->getToken();
                    $envio_mail=new Mailer();
                      $this->signUpModel->setPerfil($email);
                    $envio_mail->sendVerificationMail($email,  $token,$user);            
                    $this->objeto->notificacion($registrando, $user);
                }   
            }   
        }
        public function verificarCuenta() {
            $datos = []; // Inicializar como array vacío
        
            // Verificar que la solicitud sea GET
            if ($_SERVER["REQUEST_METHOD"] == "GET")  {
                $token = isset($_GET['token']) ? $_GET['token'] : null;
        
                if ($token) {
                    // Buscar datos relacionados con el token
                    $datos = $this->signUpModel->findByToken($token);
        
                    if ($datos) {
                        $email = $datos['email'];
        
                        if ($email) {
                            $this->signUpModel->verifyEmail($token);
                        
                            $datos['estado'] = 1;
                        } else {
                            $datos['estado'] = 0;
                        }
                    } else {
                        $datos = []; // Reasignar como array si findByToken devolvió false
                        $datos['estado'] = -1;
                    }
                } else {
                    $datos['estado'] = -2;
                }
            } else {
                $datos['estado'] = -3;
            }
        
            return $datos;
        }
        
        public function setPerfil($email){
            $this->signUpModel->setPerfil($email);
        }
    }  
?>
