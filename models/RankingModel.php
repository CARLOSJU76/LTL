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

public function rankingInter($deportista_id) {
    $inter = "SELECT actuaciones.posicion 
              FROM actuaciones 
              INNER JOIN eventos ON actuaciones.codigo_evento = eventos.codigo
              WHERE eventos.codigo_tipoE = 10 AND actuaciones.id_deportista = ?";

    $stmt = $this->conn->prepare($inter);
    $stmt->execute([$deportista_id]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $total_inter = count($resultados);

    // Extraer posiciones
    $posiciones = array_map(function($fila) {
        return (int)$fila['posicion'];
    }, $resultados);

    // Calcular puntaje total según la posición
    $puntaje_total = 0;
    foreach ($posiciones as $posicion) {
        if ($posicion == 1) {
            $puntaje_total += 10;
        } elseif ($posicion == 2) {
            $puntaje_total += 8;
        } elseif ($posicion == 3) {
            $puntaje_total += 6;
        } elseif ($posicion == 4) {
            $puntaje_total += 4;
        } else {
            $puntaje_total += 2;
        }
    }

    return [
        'total_inter' => $total_inter,
        'posiciones' => $posiciones,
        'puntaje_total' => $puntaje_total
    ];
}


}
?>