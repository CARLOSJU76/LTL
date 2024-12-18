<?php

include_once('./models/getCommentsModel.php');

class GetCommentsController {
    private $db;
    private $getCommentsModel;

    public function __construct() {
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->getCommentsModel = new GetCommentsModel($this->db);
    }

    public function getComments() {
        header('Content-Type: application/json'); 
        // Obtener los comentarios del modelo
        $comentarios= $this->getCommentsModel->get_comments();
        echo json_encode($comentarios);
        exit; // Detener la ejecución del script aquí si solo se busca devolver comentarios en JSON
    }
}
?>
