<?php
    class ClubModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
        public function insertClub($nombre_club, $representante,$fecha_conformacion){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $consulta= "INSERT INTO clubes(nombreClub,id_representante, fecha_conformacion) VALUES (?,?,?)";
            $stmt= $this->conn->prepare($consulta);

            if (!$stmt) {
                return [
                    'msg' => "Error al preparar la consulta.",
                    'tipo' => "error"
                ];
            }
            if($stmt->execute([$nombre_club, $representante, $fecha_conformacion])){
               
                return [
                    'msg' => "Los datos del Club fueron registrados exitosamente.",
                    'tipo' => "success"
                ];
            }else{
                $error = $stmt->errorInfo();
                return [
                    'msg' => "Error al ejecutar la consulta: " . $error[2],
                    'tipo' => "error"
                ];
            }
            }catch (PDOException $e) {
                error_log("Error al insertar club: " . $e->getMessage());
                return [
                    'msg' => "Error al insertar club: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
        }
        public function insertRepresentante($nombre, $apellido, $codigo_td, $num_docum, $genero, $email, $telefono,$foto){
               try{
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $consulta= "INSERT INTO representante_club (nombres, apellidos, codigo_tipodoc,
                            num_docum, genero, email, telefono, foto) VALUES (?,?,?,?,?,?,?,?)";
                    $stmt=$this->conn->prepare($consulta);

                    if (!$stmt) {
                        return [
                            'msg' => "Error al preparar la consulta.",
                            'tipo' => "error"
                        ];
                    }
                    if ($stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $email,$telefono, $foto])) {
                
                        return [
                            'msg' => "Los datos del representante fueron registrados exitosamente.",
                            'tipo' => "success"
                        ];
                    } else {
                        $error = $stmt->errorInfo();
                        return [
                            'msg' => "Error al ejecutar la consulta: " . $error[2],
                            'tipo' => "error"
                        ];
                    }
                } catch (PDOException $e) {
                    error_log("Error al insertar club: " . $e->getMessage());
                    return [
                        'msg' => "Error al insertar club: " . $e->getMessage(),
                        'tipo' => "error"
                    ];
                }
        }
        
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
       public function getClub_byRepre_Email($email) {
    $query = "SELECT id FROM representante_club WHERE email = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $rep_id= $result ? $result['id'] : null;

    $query1="SELECT codigo, nombreClub FROM clubes WHERE id_representante = ?";
    $stmt1 = $this->conn->prepare($query1);
    $stmt1->execute([$rep_id]);
    return $stmt1->fetch(PDO::FETCH_ASSOC);
    
    }

        public function getClubes(){
            $consulta= "SELECT clubes.nombreClub AS nombreClub, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, clubes.fecha_conformacion AS fecha,
                        representante_club.num_docum AS documento, clubes.codigo AS id FROM clubes
                        INNER JOIN representante_club ON clubes.id_representante= representante_club.id" ;

            $stmt= $this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
//=======================================================================================================================
public function getClubesbyNombre($codigo){
    try {
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $consulta = "SELECT clubes.codigo AS club_id, clubes.nombreClub AS nombreClub, clubes.id_representante AS id,
                            representante_club.nombres AS nombreR, representante_club.apellidos AS apellidoR,
                            clubes.fecha_conformacion AS fecha, representante_club.num_docum AS documento
                     FROM clubes
                     INNER JOIN representante_club ON clubes.id_representante = representante_club.id
                     WHERE clubes.codigo LIKE ?";

        $stmt = $this->conn->prepare($consulta);

        if (!$stmt) {
            return [
                'msg' => "Error al preparar la consulta.",
                'tipo' => "error"
            ];
        }

        if ($stmt->execute(['%' . $codigo . '%'])) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Normalizar campos vacíos
            foreach ($resultado as &$club) {
                $club['nombreR'] = !empty($club['nombreR']) ? $club['nombreR'] : 'Por definir';
                $club['apellidoR'] = !empty($club['apellidoR']) ? $club['apellidoR'] : '';
                $club['documento'] = !empty($club['documento']) ? $club['documento'] : 'Por definir';
            }

            return [
                'msg' => "Aquí están los datos del club.",
                'tipo' => "success",
                'data'=> $resultado
            ];
        } else {
            $error = $stmt->errorInfo();
            return [
                'msg' => "Error al ejecutar la consulta: " . $error[2],
                'tipo' => "error"
            ];
        }
    } catch (PDOException $e) {
        error_log("Error al insertar club: " . $e->getMessage());
        return [
            'msg' => "Error al insertar club: " . $e->getMessage(),
            'tipo' => "error"
        ];
    }
}

