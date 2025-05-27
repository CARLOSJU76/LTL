<?php
include_once('./models/RankingModel.php');
include_once('./models/DeportistaModel.php');

class RankingController {
    private $db;
    private $Ranking_Model;
    private $Deportista_Model;

    public function __construct(){
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->Ranking_Model = new RankingModel($this->db);
        $this->Deportista_Model = new DeportistaModel($this->db);

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
    public function listaRanking(){
        if($_SERVER["REQUEST_METHOD"] == "GET") {
            $deportistas= $this->Deportista_Model->listSportman();
            //==============Preparando los arrays para el ranking=========================
            $lista_ranking=[];
            $lista_asistencia=[];
            $lista_eventos=[];
        //==================Calculando el ranking de cada deportista=========================
            foreach ($deportistas as $index => $deportista) {
                $id_deportista=$deportista['id'];
                $asistencia= $this->Ranking_Model->rankingAsistencia($id_deportista);
                $eventos= $this->Ranking_Model->rankingEventos($id_deportista);
                $nombreD= $asistencia['deportista'] ?? $eventos['deportista'] ?? " ";// Obteniendo el nombre del deportista, si no existe se asigna un espacio en blanco
                $foto= $asistencia['foto'] ?? $eventos['foto'] ?? " ";// Obteniendo la foto del deportista, si no existe se asigna un espacio en blanco
                $club= $asistencia['club'] ?? $eventos['club'] ?? " ";// Obteniendo el club del deportista, si no existe se asigna un espacio en blanco
                $p_asistencia[$index]=$asistencia['total_eventos'];//Obteniendo los puntajes de asistencia
                $p_eventos[$index]=$eventos['total_eventos'];// Obteniendo los puntajes de eventos
                $p_ranking[$index]= $asistencia['total_eventos'] + $eventos['total_eventos'];// CObteniendo los puntajes de ranking
//==================Asignando los puntajes a los arrays===================================================================================
                $lista_ranking[$index]= ['nombre' => $nombreD, 'puntos_ranking' => $p_ranking[$index], 'foto' => $foto, 'club' => $club];
                $lista_asistencia[$index]= ['nombre' => $nombreD, 'puntos_asistencia' => $p_asistencia[$index], 'foto' => $foto, 'club' => $club];
                $lista_eventos[$index]= ['nombre' => $nombreD, 'puntos_eventos' => $p_eventos[$index], 'foto' => $foto, 'club' => $club];
            }
//==================Ordenando los arrays por puntajes=====================================================================================
           
            usort($lista_ranking, fn($a, $b) => $b['puntos_ranking'] <=> $a['puntos_ranking']);
            usort($lista_asistencia, fn($a, $b) => $b['puntos_asistencia'] <=> $a['puntos_asistencia']);
            usort($lista_eventos, fn($a, $b) => $b['puntos_eventos'] <=> $a['puntos_eventos']);
        }
// echo "<pre>";
//     print_r($lista_ranking);
// echo "</pre>";
        return [
            'lista_ranking' => $lista_ranking,
            'lista_asistencia' => $lista_asistencia,
            'lista_eventos' => $lista_eventos
        ];
    }
}
?>
