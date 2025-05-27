<?php
    class RankingModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
//====================================================================================================================
         public function rankingAsistencia($deportista_id){
        $queryAsistencia = "SELECT asistencia.id_deportista AS id_deportista, deportista.nombres AS nombreD, 
                            deportista.apellidos AS apellidoD, deportista.foto AS foto, 
                            clubes.nombreClub AS club, estimulos.tipo_estimulo AS estimulo, 
                            COUNT(*) AS cantidad FROM asistencia
                            INNER JOIN deportista ON asistencia.id_deportista= deportista.id
                            INNER JOIN estimulos ON asistencia.codigo_estimulo= estimulos.codigo
                            INNER JOIN clubes ON deportista.codigo_club = clubes.codigo
                            WHERE asistencia.id_deportista = ?
                            GROUP BY estimulo";
        $stmt = $this->conn->prepare($queryAsistencia);
        $stmt->execute([$deportista_id]);
        $consolidado= $stmt->fetchAll(PDO::FETCH_ASSOC);
//====================================================================================================
        $bonificacion=[
                        "actuación destacada  *"=>1,
                        "actuación muy destacada  **"=>2,
                        "actuación excepcional  ***"=>3,
                        "performance normal"=>0
                        ];
         $total_global=0;
         $total_asistencias=0;
         foreach($consolidado as $index=> $fila){
            $estimulo= $fila['estimulo'];
            $ptosx_sesion= 1 + $bonificacion[$estimulo];
            $total_puntos= $ptosx_sesion * $fila['cantidad'];
            $consolidado[$index]['total_puntos']= $total_puntos;
            $total_global+=$total_puntos;
            $total_asistencias+=$fila['cantidad'];
        }
// echo "<pre>";
// print_r($total_asistencias);
//    print_r($consolidado);
//    print_r($total_global); // o cualquier otra variable
// echo "</pre>";
          if (!empty($consolidado)) {
            return [
            'id_deportista' => $consolidado[0]['id_deportista'],
            'deportista' => $consolidado[0]['nombreD'] . " " . $consolidado[0]['apellidoD'],
            'total_asistencias' => $total_asistencias,
            'detalle' => $consolidado,
            'foto' => $consolidado[0]['foto'] ?? '',
            'club' => $consolidado[0]['club'] ?? '',
            'total_asistencias_mensaje' => "El puntaje del deportista " . $consolidado[0]['nombreD'] . " " . $consolidado[0]['apellidoD'] . " es : " . $total_global . " puntos.",
            'total_eventos' => $total_global,
            'tipo' => 'success'
            ];
        } else {
            return [
            'total_asistencias' => 0,
            'detalle' => [],
            'total_asistencias_mensaje' => "No hay datos registrados para este deportista. Puntaje: 0.",
            'total_eventos' => 0,
            'tipo' => 'error' // podrías usar 'warning' o 'info' según cómo manejes los tipos
        ];
}     
    }
//================================================================================================
//================================================================================================
public function rankingEventos($deportista_id) {
    // Consulta de total eventos por tipo y posición
    $sql = "SELECT actuaciones.id_deportista AS id_deportista, 
            deportista.nombres AS nombreD, deportista.apellidos AS apellidoD,
            deportista.foto AS foto, clubes.nombreClub AS club,
            tipo_evento.tipo_evento AS tipo_evento,
            actuaciones.posicion AS posicion,        
            COUNT(*) AS cantidad FROM actuaciones
            INNER JOIN eventos ON actuaciones.codigo_evento = eventos.codigo
            INNER JOIN tipo_evento ON eventos.codigo_tipoE = tipo_evento.codigo
            INNER JOIN deportista ON actuaciones.id_deportista = deportista.id
            INNER JOIN clubes ON deportista.codigo_club = clubes.codigo
            WHERE actuaciones.id_deportista = ?
            GROUP BY tipo_evento.tipo_evento, actuaciones.posicion
            ORDER BY tipo_evento.tipo_evento, actuaciones.posicion";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$deportista_id]);
    $consolidado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //==============================================================================

    // Diagnóstico: imprimir resultado de la consulta
    //echo "<pre>";     print_r($consolidado);     echo "</pre>";

    // Puntos base por tipo de evento
    $valores_evento = [
        'Campeonato Internacional' => 20,
        'Campeonato Nacional' => 10,
        'Copa Colombia' => 8,
        'Campeonato Departamental' => 4,
        'Municipal' => 2,
        'Intercambio' => 2
    ];

    // Multiplicadores por posición
    $multiplicadores_posicion = [
        1 => 4,
        2 => 2.5,
        3 => 2
    ];

    // Inicializar total global
    $total_global = 0;
    $cant_eventos=0;

    // Calcular puntos y total global
    foreach ($consolidado as $index => $fila) {
        $tipo = $fila['tipo_evento'];
        $pos = $fila['posicion'];

        $puntos_base = $valores_evento[$tipo] ?? 0;
        $multiplicador = $multiplicadores_posicion[$pos] ?? 1;

        $puntos = $puntos_base * $multiplicador;
        $total_puntos = $puntos * $fila['cantidad'];

        $consolidado[$index]['puntos'] = $puntos;
        $consolidado[$index]['total_puntos'] = $total_puntos;
        $cant_eventos+= $fila['cantidad'];
        $total_global += $total_puntos;
    }

    // echo "<pre>";
    //     print_r($consolidado);
    //     print_r($total_global); // o cualquier otra variable
    // echo "</pre>";
   if (!empty($consolidado)) {
    return [
        'id_deportista'=> $consolidado[0]['id_deportista'],
        'deportista'=> $consolidado[0]['nombreD'] . " " . $consolidado[0]['apellidoD'],
        'detalle' => $consolidado,
        'foto' => $consolidado[0]['foto'] ?? '',
        'club' => $consolidado[0]['club'] ?? '',
        'total_eventos_mensaje' => "El puntaje del deportista " . $consolidado[0]['nombreD'] . " " . $consolidado[0]['apellidoD'] . " es : " . $total_global . " puntos.",
        'total_eventos' => $total_global,
        'tipo' => 'success',
        'eventos' => $cant_eventos
    ];
} else {
    return [
        'detalle' => [],
        'total_eventos_mensaje' => "No hay datos registrados para este deportista. Puntaje: 0.",
        'total_eventos' => 0,
        'tipo' => 'error', // podrías usar 'warning' o 'info' según cómo manejes los tipos
        'eventos' => 0
    ];
}

}
}


?>
