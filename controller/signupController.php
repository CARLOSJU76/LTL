<?php
    include_once('./config/Conexion.php');
    include_once('./models/signupModel.php');
    include_once('./funciones/funciones.php');

    class SignupController{
        private $db;
        private $signUpModel;
        private $objeto;

        // public function dashboard(){
        //     require_once('./views/dashboard.html');

        // }
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
                echo json_encode(array('status'=> 'error','message'=> 'Los campos de las contraseñas deben tener el mismo valor', 'conteo'=>$conteo));
            }else{
                $conteo=$this->signUpModel->verificarCredenciales($user, $email);
                //$this->userModel->registrando($conteo,$user, $email, $clave);
                $registrando= $this->signUpModel->registrando($conteo,$user, $email, $clave);
                $this->objeto->notificacion($registrando, $user);
            }     
            
           
        }
//        
    
 }
?>