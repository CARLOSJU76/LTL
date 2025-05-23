<?php
    class RankingModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }

//====================================================================================================================
         public function calcularRanking($idDeportista)
    {
        $puntos = 0;

        // 1. Puntos por asistencia: 1 punto por cada registro
        $queryAsistencia = "SELECT COUNT(*) AS total FROM asistencia WHERE id_deportista = ?";
        $stmt = $this->conn->prepare($queryAsistencia);
        $stmt->execute([$idDeportista]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $puntos += (int)$result['total'];

        // 2. Puntos por estímulos
        $queryEstimulos = "
            SELECT e.codigo 
            FROM asistencia a
            INNER JOIN estimulos e ON a.codigo_estimulo = e.codigo
            WHERE a.id_deportista = ?";
        $stmt = $this->conn->prepare($queryEstimulos);
        $stmt->execute([$idDeportista]);
        $estimulos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($estimulos as $row) {
            switch ((int)$row['codigo']) {
                case 1:
                    $puntos += 1;
                    break;
                case 2:
                    $puntos += 2;
                    break;
                case 3:
                    $puntos += 3;
                    break;
            }
        }

        // 3. Puntos por actuaciones en eventos
        $queryActuaciones = "
            SELECT actuaciones.posicion, tipo_evento.tipo_evento 
            FROM actuaciones
            INNER JOIN eventos ON actuaciones.codigo_Evento = eventos.codigo
            INNER JOIN tipo_evento ON eventos.codigo_tipoE = tipo_evento.codigo
            WHERE actuaciones.id_deportista = ?";
        $stmt = $this->conn->prepare($queryActuaciones);
        $stmt->execute([$idDeportista]);
        $actuaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($actuaciones as $row) {
            $tipoEvento = strtolower(trim($row['tipo_evento']));
            $posicion = (int)$row['posicion'];

            $puntosBase = match ($tipoEvento) {
                'Campeonato Internacional' => 20,
                'Campeonato Nacional' => 10,
                'Campeonato Departamental' => 5,
                'Campeonato Municipal' => 3,
                'Intercambio' => 2,
                default => 0
            };

            if ($tipoEvento !== 'Intercambio') {
                switch ($posicion) {
                    case 1:
                        $puntosBase *= 4;
                        break;
                    case 2:
                        $puntosBase *= 2;
                        break;
                    case 3:
                        $puntosBase *= 1.5;
                        break;
                }
            }

            $puntos += $puntosBase;
        }

        return $puntos;
    }
    public function rankingAsistencias($deportista_id) {
    // Consulta de total asistencias
    $asistencias = "SELECT COUNT(*) AS total_asistencias FROM asistencias WHERE id_deportista = ?";
    $stmt = $this->conn->prepare($asistencias);
    $stmt->execute([$deportista_id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_asistencias = isset($resultado['total_asistencias']) ? (int)$resultado['total_asistencias'] : 0;

    // Estímulo tipo 1
    $estimulos1 = "SELECT COUNT(*) AS total_E1 FROM asistencias WHERE codigo_estimulo = 1 AND id_deportista = ?";
    $stmt1 = $this->conn->prepare($estimulos1);
    $stmt1->execute([$deportista_id]);
    $resultado1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $total_E1 = isset($resultado1['total_E1']) ? (int)$resultado1['total_E1'] : 0;

    // Estímulo tipo 2
    $estimulos2 = "SELECT COUNT(*) AS total_E2 FROM asistencias WHERE codigo_estimulo = 2 AND id_deportista = ?";
    $stmt2 = $this->conn->prepare($estimulos2);
    $stmt2->execute([$deportista_id]);
    $resultado2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $total_E2 = isset($resultado2['total_E2']) ? (int)$resultado2['total_E2'] : 0;

    // Estímulo tipo 3
    $estimulos3 = "SELECT COUNT(*) AS total_E3 FROM asistencias WHERE codigo_estimulo = 3 AND id_deportista = ?";
    $stmt3 = $this->conn->prepare($estimulos3);
    $stmt3->execute([$deportista_id]);
    $resultado3 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $total_E3 = isset($resultado3['total_E3']) ? (int)$resultado3['total_E3'] : 0;

    // Retornar todo como arreglo para usarlo más adelante
    return [
        'total_asistencias' => $total_asistencias,
        'total_E1' => $total_E1,
        'total_E2' => $total_E2,
        'total_E3' => $total_E3
    ];
}
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
    return [
        'detalle' => $consolidado,
        'total_eventos_mensaje' =>"El puntaje del deportista ".$consolidado[0]['nombreD']. " " . $consolidado[0]['apellidoD']." es : ". $total_global ." puntos." ,
        'total_eventos' => $total_global,
        'tipo' => 'success'
    ];
}
}


?>
