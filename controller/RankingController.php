<?php
include_once('./models/RankingModel.php');

class RankingController {
    private $db;
    private $Ranking_Model;

    public function __construct(){
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->Ranking_Model = new RankingModel($this->db);
    }
    public function rankingAsistencia(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $idDeportista=$_POST['idDeportista'];
            return $this->Ranking_Model->rankingAsistencia($idDeportista);
        }
    }
//=========================================================================================================
//=========================================================================================================
    public function rankingEventos(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $idDeportista = $_POST['idDeportista'];
            
            return $this->Ranking_Model->rankingEventos($idDeportista);
           
        }
    }
}
?>
