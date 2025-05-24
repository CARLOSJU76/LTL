<?php
    class RankingModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
//====================================================================================================================
         public function rankingAsistencia($deportista_id){
        $queryAsistencia = "SELECT deportista.nombres AS nombreD, deportista.apellidos AS apellidoD,
                            estimulos.tipo_estimulo AS estimulo, COUNT(*) AS cantidad FROM asistencia
                            INNER JOIN deportista ON asistencia.id_deportista= deportista.id
                            INNER JOIN estimulos ON asistencia.codigo_estimulo= estimulos.codigo
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
         foreach($consolidado as $index=> $fila){
            $estimulo= $fila['estimulo'];
            $ptosx_sesion= 1 + $bonificacion[$estimulo];
            $total_puntos= $ptosx_sesion * $fila['cantidad'];
            $consolidado[$index]['total_puntos']= $total_puntos;
            $total_global+=$total_puntos;
        }
echo "<pre>";
    print_r($consolidado);
    print_r($total_global); // o cualquier otra variable
echo "</pre>";
          if (!empty($consolidado)) {
            return [
            'detalle' => $consolidado,
            'total_asistencias_mensaje' => "El puntaje del deportista " . $consolidado[1]['nombreD'] . " " . $consolidado[1]['apellidoD'] . " es : " . $total_global . " puntos.",
            'total_eventos' => $total_global,
            'tipo' => 'success'
            ];
        } else {
            return [
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
    $sql = "SELECT tipo_evento.tipo_evento AS tipo_evento, actuaciones.posicion AS posicion,
            deportista.nombres AS nombreD, deportista.apellidos AS apellidoD,
            COUNT(*) AS cantidad FROM actuaciones
            INNER JOIN eventos ON actuaciones.codigo_evento = eventos.codigo
            INNER JOIN tipo_evento ON eventos.codigo_tipoE = tipo_evento.codigo
            INNER JOIN deportista ON actuaciones.id_deportista = deportista.id
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

        $total_global += $total_puntos;
    }

    // echo "<pre>";
    //     print_r($consolidado);
    //     print_r($total_global); // o cualquier otra variable
    //     echo "</pre>";
   if (!empty($consolidado)) {
    return [
        'detalle' => $consolidado,
        'total_eventos_mensaje' => "El puntaje del deportista " . $consolidado[0]['nombreD'] . " " . $consolidado[0]['apellidoD'] . " es : " . $total_global . " puntos.",
        'total_eventos' => $total_global,
        'tipo' => 'success'
    ];
} else {
    return [
        'detalle' => [],
        'total_eventos_mensaje' => "No hay datos registrados para este deportista. Puntaje: 0.",
        'total_eventos' => 0,
        'tipo' => 'error' // podrías usar 'warning' o 'info' según cómo manejes los tipos
    ];
}

}
}


?>
