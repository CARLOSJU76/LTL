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
                pais.pais AS paisEv, categoria_edad.nombre_Categoria AS cateEv FROM eventos

                INNER JOIN tipo_evento ON eventos.codigo_tipoE= tipo_evento.codigo
                INNER JOIN ciudad ON eventos.codigo_ciudad= ciudad.codigo
                INNER JOIN departamento ON eventos.id_departamento = departamento.id
                INNER JOIN pais ON eventos.id_pais = pais.id
                INNER JOIN categoria_edad ON eventos.codigo_categoriaxEdad= categoria_edad.codigo
                WHERE eventos.codigo LIKE ?" ;
           
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute(['%' . $id_event . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }
//=================================================================================================================
        public function buscarEvento($id_event){
            $consulta= "SELECT eventos.codigo AS id_ev, tipo_evento.tipo_evento AS tipoEv,
                eventos.nombre_Evento AS nombreEv, eventos.fecha_Evento AS fechaEv,
                ciudad.ciudad AS ciudadEv, departamento.departamento AS dptoEv,
                pais.pais AS paisEv, categoria_edad.nombre_Categoria AS cateEv FROM eventos

                INNER JOIN tipo_evento ON eventos.codigo_tipoE= tipo_evento.codigo
                INNER JOIN ciudad ON eventos.codigo_ciudad= ciudad.codigo
                INNER JOIN departamento ON eventos.id_departamento = departamento.id
                INNER JOIN pais ON eventos.id_pais = pais.id
                INNER JOIN categoria_edad ON eventos.codigo_categoriaxEdad= categoria_edad.codigo
                WHERE eventos.codigo = ?" ;
           
        $stmt= $this->conn->prepare($consulta);
        $stmt->execute([$id_event]);
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
        public function deleteEvento($id_evento){
            $query= "DELETE FROM eventos WHERE codigo = ?";
            $stmt= $this->conn->prepare($query);
            $stmt->execute([$id_evento]);   
        }
//===================================================================================================================
    }
?>