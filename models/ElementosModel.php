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
public function getAgeCat(){//categoriaxEdad
    $consulta="SELECT * FROM categoriaxedad ORDER BY id ASC";
    $stmt= $this->conn->query($consulta);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//===================================================================================================
public function insertAgeCat($categoriaxEdad){
    try {
        $consulta = $this->conn->prepare("INSERT INTO categoriaxedad (categoria) VALUES (?)");

        // Ejecutar y comprobar si fue exitoso
        if ($consulta->execute([$categoriaxEdad])) {
            return true;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        error_log("Error al insertar categoría por edad: " . $e->getMessage());
        return false;
    }
}

//=====================================================================================================
        public function insertModalidad($modalidad){
           try{
                $consulta = $this->conn->prepare("INSERT INTO modalidad (modalidad) VALUES (?)");
               if( $consulta->execute([$modalidad])){
                    return true;
               }else{
                return false;
               }
           
         }catch (PDOException $e) {
            error_log("Error al insertar categoría por edad: " . $e->getMessage());
            return false;
        }
    }
//=======================================================================================================
        public function getModalidad(){//Get Modalidad
            $consulta="SELECT * FROM modalidad";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
//======================================================================================================
        public function insertDivisionPeso($divisioxPeso, $id_ce, $id_mod){
            try{
                $consulta = $this->conn->prepare("INSERT INTO categoriaxpeso (categoriaxPeso, id_ce, id_mod) VALUES (?,?,?)");
                if($consulta->execute([$divisioxPeso, $id_ce, $id_mod])){
                return true;
                }else{
                return false;
                }
            }catch (PDOException $e){
            error_log("Error al insertar la división por peso: " . $e->getMessage());
            return false;
            }
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
           try{ $consulta="DELETE FROM categoriaxedad WHERE id = ?";
                $stmt=$this->conn->prepare($consulta);
                if($stmt->execute([$codigo])){
                    return true;
                }else{
                    return false;
                }
            }catch (PDOException $e) {
                error_log("Error al tratar de eliminar la Categoría: " . $e->getMessage());
                return false;
            }

        }
        public function deleteModalidad($id_modalidad){
            try{$consulta="DELETE FROM modalidad WHERE id = ? ";
                $stmt=$this->conn->prepare($consulta);
                
                if($stmt->execute([$id_modalidad])){
                    return true;
                }else{
                    return false;
                }

            }catch (PDOException $e) {
                error_log("Error al tratar de eliminar la Modalidad: " . $e->getMessage());
                return false;
            }
        }
        public function deleteDivision($codigo_division){
            try{$consulta="DELETE FROM categoriaxpeso WHERE codigo = ? ";
                $stmt=$this->conn->prepare($consulta);
                if($stmt->execute([$codigo_division])){
                    return true;
                }else{
                    return false;
                }
            }catch (PDOException $e) {
                error_log("Error al tratar de eliminar el elemento: " . $e->getMessage());
                return false;
            }
        }
        public function cargarEstados($nualidad, $pdf){
            try{$consulta =("INSERT INTO estadosf (nualidad, pdf) VALUES (?, ?)");
            $stmt= $this->conn->prepare($consulta);
            
            if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
             if( $stmt->execute([$nualidad, $pdf])){
                    return [
                        'msg' => "El documento fue registrado exitosamente.",
                        'tipo' => "success"
                    ];
                }else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
            }catch (PDOException $e) {
                // Capturamos cualquier error de base de datos y lo retornamos.
                            error_log("Error al tratar de registrar el documento: " . $e->getMessage());
                            return false;
            }

        }
        public function listarEstadosF(){
            $consulta= "SELECT * FROM estadosf";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function updateEstados($pdf, $id){
            try{ 
                 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $consulta = "UPDATE estadosf SET pdf= ? WHERE id= ?";
                $stmt= $this->conn->prepare($consulta);
               
            if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
             if( $stmt->execute([$pdf, $id])){
                    return [
                        'msg' => "El documento fue actualizado exitosamente.",
                        'tipo' => "success"
                    ];
                }else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
            } catch (PDOException $e) {
        error_log("Error al trata de actualizar el documento: " . $e->getMessage());
        return [
            'msg' => "Error al tratar de actualizar el documento: " . $e->getMessage(),
            'tipo' => "error"
        ];
    }
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
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $consulta="INSERT INTO sesiones (email_entrenador, id_lugar, fecha, hora) VALUES (?,?,?,?)";
                $resultado= $stmt=$this->conn->prepare($consulta);
               
                 if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if($stmt->execute([$email_entrenador, $id_lugar, $fecha, $hora])){
                    return [
                        'msg' => "La sesión ha sido registrada y programada con éxito.",
                        'tipo' => "success"
                    ];
                }else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
               
            }catch (PDOException $e) {
                    error_log("Error al intentar registrar la sesión programada: " . $e->getMessage());
                    return [
                        'msg' => "Error al intentar registrar la sesión programada: " . $e->getMessage(),
                        'tipo' => "error"
                    ];
            }
        }
        public function listSessionByDate($fechaA, $fechaB){

           
            try{
                $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                            entrenadores.apellidos AS apellidoE, sesiones.email_entrenador AS email, 
                            lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones 
                            INNER JOIN entrenadores ON entrenadores.email= sesiones.email_entrenador 
                            INNER JOIN lugar_entrenamiento ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE sesiones.fecha >= ? AND sesiones.fecha <= ?  
                            ORDER BY sesiones.fecha ASC";
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
        public function listSessionbyTrainer($id_entrenador,$fechaA, $horaA){
            try{
                  $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                            entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones INNER JOIN entrenadores
                            ON entrenadores.email= sesiones.email_entrenador INNER JOIN lugar_entrenamiento
                            ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE sesiones.email_entrenador= ? AND (sesiones.fecha > ?
                            OR (sesiones.fecha = ? AND sesiones.hora >= ?))
                            ORDER BY sesiones.fecha ASC, sesiones.hora ASC";
                            $stmt= $this->conn->prepare($consulta);
                         
                            $stmt->execute([$id_entrenador,$fechaA,$fechaA, $horaA]);
                              

               if (!$stmt) {
                                    return [
                                            'msg' => "Error al preparar la consulta.",
                                            'tipo' => "error"
                                    ];
                            }
                            if($stmt->execute([$id_entrenador, $fechaA, $fechaA, $horaA])){
                                 $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

                                return [
                                    'msg' => "Sesiones encontradas.",
                                    'tipo' => "success",
                                    'data' => $resultado
                                    ];       
                            }else{
                                $error = $stmt->errorInfo();
                                return [
                                    'msg' => "Error al ejecutar la consulta: " . $error[2],
                                    'tipo' => "error"
                                ];
                            }
        }catch(PDOException $e) {
                error_log("Error al actualizar la visión: " . $e->getMessage());
                return [
                    'msg' => "Error al actualizar la visión: " . $e->getMessage(),
                    'tipo' => "error"
                ];
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
        try{
            
            $consulta="DELETE FROM sesiones WHERE codigo= ?";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id]);
           if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
            }
             if( $stmt->execute([$id])){
                    return [
                        'msg' => "La sesión programada ha sido eliminada con éxito.",
                        'tipo' => "success"
                    ];
                }else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
        }catch (PDOException $e) {
                error_log("Error al intentar borrar la sesión pro: " . $e->getMessage());
                return [
                    'msg' => "Error el intentar borrar la sesión programada: " . $e->getMessage(),
                    'tipo' => "error"
                ];
        }
    }
    public function registrarAsistencia($id_sesion, $id_deportistas) {
        try {
            $this->conn->beginTransaction();
    
            $consultaVerificacion = "SELECT COUNT(*) FROM asistencia WHERE codigo_sesion = ? AND id_deportista = ?";
            $stmtVerificacion = $this->conn->prepare($consultaVerificacion);
    
            $consultaInsercion = "INSERT INTO asistencia (codigo_sesion, id_deportista) VALUES (?, ?)";
            $stmtInsercion = $this->conn->prepare($consultaInsercion);
    
            $registrosInsertados = 0;
            $registrosDuplicados = 0;
    
            foreach ($id_deportistas as $id_deportista) {
                $stmtVerificacion->execute([$id_sesion, $id_deportista]);
                $existe = $stmtVerificacion->fetchColumn();
    
                if ($existe == 0) {
                    $resultado = $stmtInsercion->execute([$id_sesion, $id_deportista]);
                    if ($resultado) {
                        $registrosInsertados++;
                    }
                } else {
                    $registrosDuplicados++;
                }
            }
    
            if ($registrosInsertados > 0) {
                $this->conn->commit();
            } else {
                $this->conn->rollBack();
            }
    
            return [
                'insertados' => $registrosInsertados,
                'duplicados' => $registrosDuplicados
            ];
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error al registrar asistencia: " . $e->getMessage());
            return false;
        }
    }
        public function listWorkOuts($fecha1, $fecha2, $email){
        try{
        $consulta= "SELECT asistencia.codigo AS id, sesiones.fecha AS fecha, 
                    sesiones.hora AS hora, lugar_entrenamiento.lugar AS lugar,
                    entrenadores.nombres AS nombreE, entrenadores.apellidos AS apellidoE,
                    COUNT(asistencia.codigo) AS total_asistentes
                    FROM asistencia INNER JOIN sesiones 
                    ON asistencia.codigo_sesion=sesiones.codigo 
                    INNER JOIN lugar_entrenamiento ON sesiones.id_lugar= lugar_entrenamiento.id
                    INNER JOIN entrenadores ON sesiones.email_entrenador= entrenadores.email
                    WHERE fecha >= ? AND fecha<=? AND sesiones.email_entrenador= ? GROUP BY sesiones.codigo";
        
            $resultado= $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$fecha1, $fecha2, $email]);
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
                                deportista.nombres AS nombreD, deportista.apellidos AS apellidoD, 
                                estimulos.tipo_estimulo AS estimulo,
                                sesiones.fecha AS fecha, sesiones.hora AS hora, 
                                lugar_entrenamiento.lugar AS lugar,
                                entrenadores.nombres AS nombreE, entrenadores.apellidos AS apellidoE
                         FROM asistencia 
                         INNER JOIN deportista ON asistencia.id_deportista = deportista.id
                         INNER JOIN estimulos ON asistencia.codigo_estimulo= estimulos.codigo
                         INNER JOIN sesiones ON asistencia.codigo_sesion= sesiones.codigo
                         INNER JOIN lugar_entrenamiento ON sesiones.id_lugar= lugar_entrenamiento.id
                         INNER JOIN entrenadores ON sesiones.email_entrenador=entrenadores.email
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
    public function otorgarEstimulo($codigo, $codigo_estimulo){
        $consulta= "UPDATE asistencia SET codigo_estimulo= ? WHERE codigo= ?";
        try{
            $resultado= $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$codigo_estimulo, $codigo]);
            if($resultado){
                return true;
            }else{
                return false;
            
            }
        } catch (PDOException $e) {
            error_log("Error al tratar de otorgar el estimulo: " . $e->getMessage());
            return false;
        }
    
    }
    public function getEstimulos(){
        $consulta="SELECT codigo, tipo_estimulo, descripcion FROM estimulos";
        $stmt=$this->conn->query($consulta);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSessionsBySport($id){
            $consulta="SELECT sesiones.fecha as fecha, sesiones.hora as hora,
            lugar_entrenamiento.lugar as lugar, entrenadores.nombres as nombreE,
            entrenadores.apellidos as apellidoE, deportista.nombres as nombreD,
            deportista.apellidos as apellidoD, estimulos.tipo_estimulo as estimulo
            FROM asistencia INNER JOIN sesiones ON asistencia.codigo_sesion= sesiones.codigo
            INNER JOIN lugar_entrenamiento ON sesiones.id_lugar= lugar_entrenamiento.id
            INNER JOIN entrenadores ON sesiones.email_entrenador= entrenadores.email
            INNER JOIN deportista ON asistencia.id_deportista= deportista.id
            INNER JOIN estimulos ON asistencia.codigo_estimulo= estimulos.codigo
            WHERE deportista.id= ? ORDER BY sesiones.fecha ASC, sesiones.hora ASC";
            $stmt= $this->conn->prepare($consulta);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCategoriaxPesoPorEdadYModalidad($id_ce, $id_mod) {
        $sql = "SELECT codigo, categoriaxPeso FROM categoriaxpeso 
                WHERE id_ce = ? AND id_mod = ? ORDER BY categoriaxPeso ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_ce, $id_mod]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sliderItems() {
        $consulta = "SELECT * FROM slider_items ORDER BY creado_en DESC";
        $stmt = $this->conn->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function procesarSlider($tipo, $archivo) {
        try { //$stmt = $conexion->prepare("INSERT INTO slider_items (tipo, archivo) VALUES (?, ?)");
            $consulta = "INSERT INTO slider_items (tipo, archivo) VALUES (?, ?)";
            $stmt = $this->conn->prepare($consulta);
            if ($stmt->execute([$tipo, $archivo])) {
                return [
                    'msg' => "El archivo se ha subido correctamente.",
                    'tipo' => "success"
                ];
            } else {
                return [
                    'msg' => "Error al subir el archivo.",
                    'tipo' => "error"
                ];
            }
        } catch (PDOException $e) {
            error_log("Error al procesar el slider: " . $e->getMessage());
            return [
                'msg' => "Error al procesar el slider: " . $e->getMessage(),
                'tipo' => "error"
            ];
        }
    }
    public function toggleSliderItem($id) {
        try {
            $consulta = "UPDATE slider_items SET activo = NOT activo WHERE id = ?";
            $stmt = $this->conn->prepare($consulta);
            if ($stmt->execute([$id])) {
                return [
                    'msg' => "El estado del slider ha sido actualizado correctamente.",
                    'tipo' => "success"
                ];
            } else {
                return [
                    'msg' => "Error al actualizar el estado del slider.",
                    'tipo' => "error"
                ];
            }
        } catch (PDOException $e) {
            error_log("Error al activar/desactivar el slider: " . $e->getMessage());
            return [
                'msg' => "Error al activar/desactivar el slider: " . $e->getMessage(),
                'tipo' => "error"
            ];
        }
    }
    public function deleteSliderItem($id) {
        try {
            $consulta = "DELETE FROM slider_items WHERE id = ?";
            $stmt = $this->conn->prepare($consulta);
            if ($stmt->execute([$id])) {
                return [
                    'msg' => "El archivo del slider ha sido eliminado correctamente.",
                    'tipo' => "success"
                ];
            } else {
                return [
                    'msg' => "Error al eliminar el archivo del slider.",
                    'tipo' => "error"
                ];
            }
        } catch (PDOException $e) {
            error_log("Error al eliminar el slider: " . $e->getMessage());
            return [
                'msg' => "Error al eliminar el slider: " . $e->getMessage(),
                'tipo' => "error"
            ];
        }
    }
    public function getSliderItems() { //("SELECT * FROM slider_items WHERE activo = 1 ORDER BY creado_en DESC")
        $consulta = "SELECT * FROM slider_items WHERE activo=1  ORDER BY creado_en DESC";
        $stmt = $this->conn->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUnidades(){
        $consulta= "SELECT * FROM unidades";
        $stmt=$this->conn->query($consulta);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function creacionDePruebas($nombre_prueba, $unidades){
        try{
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $consulta= "INSERT INTO r1m (nombre_prueba, unidades_id) values (?, ?)";
              $stmt=$this->conn->prepare($consulta);
           
                if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if($stmt->execute([$nombre_prueba, $unidades])){
                     return [
                        'msg' => "La prueba ha sido creada exitosamente.",
                        'tipo' => "success"
                    ];
                }else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
        }catch (PDOException $e) {
                error_log("Error al tratar de crear la prueba: " . $e->getMessage());
                return [
                    'msg' => "Error al tratar de crear la prueba: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
    }
    public function getTodasLasPruebas(){
        $consulta= "SELECT r1m.id AS id, r1m.nombre_prueba AS nombre_prueba, 
                    unidades.unidades AS unidades FROM
                    r1m INNER JOIN unidades ON r1m.unidades_id= unidades.id";
        $stmt=$this->conn->prepare($consulta);
        $stmt->execute();
       $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";

    // print_r($resultado);

    // echo "</pre>";
       return $resultado;
    }
    public function ejecutarPrueba($entrenador_id, $prueba_id,  $fecha, $deportista_id, $resultado,) {
    
            $verificar= "SELECT COUNT(*) FROM resultados_pruebas 
             WHERE prueba_id = ? AND deportista_id = ? AND fecha = ?";
            $stmtVerificar = $this->conn->prepare($verificar);
            $stmtVerificar->execute([$prueba_id, $deportista_id, $fecha]);
            $existe = $stmtVerificar->fetchColumn();
            

            if ($existe > 0) {
                 $actualizar="UPDATE resultados_pruebas SET resultado=? where deportista_id=?";
                 $stmtActualizar=$this->conn->prepare($actualizar);
                if(!$stmtActualizar){
                    $resultado= 1;
                 }
                if($stmtActualizar->execute([$resultado, $deportista_id])){
                    $resultado=2;
                }else{
                    $resultado=7;}
            }else{
                 $consulta = "INSERT INTO resultados_pruebas (entrenador_id, prueba_id, deportista_id, resultado, fecha) 
                         VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($consulta);
            
                if (!$stmt) {
                 $resultado=3;
                }
            
                if ($stmt->execute([$entrenador_id, $prueba_id, $deportista_id, $resultado, $fecha])) {
                  $resultado=4;
                } else {
                   $resultado=5;
                }  
           }
     return $resultado;
    }
}
?>