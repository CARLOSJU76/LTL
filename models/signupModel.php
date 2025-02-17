<?php

include_once 'funciones/Mailer.php';

    class SignupModel{
        private $conn;
        private $token;
        
             

        public function __construct($db){
            $this->conn=$db;
            $this->token=self::generateRandomString(20);
                        
        }
        
// FUNCIONES EMPLEADAS EN REGISTRO DE USUARIOS:
    //función para verificar credenciales de usuario y email.
    function verificarCredenciales($user, $email) { 
        $conteo = 0;
    
        // Usamos el operador OR en lugar de ||
        $verificar = $this->conn->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ? OR email = ?");
    
        // Ejecutamos la consulta
        $verificar->execute([$user, $email]);
    
        // Obtenemos el número de registros encontrados
        $conteo = $verificar->fetchColumn();
    
        // Retornamos el conteo (si hay un error, fetchColumn() retornará false, lo que podría ser manejado)
        return (int)$conteo;  // Convertir explícitamente a int por claridad
    }
    
    function registrando($conteo, $user, $email, $clave) {
      
        
        // Verificar si ya existe el usuario o el correo
        if ($conteo > 0) {
            // Si el conteo es mayor que 0, significa que ya existe el usuario o el email
            return -1;  // Usuario o email ya registrado
        }
    
        try {
            $token=$this->getToken();
            // Encriptamos la contraseña
            $encriptada = password_hash($clave, PASSWORD_DEFAULT);
    
            // Preparamos la consulta para insertar el usuario
            $consulta = $this->conn->prepare("INSERT INTO usuarios (usuario, email, passw, token) VALUES (?,?,?,?)");
    
            // Ejecutamos la consulta
            $resultado = $consulta->execute([$user, $email, $encriptada, $token]);
    
            // Si la inserción fue exitosa
            if ($resultado) {
                return 1;  // Usuario insertado correctamente
            } else {
                return 0;  // Error al insertar el usuario
            }
        } catch (PDOException $e) {
            // Si ocurre un error con la base de datos
            error_log("Error al registrar usuario: " . $e->getMessage());
            return 0;  // Retornar 0 en caso de error
        }
    }
    public function verifyEmail( $token){        
        $stmt=$this->conn->prepare("UPDATE usuarios SET mail_verified=1 WHERE token= ?");
        $stmt->execute([$token]);
    }
    public  function findByToken($token)
    {
        $stmt =$this->conn->prepare("SELECT email, usuario FROM usuarios WHERE token = ? LIMIT 1");
        $stmt->execute([$token]);
        $mail= $stmt->fetch();
        return $mail;
    }
    public static function generateRandomString($length = 20) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $chars[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public  function getToken(){
        return $this->token;
    }
    public function setPerfil($email){
        $conteo=0;
        $verificar= $this->conn->prepare("SELECT COUNT(*) FROM perfil WHERE email= ?");
        $verificar->execute([$email]);
        $conteo=$verificar->fetchColumn();
        if($conteo<1){
            $perfil=1;
            $setPerfiL= $this->conn->prepare("INSERT INTO perfil (email, perfil) VALUES (?,?)");
            $setPerfiL->execute([$email, $perfil]);
        }else{
            $agregar=$this->conn->prepare("UPDATE perfil SET perfil= perfil + 1 WHERE email = ?");
            $agregar->execute([$email]);
        }
    }

}
?>