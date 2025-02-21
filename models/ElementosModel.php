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
        public function getCategoriasXEdad(){
            $consulta="SELECT * FROM categoria_Edad  ORDER BY codigo ASC";
            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insertCategoriaxEdad($categoriaxEdad){
            $consulta = $this->conn->prepare("INSERT INTO categoria_edad (nombre_Categoria) VALUES (?)");
            $consulta->execute([$categoriaxEdad]);
        }
//=====================================================================================================
        public function insertModalidad($modalidad){
            $consulta = $this->conn->prepare("INSERT INTO modalidad (modalidad) VALUES (?)");
            $consulta->execute([$modalidad]);
        }
        public function getModalidad(){
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

}
?>