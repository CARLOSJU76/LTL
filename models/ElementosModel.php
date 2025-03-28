<?php
    class ElementosModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }

//==================================================================================================================

        public function insertPais($pais){
            $consulta="INSERT INTO pais (pais) VALUES (?)";
                $stmt=$this->conn->query($consulta);
                $stmt->execute([$pais]);
        }
        
        public function getPaises(){
                    $consulta= ("SELECT * FROM pais");
                    $stmt=$this->conn->query($consulta);

                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         public function insertDpto($id_pais, $dep){
                $query="INSERT INTO departamento (id-_pais, departamento) VALUES (?, ?)";
                $stmt=$this->conn->qurey($query);
                $stmt->execute([$id_pais, $dep]);
         }
         public function getDpto($id_pais){
                $consulta=("SELECT * FROM departamento WHERE id_pais = ? ");
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id_pais]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         public function insertCiudad($id_dep,$ciudad){
            $query="INSERT INTO departamento (id-_departamento, ciudad) VALUES (?, ?)";
            $stmt=$this->conn->qurey($query);
            $stmt->execute([$id_dep, $ciudad]);
        }
        public function getCiudad($id_dpto){
            $query=$this->conn->prepare("SELECT * FROM ciudad WHERE id_departamento= ?");
            $query->execute([$id_dpto]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getModalidades(){
            $consulta="SELECT * FROM modalidad";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getTipoEvento(){
            $consulta="SELECT * FROM tipo_evento";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }                                                                      
//====================================================================================================
        /*public function getAgeCat(){
            try{ $consulta="SELECT * FROM categoriaxedad ORDER BY id ASC";
                $resultado= $stmt= $this->conn->prepare($consulta);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if($resultado){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException){
                error_log("Error al recolectar los datos: ".  $e->getMessage());
            }
        }*/
//==================================================================================================
public function getAgeCat(){//categoriaxEdad
    $consulta="SELECT * FROM categoriaxedad ORDER BY id ASC";
    $stmt= $this->conn->query($consulta);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//===================================================================================================
        public function insertAgeCat($categoriaxEdad){
            $consulta = $this->conn->prepare("INSERT INTO categoriaxedad (categoria) VALUES (?)");
            $consulta->execute([$categoriaxEdad]);
        }
//=====================================================================================================
        public function insertModalidad($modalidad){
            $consulta = $this->conn->prepare("INSERT INTO modalidad (modalidad) VALUES (?)");
            $consulta->execute([$modalidad]);
        }
        public function getModalidad(){//Get Modalidad
            $consulta="SELECT * FROM modalidad";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
//======================================================================================================
        public function insertDivisionPeso($divisioxPeso, $id_ce, $id_mod){
            $consulta = $this->conn->prepare("INSERT INTO categoriaxpeso (categoriaxPeso, id_ce, id_mod) VALUES (?,?,?)");
            $consulta->execute([$divisioxPeso, $id_ce, $id_mod]);
        }
        public function getDivisionPeso(){
            $consulta="SELECT * FROM categoriaxpeso ORDER BY categoriaxPeso ASC";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
         public function getDivisionesById($id_ce, $id_mod){
            $consulta="SELECT * FROM categoriaxpeso  where id_ce = ? AND id_mod= ? ORDER BY categoriaxPeso ASC";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id_ce, $id_mod]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function deleteCategoria($codigo){
            $consulta="DELETE FROM categoriaxedad WHERE id = ?";
            $stmt=$this->conn->prepare($consulta);
            $stmt->execute([$codigo]);
        }
        public function deleteModalidad($id_modalidad){
            $consulta="DELETE FROM modalidad WHERE id = ? ";
            $stmt=$this->conn->prepare($consulta);
            $stmt->execute([$id_modalidad]);
        }
        public function deleteDivision($codigo_division){
            $consulta="DELETE FROM categoriaxpeso WHERE codigo = ? ";
            $stmt=$this->conn->prepare($consulta);
            $stmt->execute([$codigo_division]);
        }
        public function cargarEstados($nualidad, $pdf){
            try{$consulta =("INSERT INTO estadosf (nualidad, pdf) VALUES (?, ?)");
            $resultado=$stmt= $this->conn->prepare($consulta);
            $stmt->execute([$nualidad, $pdf]);
            if ($resultado) {
                return true;
        } else {
                return false;
        }
            }catch (PDOException $e) {
                // Capturamos cualquier error de base de datos y lo retornamos.
                            error_log("Error al insertar deportista: " . $e->getMessage());
                            return false;
            }

        }
        public function listarEstadosF(){
            $consulta= "SELECT * FROM estadosf";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getEstadosById($id){
            $consulta="SELECT nualidad, pdf FROM estadosf WHERE id= ?";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getMision(){
            $consulta="SELECT mision FROM mision";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getVision(){
            $consulta="SELECT vision FROM mision";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function updateMision($nueva_mision){
            try{ $consulta = "UPDATE mision SET mision = ? WHERE id=1";
            $resultado=$stmt= $this->conn->prepare($consulta);
            $stmt->execute([$nueva_mision]);
            if ($resultado) {
                return true;
        } else {
                return false;
        }
            }catch (PDOException $e) {
                // Capturamos cualquier error de base de datos y lo retornamos.
                            error_log("Error al insertar deportista: " . $e->getMessage());
                            return false;
            }

        }
        public function updateVision($nueva_vision){
            try{ $consulta = "UPDATE mision SET vision = ? WHERE id=1";
            $resultado=$stmt= $this->conn->prepare($consulta);
            $stmt->execute([$nueva_vision]);
            if ($resultado) {
                return true;
        } else {
                return false;
        }
            }catch (PDOException $e) {
                // Capturamos cualquier error de base de datos y lo retornamos.
                            error_log("Error al actualizar la visión: " . $e->getMessage());
                            return false;
            }

        }
        public function insertLugar($lugar, $id_pais, $id_dpto, $id_ciudad){
            try{$consulta= "INSERT INTO lugar_entrenamiento (lugar, id_pais, id_dpto, id_ciudad) VALUES (?,?,?,?)";
                $resultado= $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$lugar, $id_pais, $id_dpto, $id_ciudad]);
                if($resultado){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                error_log("Error al actualizar la visión: " . $e->getMessage());
                return false;
            }
        }
        public function getLugares($id){
            $consulta = "SELECT lugar_entrenamiento.id AS id, lugar_entrenamiento. lugar AS lugar, pais.pais AS pais, 
            departamento.departamento AS dpto, ciudad.ciudad AS ciudad from lugar_entrenamiento 
            INNER JOIN pais ON lugar_entrenamiento.id_pais= pais.id 
            INNER JOIN departamento ON lugar_entrenamiento.id_dpto= departamento.id
            INNER JOIN ciudad ON lugar_entrenamiento.id_ciudad= ciudad.codigo
            WHERE lugar_entrenamiento.id LIKE ? ";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute(['%' . $id . '%']);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function buscarLugar($id){
            $consulta = "SELECT lugar_entrenamiento. lugar AS lugar, pais.pais AS pais, 
            departamento.departamento AS dpto, ciudad.ciudad AS ciudad from lugar_entrenamiento 
            INNER JOIN pais ON lugar_entrenamiento.id_pais= pais.id 
            INNER JOIN departamento ON lugar_entrenamiento.id_dpto= departamento.id
            INNER JOIN ciudad ON lugar_entrenamiento.id_ciudad= ciudad.codigo
            WHERE lugar_entrenamiento.id = ? ";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function delete_lugar($id_lugar){
           try{$consulta = "DELETE FROM lugar_entrenamiento where id = ?";
            $resultado= $stmt=$this->conn->prepare($consulta);
            $stmt->execute([$id_lugar]);
            if($resultado){
                return true;
            }else{
                return false;
            }
           }catch(PDOException $e) {
                            error_log("Error al actualizar la visión: " . $e->getMessage());
                            return false;
           }
        }
        public function insertSession($email_entrenador, $id_lugar, $fecha, $hora){
            try{
                $consulta="INSERT INTO sesiones (email_entrenador, id_lugar, fecha, hora) VALUES (?,?,?,?)";
                $resultado= $stmt=$this->conn->prepare($consulta);
                $stmt->execute([$email_entrenador, $id_lugar, $fecha, $hora]);
                if($resultado){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e) {
                error_log("Error al actualizar la visión: " . $e->getMessage());
                return false;
            }
        }
        public function listSessionByDate($fechaA, $fechaB){
            try{
                $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                            entrenadores.apellidos AS apellidoE, sesiones.email_entrenador AS email, 
                            lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones INNER JOIN entrenadores
                            ON entrenadores.id= sesiones.id_entrenador INNER JOIN lugar_entrenamiento
                            ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE sesiones.fecha >= ? AND 
                            sesiones.fecha <= ?  ORDER BY fecha ASC";
                    $resultado= $stmt= $this->conn->prepare($consulta);
                        $stmt->execute([$fechaA, $fechaB]);
                        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                    if($resultado){
                        return true;
                    }else{
                        return false;
                    }
            }catch(PDOException $e) {
                error_log("Error al actualizar la visión: " . $e->getMessage());
                return false;
            }
        }
//===================================Esta función para perfil Deportista:===============
        public function listSessionbyTrainer($id_entrenador){
            try{
                $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                            entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones INNER JOIN entrenadores
                            ON entrenadores.id= sesiones.id_entrenador INNER JOIN lugar_entrenamiento
                            ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE sesiones.id_entrenador= ? ORDER BY sesiones. ASC, sesiones.hora ASC";
                    $resultado= $stmt= $this->conn->prepare($consulta);
                        $stmt->execute([$id_entrenador]);
                        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                    if($resultado){
                        return true;
                    }else{
                        return false;
                    }
            }catch(PDOException $e) {
                error_log("Error al actualizar la visión: " . $e->getMessage());
                return false;
            }
    } 
//====================================================================================
public function listSessionsBySite($id_lugar, $fechaA, $horaA){
    try{
        $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                    entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                    sesiones.fecha AS fecha, sesiones.hora AS hora,
                    sesiones.email_entrenador AS email FROM sesiones 
                    INNER JOIN entrenadores
                    ON entrenadores.email= sesiones.email_entrenador 
                    INNER JOIN lugar_entrenamiento
                    ON sesiones.id_lugar= lugar_entrenamiento.id
                    WHERE sesiones.id_lugar= ? AND (sesiones.fecha > ?
                    OR (sesiones.fecha = ? AND sesiones.hora >= ?))
                    ORDER BY sesiones.fecha ASC, sesiones.hora ASC";
            $resultado= $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$id_lugar, $fechaA, $fechaA,$horaA]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC); 
            if($resultado){
                return true;
            }else{
                return false;
            }
    }catch(PDOException $e) {
        error_log("Error al actualizar la visión: " . $e->getMessage());
        return false;
    }
}
//=====================================================================================
    public function listYourSessions($email,$fechaA,$horaA){
        try{
            $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                        entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                        sesiones.fecha AS fecha, sesiones.hora AS hora 
                        FROM sesiones INNER JOIN entrenadores
                        ON entrenadores.email= sesiones.email_entrenador INNER JOIN lugar_entrenamiento
                        ON sesiones.id_lugar= lugar_entrenamiento.id
                        WHERE sesiones.email_entrenador= ?  AND (sesiones.fecha > ?
                        OR (sesiones.fecha = ? AND sesiones.hora >= ?))
                        ORDER BY sesiones.fecha ASC, sesiones.hora ASC";
                $resultado= $stmt= $this->conn->prepare($consulta);
                    $stmt->execute([$email, $fechaA, $fechaA,$horaA]);
                    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                if($resultado){
                    return true;
                }else{
                    return false;
                }
        }catch(PDOException $e) {
            error_log("Error al actualizar la visión: " . $e->getMessage());
            return false;
        }
    }
    public function listYourSession_for_Attendance($hoy,$email) {
        try{$consulta="SELECT codigo, fecha, hora FROM sesiones WHERE fecha= ? AND email_entrenador=?";
            $resultado= $stmt=$this->conn->prepare($consulta);
            $stmt->execute([$hoy, $email]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($resultado){
                    return true;
                }else{
                    return false;
                }
        }catch(PDOException $e) {
            error_log("Error al actualizar la visión: " . $e->getMessage());
            return false;
        }
    }
    public function deleteSession($id){
        try{$consulta="DELETE FROM sesiones WHERE codigo= ?";
            $resultado= $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id]);
            if($resultado){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e) {
            error_log("Error al tratar de borrar la sesión programada: " . $e->getMessage());
            return false;
        }
    }
    public function registrarAsistencia($id_sesion, $id_deportistas) {
        try {
            // Iniciar la transacción
            $this->conn->beginTransaction();
    
            // Preparar la consulta para verificar si ya existe una entrada en la base de datos
            $consultaVerificacion = "SELECT COUNT(*) FROM asistencia WHERE codigo_sesion = ? AND id_deportista = ?";
            $stmtVerificacion = $this->conn->prepare($consultaVerificacion);
    
            // Preparar la consulta de inserción
            $consultaInsercion = "INSERT INTO asistencia (codigo_sesion, id_deportista) VALUES (?, ?)";
            $stmtInsercion = $this->conn->prepare($consultaInsercion);
    
            // Variable para contar cuántos registros fueron insertados
            $registrosInsertados = 0;
    
            // Recorrer los deportistas seleccionados
            foreach ($id_deportistas as $id_deportista) {
                // Verificar si el deportista ya está registrado en la sesión
                $stmtVerificacion->execute([$id_sesion, $id_deportista]);
                $existe = $stmtVerificacion->fetchColumn();
    
                if ($existe == 0) {  // Si no existe el registro
                    // Ejecutar la inserción
                    $resultado = $stmtInsercion->execute([$id_sesion, $id_deportista]);
                    if ($resultado) {
                        $registrosInsertados++;
                    }
                }
            }
    
            // Si se insertaron registros, confirmar la transacción
            if ($registrosInsertados > 0) {
                $this->conn->commit();
                return true;
            } else {
                // Si no se insertaron registros (todos estaban duplicados), revertir la transacción
                $this->conn->rollBack();
                return false;
            }
    
        } catch (PDOException $e) {
            // Si ocurre un error, revertir la transacción
            $this->conn->rollBack();
            error_log("Error al tratar de registrar la asistencia: " . $e->getMessage());
            return false;
        }
    }
    public function listWorkOuts($fecha1, $fecha2){
        try{
        $consulta= "SELECT asistencia.codigo AS id, sesiones.fecha AS fecha, 
                    sesiones.hora AS hora, lugar_entrenamiento.lugar AS lugar,
                    entrenadores.nombres AS nombreE, entrenadores.apellidos AS apellidoE,
                    COUNT(asistencia.codigo) AS total_asistentes
                    FROM asistencia INNER JOIN sesiones 
                    ON asistencia.codigo_sesion=sesiones.codigo 
                    INNER JOIN lugar_entrenamiento ON sesiones.id_lugar= lugar_entrenamiento.id
                    INNER JOIN entrenadores ON sesiones.id_entrenador= entrenadores.id 
                    WHERE fecha >= ? AND fecha<=? GROUP BY sesiones.codigo";
        
            $resultado= $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$fecha1, $fecha2]);
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if($resultado){
                        return true;
                    }else{
                        return false;
                    }

            }catch (PDOException $e) {
           
                error_log("Error al tratar de obtener los registros." . $e->getMessage());
                return false;
            }
    }
    public function listMyAttendans($email_entrenador){
        $consulta= "SELECT sesiones.codigo AS codigo,
                    entrenadores.email AS email, sesiones.fecha AS fecha,
                    sesiones.hora as hora FROM  sesiones                    
                    INNER JOIN entrenadores ON entrenadores.email= sesiones.email_entrenador
                    INNER JOIN asistencia ON asistencia.codigo_sesion = sesiones.codigo
                    WHERE entrenadores.email= ?
                    GROUP BY sesiones.codigo, entrenadores.email, sesiones.fecha, sesiones.hora";
            $resultado= $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$email_entrenador]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function asistenciaxSesion($id_sesion){
        try {
            $consulta = "SELECT asistencia.codigo AS id, 
                                deportista.nombres AS nombreD,
                                deportista.apellidos AS apellidoD
                         FROM asistencia 
                         INNER JOIN deportista
                         ON asistencia.id_deportista = deportista.id
                         WHERE asistencia.codigo_sesion = ? ";
    
            $stmt = $this->conn->prepare($consulta);
            $stmt->execute([$id_sesion]);
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Verifica si se obtuvieron resultados antes de retornarlos
            return $resultado !== false ? $resultado : [];
    
        } catch (PDOException $e) {
            error_log("Error al tratar de obtener los registros: " . $e->getMessage());
            return [];
        }
    }
    
}
    

?>