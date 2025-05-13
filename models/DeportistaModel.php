<?php
    class DeportistaModel{
        private $conn;
        
        public function __construct($db){
            $this->conn=$db;
        }
//================================================================================================================
        public function insertDeport($nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                                    $pais, $dep, $ciudad, $direccion, $telefono, $email, $modalidad, $club, $foto) {
            try {
                $consulta = "INSERT INTO deportista (nombres, apellidos, codigo_tipodoc, id, codigo_genero,
                            fecha_nacimiento, id_pais, id_departamento, id_ciudad, direccion, telefono, email, modalidad,
                            codigo_club, foto) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado=$stmt = $this->conn->prepare($consulta);
                $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                $pais, $dep, $ciudad, $direccion, $telefono, $email, $modalidad, $club, $foto]);

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
//=================================================================================================================
public function insertEntrenador($nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                                    $pais, $dep, $ciudad, $direccion, $telefono, $email, $club, $foto) {
            try {
                $consulta = "INSERT INTO entrenadores (nombres, apellidos, codigo_tipodoc, id, codigo_genero,
                            fecha_nacimiento, id_pais, id_departamento, id_ciudad, direccion, telefono, email,
                            codigo_club, foto) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $resultado=$stmt = $this->conn->prepare($consulta);
                $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
                $pais, $dep, $ciudad, $direccion, $telefono, $email, $club, $foto]);

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
public function listDeportistasById($id_dep){

    try{
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta= "SELECT deportista.id AS id, deportista.nombres AS nombreD,
        deportista.apellidos AS apellidoD, tipo_docum.tipo_docum AS tipodoc,
        deportista.fecha_nacimiento AS fecha, deportista.telefono AS telefono,
        deportista.direccion as direccion, deportista.email AS email, 
        genero.genero as genero, modalidad.modalidad AS modalidad,
        ciudad.ciudad AS ciudad, departamento.departamento AS departamento, 
        pais.pais AS pais, clubes.nombreClub AS club, deportista.foto AS foto
        FROM deportista
        INNER JOIN tipo_docum ON deportista.codigo_tipodoc=tipo_docum.codigo 
        INNER JOIN genero ON deportista.codigo_genero= genero.codigo
        INNER JOIN ciudad ON deportista.id_ciudad= ciudad.codigo
        INNER JOIN departamento ON deportista.id_departamento= departamento.id
        INNER JOIN pais ON deportista.id_pais= pais.id
        INNER JOIN clubes ON deportista.codigo_club= clubes.codigo
        INNER JOIN modalidad ON deportista.modalidad=modalidad.id
        WHERE deportista.id LIKE ?" ;
   
$stmt= $this->conn->prepare($consulta);
$stmt->execute(['%' . $id_dep . '%']);
$resultado= $stmt->fetchAll(PDO::FETCH_ASSOC);     
if (!$stmt) {
    return [
        'msg' => "Error al preparar la consulta.",
        'tipo' => "error"
    ];
}
if($stmt->execute(['%' . $id_dep . '%'])){   
    return [
        'msg' => "Datos de los deportistas obtenidos exitosamente.",
        'tipo' => "success",
        'data'=> $resultado
    ];
}else{
    $error = $stmt->errorInfo();
    return [
        'msg' => "Error al ejecutar la consulta: " . $error[2],
        'tipo' => "error"
    ];
}
        
    }catch (PDOException $e) {
        error_log("Error al tratar de obtener datos: " . $e->getMessage());
        return [
            'msg' => "Error al tratar de obtener datos: " . $e->getMessage(),
            'tipo' => "error"
        ];
    }
   
}
public function listSportman(){
    $consulta="SELECT * FROM deportista";
    $stmt= $this->conn->prepare($consulta);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

}
//===========================================================================================================
public function listEntrenadoresById($id_ent){
    $consulta= "SELECT entrenadores.id AS id, entrenadores.nombres AS nombreE,
                entrenadores.apellidos AS apellidoE, tipo_docum.tipo_docum AS tipodoc,
                entrenadores.fecha_nacimiento AS fecha, entrenadores.telefono AS telefono,
                entrenadores.direccion as direccion, entrenadores.email AS email, 
                genero.genero as genero, ciudad.ciudad AS ciudad,
                departamento.departamento AS departamento, pais.pais AS pais, 
                clubes.nombreClub AS club, entrenadores.foto AS foto
                FROM entrenadores
                INNER JOIN tipo_docum ON entrenadores.codigo_tipodoc=tipo_docum.codigo 
                INNER JOIN genero ON entrenadores.codigo_genero= genero.codigo
                INNER JOIN ciudad ON entrenadores.id_ciudad= ciudad.codigo
                INNER JOIN departamento ON entrenadores.id_departamento= departamento.id
                INNER JOIN pais ON entrenadores.id_pais= pais.id
                INNER JOIN clubes ON entrenadores.codigo_club= clubes.codigo
                WHERE entrenadores.id LIKE ?" ;

           
    $stmt= $this->conn->prepare($consulta);
    $stmt->execute(['%' . $id_ent . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);            
}
//=================================================================================================================

public function buscarDeportista($id_dep){
                $consulta= "SELECT deportista.id AS id, deportista.nombres AS nombreD,
                deportista.apellidos AS apellidoD, tipo_docum.tipo_docum AS tipodoc,
                deportista.fecha_nacimiento AS fecha, deportista.telefono AS telefono,
                deportista.direccion as direccion, deportista.email AS email, 
                genero.genero as genero, modalidad.modalidad AS modalidad,
                ciudad.ciudad AS ciudad, departamento.departamento AS departamento, 
                pais.pais AS pais, clubes.nombreClub AS club, deportista.foto AS foto
                FROM deportista
                INNER JOIN tipo_docum ON deportista.codigo_tipodoc=tipo_docum.codigo 
                INNER JOIN genero ON deportista.codigo_genero= genero.codigo
                INNER JOIN ciudad ON deportista.id_ciudad= ciudad.codigo
                INNER JOIN departamento ON deportista.id_departamento= departamento.id
                INNER JOIN pais ON deportista.id_pais= pais.id
                INNER JOIN clubes ON deportista.codigo_club= clubes.codigo
                INNER JOIN modalidad ON deportista.modalidad=modalidad.id
                WHERE deportista.id = ?" ;

    $stmt= $this->conn->prepare($consulta);
    $stmt->execute([$id_dep]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}

//==================================================================================================================
public function buscarEntrenador($id_ent){
    $consulta= "SELECT entrenadores.id AS id, entrenadores.nombres AS nombreE,
                entrenadores.apellidos AS apellidoE, tipo_docum.tipo_docum AS tipodoc,
                entrenadores.fecha_nacimiento AS fecha, entrenadores.telefono AS telefono,
                entrenadores.direccion as direccion, entrenadores.email AS email, 
                genero.genero as genero, ciudad.ciudad AS ciudad,
                departamento.departamento AS departamento, pais.pais AS pais, clubes.nombreClub AS club,
                entrenadores.foto AS foto FROM entrenadores
                INNER JOIN tipo_docum ON entrenadores.codigo_tipodoc=tipo_docum.codigo 
                INNER JOIN genero ON entrenadores.codigo_genero= genero.codigo
                INNER JOIN ciudad ON entrenadores.id_ciudad= ciudad.codigo
                INNER JOIN departamento ON entrenadores.id_departamento= departamento.id
                INNER JOIN pais ON entrenadores.id_pais= pais.id
                INNER JOIN clubes ON entrenadores.codigo_club= clubes.codigo
               
                WHERE entrenadores.id = ?" ;


    $stmt= $this->conn->prepare($consulta);
    $stmt->execute([$id_ent]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  
}
//=================================================================================================================
public function updateDeportista($nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
$pais, $dep, $ciudad, $direccion, $telefono, $email, $modalidad, $club,$foto, $id){
    try{$query= "UPDATE deportista SET nombres=?, apellidos=?, codigo_tipodoc=?, id=?, codigo_genero=?,
                            fecha_nacimiento=?, id_pais=?, id_departamento=?, id_ciudad=?, direccion=?, 
                            telefono=?, email=?, modalidad=?, codigo_club=?, foto=? WHERE id=?";
    $stmt=$this->conn->prepare($query);
    $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
    $pais, $dep, $ciudad, $direccion, $telefono, $email, $modalidad, $club, $foto,$id ]);
        if (!$stmt) {
                    return [
                        'msg' => "Error al preparar la consulta.",
                        'tipo' => "error"
                    ];
                }
        if( $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
    $pais, $dep, $ciudad, $direccion, $telefono, $email, $modalidad, $club, $foto,$id ])){
                    return [
                        'msg' => "Los datos del deportista han sido actualizados exitosamente.",
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
                error_log("Error al actualizar datos del deportista: " . $e->getMessage());
                return [
                    'msg' => "Error al actualizar datos del deportista: " . $e->getMessage(),
                    'tipo' => "error"
                ];
            }
}
//==================================================================================================================
public function updateEntrenador($nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
$pais, $dep, $ciudad, $direccion, $telefono, $email, $club,$foto, $id){
    $query= "UPDATE entrenadores SET nombres=?, apellidos=?, codigo_tipodoc=?, id=?, codigo_genero=?,
                            fecha_nacimiento=?, id_pais=?, id_departamento=?, id_ciudad=?, direccion=?, 
                            telefono=?, email=?, codigo_club=?, foto=? WHERE id=?";
    $stmt=$this->conn->prepare($query);
    $stmt->execute([$nombre, $apellido, $codigo_td, $num_docum, $genero, $fecha,
    $pais, $dep, $ciudad, $direccion, $telefono, $email, $club, $foto,$id ]);
}
//==================================================================================================================
public function getFotoD($id)  {
    $consulta=$this->conn->prepare("SELECT foto FROM deportista WHERE id=? ");
    $consulta->execute([$id]);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);            
}
//==================================================================================================================
public function getFotoE($id)  {
    $consulta=$this->conn->prepare("SELECT foto FROM entrenadores WHERE id=? ");
    $consulta->execute([$id]);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);            
}