//========================================================================================================================
//=========================================================================================================================
        public function buscarClub($codigo){
            $consulta= "SELECT clubes.codigo AS club_id, clubes.nombreClub AS nombreClub,clubes.id_representante AS id, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, clubes.fecha_conformacion AS fecha,
                        representante_club.num_docum AS documento, representante_club.foto AS foto FROM clubes
                        INNER JOIN representante_club ON clubes.id_representante= representante_club.id
                        WHERE clubes.codigo = ?" ;

                $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$codigo]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function listRepresentantesById($id_rep){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $consulta= "SELECT representante_club.id AS id, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, representante_club.email AS email,
                        representante_club.telefono AS telefono, tipo_docum.tipo_docum AS tipodoc,
                        representante_club.num_docum AS numdoc, genero.genero AS genero,
                        representante_club.foto AS foto FROM representante_club
                        INNER JOIN tipo_docum ON representante_club.codigo_tipodoc=tipo_docum.codigo 
                        INNER JOIN genero ON representante_club.genero= genero.codigo
                        WHERE representante_club.id LIKE ?" ;
                   
                $stmt= $this->conn->prepare($consulta);
                $stmt->execute(['%' . $id_rep . '%']);
                $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC); 

                if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if ($stmt->execute(['%' . $id_rep . '%'])){
                    $resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return [
                        'data'=> $resultado
                    ];
                } else {
                    $error = $stmt->errorInfo();
                    return [
                        'msg' => "Error al ejecutar la consulta: " . $error[2],
                        'tipo' => "error"
                    ];
                }
            }catch (PDOException $e) {
                error_log("Error al tratar de listar los registros:" . $e->getMessage());
                return [
                    'msg' => "Error al tratar de listar los registros: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }       
        }
        public function getNombreClubes(){
            $consulta="SELECT codigo,nombreClub from clubes";
            $stmt=$this->conn->query($consulta);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
//=====================================================================================================================
        public function updateClub($nombre_club, $representante,$fecha_conformacion, $codigo){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= "UPDATE clubes SET nombreClub=?, id_representante=?, fecha_conformacion=? WHERE codigo=?";
                $stmt=$this->conn->prepare($query);

                if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if($stmt->execute([$nombre_club, $representante, $fecha_conformacion,$codigo])){
                    return [
                        'msg' => "Los datos del club fueron actualizados exitosamente.",
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
                error_log("Error al actualizar datos del club: " . $e->getMessage());
                return [
                    'msg' => "Error al actualizar datos del club: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
        }
//====================================================================================================================
        public function deleteClub($codigo){
           try{ 
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= "DELETE FROM clubes WHERE codigo LIKE ?";
                $stmt= $this->conn->prepare($query);
            
            if (!$stmt) {
                return [
                    'msg' => "Error al preparar la consulta.",
                    'tipo' => "error"
                ];
            }
            if($stmt->execute([$codigo])){
                return [
                    'msg' => "Los datos del club fueron eliminados con éxito.",
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
            error_log("Error al actualizar datos del club: " . $e->getMessage());
            return [
                'msg' => "Error al actualizar datos del club: " . $e->getMessage(),
                'tipo' => "error"
            ];
        }
        
        }
//======================================================================================================================
//======================================================================================================================
        public function buscarRepresentantes($id_rep){
            $consulta= "SELECT representante_club.id AS id, representante_club.nombres AS nombreR,
                        representante_club.apellidos AS apellidoR, representante_club.email AS email,
                        representante_club.telefono AS telefono, tipo_docum.tipo_docum AS tipodoc,
                        representante_club.num_docum AS numdoc, genero.genero as genero,
                        representante_club.genero AS cod_genero, representante_club.foto AS foto,
                        representante_club.codigo_tipodoc AS codigo_rep FROM representante_club
                        INNER JOIN tipo_docum ON representante_club.codigo_tipodoc=tipo_docum.codigo 
                        INNER JOIN genero ON representante_club.genero= genero.codigo
                        WHERE representante_club.id = ?" ;
                   
                $stmt= $this->conn->prepare($consulta);
                $stmt->execute([$id_rep]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);            
        }        
        public function updateRepre($nombre, $apellido, $codigo_td, $num_docum, $genero, $email, $telefono, $foto, $id_rep){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= "UPDATE representante_club SET nombres=?, apellidos=?, codigo_tipodoc=?, num_docum=?, genero=?, email=?, telefono= ?,
                        foto=? WHERE id=?";
                $stmt=$this->conn->prepare($query);
                if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if($stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $email, $telefono, $foto, $id_rep ])){
                    return [
                        'msg' => "Los datos del representante han sido actualizados exitosamente.",
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
                error_log("Error al actualizar datos del representante: " . $e->getMessage());
                return [
                    'msg' => "Error al actualizar datos del representante: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
        }
        public function deleteRepre($id_rep){
            try{
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= "DELETE FROM representante_club WHERE id LIKE ?";
                $stmt= $this->conn->prepare($query);
                $stmt->execute([$id_rep]);
                if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
                if( $stmt->execute([$id_rep])){
                    return [
                        'msg' => "Los datos del representante han sido  eliminados.",
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
                error_log("Error al actualizar datos del representante: " . $e->getMessage());
                return [
                    'msg' => "Error al actualizar datos del representante: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
        } 
        public function getFotoR($id)  {
            $consulta=$this->conn->prepare("SELECT foto FROM representante_club WHERE id=? ");
            $consulta->execute([$id]);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);            
        }
        public function setPerfilR($email){
            $conteo=0;
            $perfil=1000;
            $verificar= $this->conn->prepare("SELECT COUNT(*) FROM perfil WHERE email= ?");
            $verificar->execute([$email]);
            $conteo=$verificar->fetchColumn();
            if($conteo<1){
               
                $setPerfiL= $this->conn->prepare("INSERT INTO perfil (email, perfil) VALUES (?,?)");
                $setPerfiL->execute([$email, $perfil]);
            }else{
                $agregar=$this->conn->prepare("UPDATE perfil SET perfil= perfil + 1000 WHERE email = ?");
                $agregar->execute([$email]);
            }
        }
        public function quitarPerfilR($email){
            $consulta=$this->conn->prepare("UPDATE perfil SET perfil= perfil-1000 WHERE email= ?");
            $consulta->execute([$email]);            
        }
        public function getEmailR($id_rep) {
            $consulta = $this->conn->prepare("SELECT email FROM representante_club WHERE id = ?");
            $consulta->execute([$id_rep]);
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado ? $resultado['email'] : null;
        }
        
}
?>