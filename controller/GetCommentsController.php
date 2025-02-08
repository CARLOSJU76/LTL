<?php
include_once('./models/getCommentsModel.php');

class GetCommentsController {
    private $db;
    private $getCommentsModel;

    public function __construct(){
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->getCommentsModel = new GetCommentsModel($this->db);
    }

    public function getComments() {
        $comments = $this->getCommentsModel->getComments();
        
        // Si los comentarios existen, enviamos los datos como JSON
        if ($comments) {
            echo json_encode($comments);
        } else {
            echo json_encode(['error' => 'No se pudieron obtener los comentarios.']);
        }
    }
}
?>
