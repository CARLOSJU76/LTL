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
//==================================================================================================================================
    public function darLike($fechaA, $horaA) {  
        header('Content-Type: application/json'); 
        $data = json_decode(file_get_contents('php://input'), true);
       
        $idComentario = $data['id'];
        $liker = $data['name'];
        $currentDate = $data['currentDate'];

        // Verificar si ya se dio like hoy
        $likeCount = $this->insertCommentsModel->verificarLikeHoy($idComentario, $liker, $currentDate);
        if($likeCount===0){
            $this->insertCommentsModel->registrarLike($idComentario, $liker, $fechaA, $horaA);
            echo json_encode(array('status' => 'success', 'message' => 'Acabas de dar like !! '.$likeCount));
            
        }else{
            echo json_encode(array('status' => 'error', 'message' => "Ya has dado like a este comentario hoy. $likeCount"));  
        } 
    }
//===================================================================================================================================
}

?>