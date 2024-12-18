<?php
    class getCommentsModel{
        private $conn;
        public function __construct($db){
            $this->conn= $db;
        }
        
        public function get_comments(){
           
            //try {
                // Consulta para obtener los comentarios
                $consulta = $this->conn->prepare("SELECT id, comentario, autor, fecha_hora, likes FROM comentarios ORDER BY fecha_hora DESC");
                
                // Ejecutar la consulta
                $consulta->execute();
                
                // Obtener todos los resultados
                $comentarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
                
                return $comentarios; // Devolver los comentarios
            // } catch (PDOException $e) {
            //     // En caso de error, se captura la excepción
            //     echo json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]);
            //     exit;
            // }
        }
    }