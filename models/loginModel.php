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
            $consulta = $this->conn->prepare("SELECT passw, usuario FROM usuarios WHERE usuario = ? OR email = ?");
            $consulta->execute([$usuario, $usuario]);
            
            // Ejecutar la consulta
            $consulta->execute();
            
            // Verificar si se obtuvo algún resultado
            if ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $clave = $row['passw'];
                $user1 = $row['usuario'];
                
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
            array_push($datos, $opcion, $user1);
            return $datos;
        }

    }
        
?>