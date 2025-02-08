<?php
    class InsertCommentsModel{
        private $conn;

        public function __construct($db){
            $this->conn=$db;
        }
        public function insertComment($comentario, $autor){
            try {
                // Preparar la consulta con placeholders
                $consulta = $this->conn->prepare("INSERT INTO comentarios(comentario, autor) VALUES (?, ?)");
                
                // Ejecutar la consulta con los parámetros
                $resultado = $consulta->execute([$comentario, $autor]);
                
                // Retornar 1 si la ejecución fue exitosa, de lo contrario 0
                if ($resultado) {
                    return 1;  // Éxito
                } else {
                    return 0;  // Fallo
                }
            } catch (Exception $e) {
                // Si ocurre alguna excepción, retornar 0
                return 0;
            }
        }
        // Función para verificar si el usuario ya ha dado like al comentario hoy
     
    //================================================================================================================================
    public function verificarLikeHoy($idComentario, $liker, $fecha) {
        $conteoLike = 0;
    
        // Consulta SQL usando un parámetro para evitar inyecciones SQL
        $consulta = $this->conn->prepare ("SELECT COUNT(*) FROM dando_like WHERE id_comentario = ? AND liker = ? AND fecha = ? ");

        $consulta->execute([$idComentario, $liker, $fecha]);
        
        $conteoLike = $consulta->fetchColumn();


        if ($conteoLike === 0 || $conteoLike=== null || $conteoLike=== false) {
    // Si no hay resultados, hacer algo
            $conteoLike = 0; // O cualquier otro valor o comportamiento que desees
        }else{
            $conteoLike=1;
        }

        return $conteoLike;

    }
//=========================================================================================================================

//=========================================================================================================================
    // Función para registrar el like en la base de datos
    public function registrarLike($idComentario, $liker, $fechaA, $horaA) {
        
    
            // Primer consulta: Insertar el like
            $consulta =$this->conn->prepare("INSERT INTO dando_like (id_comentario, liker, fecha, hora) VALUES (?, ?, ?, ?)");
            $consulta->execute([$idComentario,$liker, $fechaA, $horaA]);

            $consuLike=$this->conn->prepare("UPDATE comentarios SET likes= likes +1 WHERE id= ?");

            $consuLike->execute([$idComentario]);

        }
    }
    
?>