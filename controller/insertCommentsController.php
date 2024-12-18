<?php

include_once('./config/Conexion.php');
include_once('./models/insertCommentsModel.php');
include_once('./funciones/funciones.php');

class InsertCommentsController {
    private $db;
    private $insertCommentsModel;
    private $objeto;

    public function __construct(){
        $database= new Conexion();
        $this->db= $database->getConnection();
        $this->insertCommentsModel= new InsertCommentsModel($this->db);
        $this->objeto= new objeto();
    }
    public function insertCommment(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $autor=$_POST['autor'];
            $comentario=$_POST['comentario'];

    $estado= $this->insertCommentsModel->insertComment( $comentario, $autor);

    $this->objeto->noticomment($estado);
        }
    }
}

?>