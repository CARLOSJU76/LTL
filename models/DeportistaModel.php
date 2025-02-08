<?php
    class DeportistaModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
//================================================================================================================
         public function insertDeport($nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                                     $pais, $dep, $ciudad, $direccion, $telefono, $email, $club){
                $consulta= "INSERT INTO deportista (nombres, apellidos, codigo_tipodoc, id, codigo_genero,
                            fecha_nacimiento, pais, departamento, ciudad, direccion, telefono, email, 
                            codigo_club) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt=$this->conn->prepare($consulta);
                $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                                $pais, $dep, $ciudad, $direccion, $telefono, $email, $club]);
        }
//==================================================================================================================
        
        public function getTd(){
                    $query="SELECT * FROM tipo_docum";
                    $stmt=$this->conn->query($query);
                     return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }

        public function getGenero(){
            $query= "SELECT codigo, genero FROM  genero";
            $stmt= $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getRepresentante(){
            $query = "SELECT id, nombres, apellidos, num_docum FROM  representante_club";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getClubes(){
            $consulta= "SELECT clubes.nombreClub AS nombreClub, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, clubes.fecha_conformacion AS fecha,
                        representante_club.num_docum AS documento FROM clubes
                        INNER JOIN representante_club ON clubes.id_representante= representante_club.id" ;

            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getClubesbyNombre($codigo){
            $consulta= "SELECT clubes.nombreClub AS nombreClub,clubes.id_representante AS id, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, clubes.fecha_conformacion AS fecha,
                        representante_club.num_docum AS documento FROM clubes
                        INNER JOIN representante_club ON clubes.id_representante= representante_club.id
                        WHERE clubes.codigo LIKE ?" ;

                $stmt= $this->conn->prepare($consulta);
                $stmt->execute(['%' . $codigo . '%']);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function buscarClub($codigo){
            $consulta= "SELECT clubes.nombreClub AS nombreClub,clubes.id_representante AS id, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, clubes.fecha_conformacion AS fecha,
                        representante_club.num_docum AS documento FROM clubes
                        INNER JOIN representante_club ON clubes.id_representante= representante_club.id
                        WHERE clubes.codigo = ?" ;

                $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$codigo]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function listRepresentantesById($id_rep){
            $consulta= "SELECT representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, representante_club.email AS email,
                        representante_club.telefono AS telefono, tipo_docum.tipo_docum AS tipodoc,
                        representante_club.num_docum AS numdoc, genero.genero as genero FROM representante_club
                        INNER JOIN tipo_docum ON representante_club.codigo_tipodoc=tipo_docum.codigo 
                        INNER JOIN genero ON representante_club.genero= genero.codigo
                        WHERE representante_club.id LIKE ?" ;
                   
                $stmt= $this->conn->prepare($consulta);
                $stmt->execute(['%' . $id_rep . '%']);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }
        public function getNombreClubes(){
            $consulta="SELECT codigo,nombreClub from clubes";
            $stmt=$this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function updateClub($nombre_club, $representante,$fecha_conformacion, $codigo){
            $query= "UPDATE clubes SET nombreClub=?, id_representante=?, fecha_conformacion=? WHERE codigo=?";
            $stmt=$this->conn->prepare($query);
            $stmt->execute([$nombre_club, $representante, $fecha_conformacion,$codigo]);
        }
        public function deleteClub($codigo){
            $query= "DELETE FROM clubes WHERE codigo LIKE ?";
            $stmt= $this->conn->prepare($query);
            $stmt->execute([$codigo]);
        }
        public function buscarRepresentantes($id_rep){
            $consulta= "SELECT representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, representante_club.email AS email,
                        representante_club.telefono AS telefono, tipo_docum.tipo_docum AS tipodoc,
                        representante_club.num_docum AS numdoc, genero.genero as genero,
                        representante_club.genero AS cod_genero, 
                        representante_club.codigo_tipodoc AS codigo_rep FROM representante_club
                        INNER JOIN tipo_docum ON representante_club.codigo_tipodoc=tipo_docum.codigo 
                        INNER JOIN genero ON representante_club.genero= genero.codigo
                        WHERE representante_club.id = ?" ;
                   
                $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$id_rep]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }        
        public function updateRepre($nombre, $apellido, $codigo_td, $num_docum, $genero, $email, $id_rep){
            $query= "UPDATE representante_club SET nombres=?, apellidos=?, codigo_tipodoc=?, num_docum=?, genero=?, email=? WHERE id=?";
            $stmt=$this->conn->prepare($query);
            $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $email, $id_rep]);
        }
        public function deleteRepre($id_rep){
            $query= "DELETE FROM representante_club WHERE id LIKE ?";
            $stmt= $this->conn->prepare($query);
            $stmt->execute([$id_rep]);
        }   

}
?>