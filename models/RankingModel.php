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
            JOIN tipo_evento ON eventos.codigo_tipoE = tipo_evento.codigo
            WHERE actuaciones.id_deportista = ?";
        $stmt = $this->conn->prepare($queryActuaciones);
        $stmt->execute([$idDeportista]);
        $actuaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($actuaciones as $row) {
            $tipoEvento = strtolower(trim($row['tipo_evento']));
            $posicion = (int)$row['posicion'];

            $puntosBase = match ($tipoEvento) {
                'campeonato internacional' => 20,
                'campeonato nacional' => 10,
                'campeonato departamental' => 5,
                'campeonato municipal' => 3,
                'intercambio' => 2,
                default => 0
            };

            if ($tipoEvento !== 'intercambio') {
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
}
?>