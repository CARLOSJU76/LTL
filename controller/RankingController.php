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
    public function calcularRanking() {
       if($_SERVER["REQUEST_METHOD"] == "POST") {
            $idDeportista = $_POST['idDeportista'];
            $resultado = $this->Ranking_Model->calcularRanking($idDeportista);
            if ($resultado) {
              return [
                'tipo' => 'success',
                'data' => $resultado,
                'msg' => 'El puntaje del deportista es ' . $resultado,
               ];
            } else {
               return [
                    'tipo' => 'error',
                'msg' => 'Error al calcular el ranking.'
                ];
            }
        } else {
           return [
                'tipo' => 'error',
                'msg' => 'Método no permitido.'
            ];
        }
    }
    public function rankingEventos(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $idDeportista = $_POST['idDeportista'];
            
            return $this->Ranking_Model->rankingEventos($idDeportista);
           
        }
    }
}
?>
