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
                $perfil= 00000;
                $user1 = "desconocido";
                $email = "desconocido";
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
                } 
            }

            // Retornar los datos
            array_push($datos, $opcion, $user1, $perfil, $email);
            return $datos;
        }
//=============================================================================================
public function verificarUser($usuario){
    $stmt= $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email= ? OR usuario= ? LIMIT 1");
    $stmt->execute([$usuario, $usuario]);
    $conteo = (int)$stmt->fetchColumn();
    if($conteo<1){
        $conteo=5;
    }else{
        $conteo=1;
    }
    return $conteo;
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
        public function setPass($email, $clave){
            
            $encriptada = password_hash($clave, PASSWORD_DEFAULT); 
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt= $this->conn->prepare("UPDATE usuarios set passw= ? where email= ? or usuario= ?");
                $stmt->execute([$encriptada, $email, $email]);
                if (!$stmt) {
                        return [
                                'msg' => "Error al preparar la consulta.",
                                'tipo' => "error"
                        ];
                }
                if($stmt->execute([$encriptada, $email, $email])){   
                        return [
                                'msg' => "El cambio de contraseña fué exitoso.",
                                'tipo' => "success"
                        ];
                }else{
                        $error = $stmt->errorInfo();
                        return [
                                'msg' => "Error al tratar de cambiar la contraseña: " . $error[2],
                                'tipo' => "error"
                    ];
                }
            
            }catch (PDOException $e) {
                error_log("Error al tratar de cambiar la contraseña: " . $e->getMessage());
                return [
                        'msg' => "Error al tratar de cambiar la contraseña: " . $e->getMessage(),
                        'tipo' => "error"
                ];
            }
    }
    public function cambiar_pass($email, $actual, $nueva){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $this->conn->prepare("SELECT passw FROM usuarios WHERE email = ? OR usuario = ?");
                $stmt->execute([$email, $email]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if ($row && password_verify($actual, $row['passw'])) {
                    // La contraseña actual es correcta, proceder a cambiarla
                    $nueva_encriptada = password_hash($nueva, PASSWORD_DEFAULT);
                    $update_stmt = $this->conn->prepare("UPDATE usuarios SET passw = ? WHERE email = ? OR usuario = ?");
                    $update_stmt->execute([$nueva_encriptada, $email, $email]);
                    if (!$update_stmt) {
                        return [
                                'msg' => "Error al preparar la consulta.",
                                'tipo' => "error"
                        ];
                    }
                    if($update_stmt->execute([$nueva_encriptada, $email, $email])){   
                        return [
                                'msg' => "La contraseña ha sido modificada exitosamente.",
                                'tipo' => "success"
                        ];
                    }else{
                        $error = $stmt->errorInfo();
                        return [
                                'msg' => "Error al tratar de modificar la contraseña." . $error[2],
                                'tipo' => "error"
                        ];
                    }   
                } else {
                    // La contraseña actual no es correcta
                    return [
                        'msg' => "La contraseña es incorrecta.",
                        'tipo' => "error"
                    ];
                }
            }catch (PDOException $e) {
                error_log("Error al tratar de modificar la contraseña: " . $e->getMessage());
                return [
                        'msg' => "Error al tratar de modificar la contraseña: " . $e->getMessage(),
                        'tipo' => "error"
                ];
            }
        }



    }




    
?>