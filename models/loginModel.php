<?php
    class LoginModel{
        private $conn;
        public function __construct($db){
            $this->conn= $db;
        }
        //FUNCIONES EMPLEADAS EN EL LOGIN:
        function verificar($usuario, $passw) {
            $datos = [];
            $clave = "";
            $user1 = "";
            
            
            // Consulta utilizando PDO
            $consulta = $this->conn->prepare("SELECT passw, usuario, id_perfil FROM usuarios WHERE usuario = ? OR email = ?");
            $consulta->execute([$usuario, $usuario]);
            
            // Ejecutar la consulta
            $consulta->execute();
            
            // Verificar si se obtuvo algún resultado
            if ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $clave = $row['passw'];
                $user1 = $row['usuario'];
                $perfil= $row['id_perfil'];
                
                // Verificar si la contraseña es correcta
                if (password_verify($passw, $clave)) {
                    $opcion = 1; // Contraseña correcta
                } else {
                    $opcion = 0; // Contraseña incorrecta
                }
            } else {
                $opcion = -1; // No se encontró el usuario o email
            }
            
            // Devolver los resultados en un array
            array_push($datos, $opcion, $user1, $perfil);
            return $datos;
        }
        public function get_mail_verified($usuario){
            $stmt=$this->conn->prepare("SELECT mail_verified FROM usuarios WHERE email= ? OR usuario= ?");
            $stmt->execute([$usuario, $usuario]);
            $estado = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch como arreglo asociativo
            return isset($estado['mail_verified']) ? (int)$estado['mail_verified'] : 0; 
        }
        public function get_user_email($usuario){
            $stmt= $this->conn->prepare("SELECT email, usuario FROM usuarios WHERE email= ? OR usuario= ?");
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
    }
        
?>