//===================================================================================================================
public function deleteDeportista($id_dep){
    $query= "DELETE FROM deportista WHERE id = ?";
    $stmt= $this->conn->prepare($query);
    $stmt->execute([$id_dep]);   

}
//===================================================================================================================
public function deleteEntrenador($id_ent){
    $query= "DELETE FROM entrenadores WHERE id = ?";
    $stmt= $this->conn->prepare($query);
    $stmt->execute([$id_ent]);   
}
//====================================================================================================================
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
//=========================PERFIL DEPORTISTAS======================================================================
//=================================================================================================================
        public function setPerfilD($email){
            $conteo=0;
            $perfil=10;
            $verificar= $this->conn->prepare("SELECT COUNT(*) FROM perfil WHERE email= ?");
            $verificar->execute([$email]);
            $conteo=$verificar->fetchColumn();
            if($conteo<1){
               
                $setPerfiL= $this->conn->prepare("INSERT INTO perfil (email, perfil) VALUES (?,?)");
                $setPerfiL->execute([$email, $perfil]);
            }else{
                $agregar=$this->conn->prepare("UPDATE perfil SET perfil= perfil + 10 WHERE email = ?");
                $agregar->execute([$email]);
            }
        }
//===================================================================================================================
        public function quitarPerfilD($email){
            $consulta=$this->conn->prepare("UPDATE perfil SET perfil= perfil-10 WHERE email= ?");
            $consulta->execute([$email]);   
        }

