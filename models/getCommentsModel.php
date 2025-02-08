<?php
class GetCommentsModel {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getComments() {
        try {
            // Preparar la consulta
            $sql = "SELECT id, comentario, autor, fecha_hora, likes FROM comentarios ORDER BY fecha_hora DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            // Obtener los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }
     
}
?>
