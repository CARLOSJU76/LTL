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
                    $query="SELECT * FROM pais";
                    $stmt=$this->conn->query($query);
                     return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         public function insertDep($id_pais, $dep){
                $query="INSERT INTO departamento (id-_pais, departamento) VALUES (?, ?)";
                $stmt=$this->conn->qurey($query);
                $stmt->execute([$id_pais, $dep]);
         }
         public function getDep(){
            $query="SELECT * FROM departamento";
            $stmt=$this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         public function insertCiudad($id_dep,$ciudad){
            $query="INSERT INTO departamento (id-_departamento, ciudad) VALUES (?, ?)";
            $stmt=$this->conn->qurey($query);
            $stmt->execute([$id_dep, $ciudad]);
        }
        public function getCiudad(){
            $query="SELECT * FROM ciudad";
            $stmt=$this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }


        

}
?>