//====================================================================================================================
        public function getEmailD($id){
            $consulta= $this->conn->prepare("SELECT email FROM deportista WHERE id = ?");
            $consulta->execute([$id]);

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
//=================================PERFIL ENTRENADORES===============================================================
//===================================================================================================================
        public function setPerfilE($email){
            $conteo=0;
            $perfil=100;
            $verificar= $this->conn->prepare("SELECT COUNT(*) FROM perfil WHERE email= ?");
            $verificar->execute([$email]);
            $conteo=$verificar->fetchColumn();
            if($conteo<1){
               
                $setPerfiL= $this->conn->prepare("INSERT INTO perfil (email, perfil) VALUES (?,?)");
                $setPerfiL->execute([$email, $perfil]);
            }else{
                $agregar=$this->conn->prepare("UPDATE perfil SET perfil= perfil + 100 WHERE email = ?");
                $agregar->execute([$email]);
            }
        }
//===================================================================================================================
public function quitarPerfilE($email){
    $consulta=$this->conn->prepare("UPDATE perfil SET perfil= perfil-100 WHERE email= ?");
    $consulta->execute([$email]);   
}

//====================================================================================================================
public function getEmailE($id){
    $consulta= $this->conn->prepare("SELECT email FROM entrenadores WHERE id = ?");
    $consulta->execute([$id]);

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
//====================================================================================================================

        
}
?>