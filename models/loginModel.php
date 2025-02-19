<?php
    class LoginModel{
        private $conn;
        public function __construct($db){
            $this->conn= $db;
        }
//===========================================================================================
        //FUNCIONES EMPLEADAS EN EL LOGIN:
        function verificar($usuario, $passw) {
            $datos = [];
            $opcion = 0;
            $user1 = "";
            $perfil = null;
        
            // Verificar si el usuario existe
            $verificar = $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ? OR email = ? LIMIT 1");
            $verificar->execute([$usuario, $usuario]);
            $conteo = (int)$verificar->fetchColumn();
        
            if ($conteo < 1) {
                $opcion = 5; // Usuario no encontrado
            } else {
                // Obtener la información del usuario
                $consulta = $this->conn->prepare("SELECT passw, usuario, email FROM usuarios WHERE usuario = ? OR email = ?");
                $consulta->execute([$usuario, $usuario]);
                $row = $consulta->fetch(PDO::FETCH_ASSOC);
        
                if ($row) { // Solo accede a los datos si $row tiene información
                    $clave = $row['passw'];
                    $user1 = $row['usuario'];
                    $email = $row['email'];
                    $perfil=$this->getPerfil($email);
        
                    if (password_verify($passw, $clave)) {
                        $opcion = 1; // Contraseña correcta
                    } else {
                        $opcion = 0; // Contraseña incorrecta
                    }
                } else {
                    $opcion = 5; // El usuario no se encuentra registrado...
                }
            }

            // Retornar los datos
            array_push($datos, $opcion, $user1, $perfil);
            return $datos;
        }
//=============================================================================================     
        public function get_mail_verified($usuario){
            $stmt=$this->conn->prepare("SELECT mail_verified FROM usuarios WHERE email= ? OR usuario= ?");
            $stmt->execute([$usuario, $usuario]);
            $estado = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch como arreglo asociativo
            return isset($estado['mail_verified']) ? (int)$estado['mail_verified'] : 0; 
        }
        public function get_user_email($usuario){
            $stmt= $this->conn->prepare("SELECT email, usuario FROM usuarios WHERE email= ? OR usuario= ? LIMIT 1");
            $stmt->execute([$usuario, $usuario]);
            $datos= $stmt->fetch(PDO::FETCH_ASSOC);
            return $datos;
        }
        public function setPass($email, $clave){
            
            $encriptada = password_hash($clave, PASSWORD_DEFAULT);    
            $stmt= $this->conn->prepare("UPDATE usuarios set passw= ? where email= ? or usuario= ?");
           if($stmt->execute([$encriptada, $email, $email]) )            {
            return true;
           }else{
            return false;
           }
        }
        public function getPerfil($email){

            $verificar = $this->conn->prepare("SELECT COUNT(*) FROM perfil WHERE  email = ?");
            $verificar->execute([$email]);
            $conteo = (int)$verificar->fetchColumn();

            if($conteo<1 or $conteo== null){
                return 1;
            }else{
                $consulta=$this->conn->prepare("SELECT perfil FROM perfil WHERE email= ?");
            $consulta->execute([$email]);
            $perfil= $consulta->fetch(PDO::FETCH_ASSOC);
            return (int) $perfil['perfil'];
            }

            
        }
    }




    
?>