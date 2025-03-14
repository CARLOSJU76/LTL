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
        public function insertSession($id_entrenador, $id_lugar, $fecha, $hora){
            try{
                $consulta="INSERT INTO sesiones (id_entrenador, id_lugar, fecha, hora) VALUES (?,?,?,?)";
                $resultado= $stmt=$this->conn->prepare($consulta);
                $stmt->execute([$id_entrenador, $id_lugar, $fecha, $hora]);
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
                            entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones INNER JOIN entrenadores
                            ON entrenadores.id= sesiones.id_entrenador INNER JOIN lugar_entrenamiento
                            ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE sesiones.fecha > ? AND 
                            sesiones.fecha < ? ";
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
        public function listSessionbyTrainer($id_entrenador){
            try{
                $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                            entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                            sesiones.fecha AS fecha, sesiones.hora AS hora 
                            FROM sesiones INNER JOIN entrenadores
                            ON entrenadores.id= sesiones.id_entrenador INNER JOIN lugar_entrenamiento
                            ON sesiones.id_lugar= lugar_entrenamiento.id
                            WHERE entrenadores.id= ?";
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
    public function listYourSessions($email){
        try{
            $consulta=  "SELECT sesiones.codigo AS id, entrenadores.nombres AS nombreE,
                        entrenadores.apellidos AS apellidoE, lugar_entrenamiento.lugar AS sitio,
                        sesiones.fecha AS fecha, sesiones.hora AS hora 
                        FROM sesiones INNER JOIN entrenadores
                        ON entrenadores.id= sesiones.id_entrenador INNER JOIN lugar_entrenamiento
                        ON sesiones.id_lugar= lugar_entrenamiento.id
                        WHERE entrenadores.email= ?";
                $resultado= $stmt= $this->conn->prepare($consulta);
                    $stmt->execute([$email]);
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

}
?>