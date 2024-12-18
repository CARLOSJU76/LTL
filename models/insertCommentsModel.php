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
        
    }
?>