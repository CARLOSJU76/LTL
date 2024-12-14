<?php
    class SignupModel{
        private $conn;
        private $usuarios= 'usuarios';
        private $ocmentarios='comentarios';
        private $dando_like='dando_like';
        

        public function __construct($db){
            $this->conn=$db;
        }
        
// FUNCIONES EMPLEADAS EN REGISTRO DE USUARIOS:
    //función para verificar credenciales de usuario y email.
function verificarCredenciales($user,  $email){
    $conteo=0;
    $verificar= $this->conn->prepare("SELECT COUNT(*) FROM usuarios where usuario= ? || email= ?");
       
    $verificar->execute([$user, $email]);
    $conteo = $verificar->fetchColumn();

    return $conteo;
}

    //función para encriptar contraseña y realizar registro: 
    
    function registrando($conteo, $user, $email, $clave) {
        if ($conteo === 0) {
            $query = 0;
            // Encriptamos la contraseña
            $encriptada = password_hash($clave, PASSWORD_DEFAULT);
    
            // Preparamos la consulta
            $consulta = $this->conn->prepare("INSERT INTO usuarios (usuario, email, passw) VALUES (?, ?, ?)");
            
            // Ejecutamos la consulta y verificamos si fue exitosa
            $resultado = $consulta->execute([$user, $email, $encriptada]);
    
            // Si la inserción fue exitosa, asignamos 1 a $query
            if ($resultado) {
                $query = 1;
            }
    
            // No es necesario cerrar la consulta manualmente en PDO, pero si lo haces, asegúrate de que no interfiera
            // $consulta->close(); // Opcional, no es necesario en PDO
        } else {
            // Si ya existe el usuario o el email, asignamos -1 a $query
            $query = -1;
        }
    
        // Retornamos el valor de $query (0, 1 o -1)
            return $query;
        }
    }
?>