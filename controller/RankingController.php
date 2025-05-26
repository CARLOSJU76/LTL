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
    public function ranking(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idDeportista = $_POST['idDeportista'];
        $asistencia = $this->Ranking_Model->rankingAsistencia($idDeportista);
        $eventos = $this->Ranking_Model->rankingEventos($idDeportista);

        // Obtenemos los puntajes, usando 0 como valor por defecto si están vacíos
        $totalAsistencia = $asistencia['total_eventos'] ?? 0;
        $totalEventos = $eventos['total_eventos'] ?? 0;

        $ranking = $totalAsistencia + $totalEventos;

        // Determinar el nombre del deportista dependiendo de qué datos estén disponibles
        if (!empty($asistencia['deportista'])) {
            $deportista = $asistencia['deportista'] ?? " ";
        } elseif (!empty($eventos['deportista'])) {
            $deportista = $eventos['deportista'] ?? " ";
        } else {
            $deportista = " ";
        }
        if (!empty($asistencia['id_deportista'])) {
            $id_deportista=$asistencia['id_deportista'] ?? 0;
        } elseif (!empty($eventos['id_deportista'])) {
            $id_deportista=$eventos['id_deportista'] ?? 0;
        } else {
            $id_deportista = 0;
        }

        return [
            'id_deportista' => $id_deportista,
            'deportista' => $deportista,
            'ranking' => $ranking,
            'total_asistencias' => $totalAsistencia,
            'detalle'=>"El(la) deportista $deportista tiene: $totalAsistencia puntos por asistencias y $totalEventos puntos por eventos.",
            'msg' => "El puntaje del deportista $deportista es: $ranking puntos.",
            'tipo'=> 'success'
        ];        
    }
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
