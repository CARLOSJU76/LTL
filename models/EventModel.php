<?php
    class EventModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
//================================================================================================================
        public function insertEvento($tipoE, $nombreEvento, $pais, $departamento, $ciudad, $fecha,
                                     $categoria_Edad) {
            try {
                $consulta = "INSERT INTO eventos (codigo_tipoE, nombre_Evento, id_pais, id_departamento,
                             codigo_ciudad,fecha_Evento, codigo_categoriaxEdad) VALUES (?,?,?,?,?,?,?)";
                $resultado=$stmt = $this->conn->prepare($consulta);
                $stmt->execute([$tipoE, $nombreEvento, $pais, $departamento, $ciudad, $fecha,
                                $categoria_Edad]);

// Verificamos si la inserción fue exitosa.
                 if ($resultado) {
                         return true;
                 } else {
                         return false;
                 }
                 } catch (PDOException $e) {
 // Capturamos cualquier error de base de datos y lo retornamos.
                 error_log("Error al insertar deportista: " . $e->getMessage());
                 return false;
                }
    }
//==================================================================================================================      
        public function listEventosById($id_event){
            $consulta= "SELECT eventos.codigo AS id_ev, tipo_evento.tipo_evento AS tipoEv,
                eventos.nombre_Evento AS nombreEv, eventos.fecha_Evento AS fechaEv,
                ciudad.ciudad AS ciudadEv, departamento.departamento AS dptoEv,
                pais.pais AS paisEv, categoriaxedad.categoria AS cateEv FROM eventos

                INNER JOIN tipo_evento ON eventos.codigo_tipoE= tipo_evento.codigo
                INNER JOIN ciudad ON eventos.codigo_ciudad= ciudad.codigo
                INNER JOIN departamento ON eventos.id_departamento = departamento.id
                INNER JOIN pais ON eventos.id_pais = pais.id
                INNER JOIN categoriaxedad ON eventos.codigo_categoriaxEdad= categoriaxedad.id
                WHERE eventos.codigo LIKE ? ORDER BY eventos.fecha_Evento ASC"; ;
           
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute(['%' . $id_event . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }
//=================================================================================================================
public function buscarEvento($id_event) {
    $consulta = "SELECT eventos.codigo AS id_ev, tipo_evento.tipo_evento AS tipoEv,
                eventos.nombre_Evento AS nombreEv, eventos.fecha_Evento AS fechaEv,
                ciudad.ciudad AS ciudadEv, departamento.departamento AS dptoEv,
                pais.pais AS paisEv, categoriaxedad.categoria AS cateEv 
                FROM eventos
                INNER JOIN tipo_evento ON eventos.codigo_tipoE= tipo_evento.codigo
                INNER JOIN ciudad ON eventos.codigo_ciudad= ciudad.codigo
                INNER JOIN departamento ON eventos.id_departamento = departamento.id
                INNER JOIN pais ON eventos.id_pais = pais.id
                INNER JOIN categoriaxedad ON eventos.codigo_categoriaxEdad= categoriaxedad.id
                WHERE eventos.codigo = ?" ;
    
    $stmt = $this->conn->prepare($consulta);
    $stmt->execute([$id_event]);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificar si se obtuvieron resultados
    if (count($result) > 0) {
        return ['tipo' => "success", 'msg'=>"La operación ha dado resultados.", 'data' => $result];
    } else {
        return ['tipo' => "error", 'msg' => 'No se encontraron se encontraro eventos.'];
    }
}
//=============================================================================================================    
public function deleteEvento($id_evento) {
    try {
        $query = "DELETE FROM eventos WHERE codigo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_evento]);

        // Verificar si se eliminó al menos un registro
        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        // Puedes registrar el error si lo deseas, por ejemplo: error_log($e->getMessage());
        return false;
    }
}

//===================================================================================================================


    public function getEventos(){
        $consulta= "SELECT codigo, nombre_Evento, fecha_Evento, codigo_categoriaxEdad FROM eventos ORDER BY fecha_Evento ASC";
        $stmt= $this->conn->prepare($consulta);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
//=================================================================================================================
        public function updateEvento($tipoE, $nombreEvento, $pais, $departamento, $ciudad, $fecha,
                                     $categoria_Edad, $id_evento) {
            
           try  {$consulta = "UPDATE eventos SET codigo_tipoE =?, nombre_Evento =?, id_pais = ?, id_departamento = ?,
                             codigo_ciudad = ?, fecha_Evento = ?, codigo_categoriaxEdad = ? WHERE codigo = ? ";
                $resultado=$stmt = $this->conn->prepare($consulta);
                $stmt->execute([$tipoE, $nombreEvento, $pais, $departamento, $ciudad, $fecha,
                                $categoria_Edad,$id_evento]);
                if ($resultado) {
                        return true;
                } else {
                        return false;
                }
                } catch (PDOException $e) {
            // Capturamos cualquier error de base de datos y lo retornamos.
                            error_log("Error al insertar deportista: " . $e->getMessage());
                            return false;
                }
        }
//==================================================================================================================

//===================================================================================================================
public function registrarActuacion($codigo_Evento, $id_deportistas, $modalidades, $categoriasxPeso, $posiciones) {
    try {
        $this->conn->beginTransaction();

        $verifi_act = "SELECT COUNT(*) FROM actuaciones WHERE codigo_evento = ? AND id_deportista = ?";
        $stmtVerifi = $this->conn->prepare($verifi_act);

        $insert_act = "INSERT INTO actuaciones (codigo_evento, id_deportista, codigo_Modalidad, codigo_categoriaxPeso, posicion) 
                       VALUES (?, ?, ?, ?, ?)";
        $stmtInsercion = $this->conn->prepare($insert_act);

        // 🔁 Nuevo statement para actualizar
        $update_act = "UPDATE actuaciones 
                       SET codigo_Modalidad = ?, codigo_categoriaxPeso = ?, posicion = ? 
                       WHERE codigo_evento = ? AND id_deportista = ?";
        $stmtActualizacion = $this->conn->prepare($update_act);

        $registrosInsertados = 0;
        $registrosActualizados = 0;

        foreach ($id_deportistas as $index => $id_deportista) {
            $stmtVerifi->execute([$codigo_Evento, $id_deportista]);
            $existe = $stmtVerifi->fetchColumn();

            $codigoModalidad = is_array($modalidades) ? $modalidades[$index] : $modalidades;
            $codigoCategoria = is_array($categoriasxPeso) ? $categoriasxPeso[$index] : $categoriasxPeso;
            $posicion = is_array($posiciones) ? $posiciones[$index] : $posiciones;

            if ($existe == 0) {
                $resultado = $stmtInsercion->execute([
                    $codigo_Evento,
                    $id_deportista,
                    $codigoModalidad,
                    $codigoCategoria,
                    $posicion
                ]);
                if ($resultado) {
                    $registrosInsertados++;
                }
            } else {
                // 🔁 Actualizar los datos si ya existe
                $resultado = $stmtActualizacion->execute([
                    $codigoModalidad,
                    $codigoCategoria,
                    $posicion,
                    $codigo_Evento,
                    $id_deportista
                ]);
                if ($resultado) {
                    $registrosActualizados++;
                }
            }
        }

        if ($registrosInsertados > 0 || $registrosActualizados > 0) {
            $this->conn->commit();
        } else {
            $this->conn->rollBack();
        }

        return [
            'insertados' => $registrosInsertados,
            'actualizados' => $registrosActualizados
        ];
    } catch (PDOException $e) {
        $this->conn->rollBack();
        error_log("Error al registrar actuación: " . $e->getMessage());
        return false;
    }
}
public function showPerformanceByEvent($codigo){
    $consulta= "SELECT actuaciones.codigo AS id_actuacion, eventos.nombre_Evento AS nombre_Evento, 
                deportista.nombres AS nombreD, deportista.apellidos AS apellidoD,
                modalidad.modalidad AS modalidad, categoriaxpeso.categoriaxPeso AS division,
                actuaciones.posicion AS posicion FROM actuaciones
                INNER JOIN eventos ON actuaciones.codigo_evento = eventos.codigo
                INNER JOIN deportista ON actuaciones.id_deportista = deportista.id
                INNER JOIN modalidad ON actuaciones.codigo_Modalidad = modalidad.id
                INNER JOIN categoriaxpeso ON actuaciones.codigo_categoriaxPeso = categoriaxPeso.codigo
                WHERE eventos.codigo = ?";
    $stmt= $this->conn->prepare($consulta);
    $stmt->execute([$codigo]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);            
}
public function showPerformanceByAthlete($email){
    $consulta= "SELECT actuaciones.codigo AS id_actuacion, eventos.nombre_Evento AS nombre_Evento, 
                deportista.nombres AS nombreD, deportista.apellidos AS apellidoD,
                deportista.email AS emailD, modalidad.modalidad AS modalidad, 
                categoriaxpeso.categoriaxPeso AS division,
                actuaciones.posicion AS posicion FROM actuaciones
                INNER JOIN eventos ON actuaciones.codigo_evento = eventos.codigo
                INNER JOIN deportista ON actuaciones.id_deportista = deportista.id
                INNER JOIN modalidad ON actuaciones.codigo_Modalidad = modalidad.id
                INNER JOIN categoriaxpeso ON actuaciones.codigo_categoriaxPeso = categoriaxPeso.codigo
                WHERE deportista.email= ?";
    $stmt= $this->conn->prepare($consulta);
    $stmt->execute([$email]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    }
?>