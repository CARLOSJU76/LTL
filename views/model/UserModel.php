<?php
    class UserModel{
        private $conn;
        private $usuarios= 'usuarios';
        private $ocmentarios='comentarios';
        private $dando_like='dando_like';
        

        public function __construct($db){
            $this->conn=$db;
        }
        
// FUNCIONES EMPLEADAS EN REGISTRO DE USUARIOS:
    //función para verificar credenciales de usuario y email.
function verificarCredenciales($user,  $email, $conex){
    $conteo=0;
    $verificar= $conex->prepare("SELECT COUNT(*) FROM usuarios where usuario= ? || email= ?");
    $verificar->bind_param("ss", $user, $email);
    $verificar->execute();
    $verificar->bind_result($conteo);
    $verificar->fetch();
    $verificar->close();

    return $conteo;
}

    //función para encriptar contraseña y realizar registro: 
function registrando($conteo,$conex, $user, $email, $clave ){
    if($conteo===0){
        $query=0;
        $encriptada= password_hash($clave, PASSWORD_DEFAULT);
        $consulta= $conex->prepare("INSERT INTO usuarios (usuario, email, passw) VALUES (?,?,?)");
        $consulta->bind_param("sss", $user, $email, $encriptada);
        $resultado= $consulta->execute();
                  
        $consulta->close();
        if($resultado){
            $query=1;
        }           

    }else{
       $query=-1;
    }
    return $query;
}

        // public function insertUser($document_number, $document_type, $name, $phone, $photo){
        //     $consulta= "INSERT INTO " .$this->table . "(num_docum, id_tipoD, nombre, telefono, foto) VALUES (?,?,?,?,?)";
        //     $stmt= $this->conn->prepare($consulta);
        //     $stmt->execute([$document_number, $document_type, $name, $phone, $photo]);
        // }
        // public function insertProduct($nombre, $marca, $id_tipoP, $precio, $foto){
        //     $consulta= "INSERT INTO " .$this->tablePr . "(nombre, marca, id_tipoP, precio, foto) VALUES (?,?,?,?,?)";
        //     $stmt=$this->conn->prepare($consulta);
        //     $stmt->execute([$nombre, $marca, $id_tipoP, $precio, $foto]);
        // }
        // public function insertTipoD($tipo_documento){
        //     $consulta="INSERT INTO " .$this->tipoD . "(tipo_documento) VALUES (?)";
        //     $stmt= $this->conn->prepare($consulta);
        //     $stmt->execute([$tipo_documento]);
        // }
        // public function insertTipoP($tipo_product){
        //     $consulta="INSERT INTO " .$this->tipoP . "(tipo_producto) VALUES (?)";
        //     $stmt= $this->conn->prepare($consulta);
        //     $stmt->execute([$tipo_product]);
        // }
        // public function insertCompra($num_docum, $id_producto, $fecha, $hora){
        //     $consulta="INSERT INTO " .$this->compra . "(num_docum, id_producto, fecha, hora) VALUES(?,?,?,?)";
        //     $stmt= $this->conn->prepare($consulta);
        //     $stmt->execute([$num_docum, $id_producto,$fecha,$hora]);        
        // }
        

        // public function getUsers(){
        //     $query = "SELECT*FROM " . $this->table;
        //     $stmt = $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getUsersByName($name){
        //     $query= "SELECT * FROM " .$this->table . " WHERE nombre LIKE ?";
        //     $stmt= $this->conn->prepare($query);
        //     $stmt->execute(['%' . $name . '%']);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getUserByNumD($num_docum){
        //     $query= "SELECT * FROM " .$this->table . " WHERE num_docum=?";
        //     $stmt= $this->conn->prepare($query);
        //     $stmt->execute([$num_docum]);
        //     return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getProducts(){
        //     $query="SELECT * FROM " .$this->tablePr;
        //     $stmt= $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function productsByName($name){
        //     $query= "SELECT * FROM " .$this->tablePr . " WHERE nombre LIKE ?";
        //     $stmt= $this->conn->prepare($query);
        //     $stmt->execute(['%' . $name . '%']);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getTipoP(){
        //     $query="SELECT * FROM " .$this->tipoP;
        //     $stmt=$this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getTipoD(){
        //     $query= "SELECT * FROM " .$this->tipoD;
        //     $stmt= $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getNumD(){
        //     $query= "SELECT num_docum, nombre FROM ".$this->table;
        //     $stmt= $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getProducto(){
        //     $query= "SELECT id, nombre FROM " .$this->tablePr;
        //     $stmt= $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function updateUser($num_docum1, $id_tipoD, $nombre, $telefono, $foto, $num_docum){
        //     $query= "UPDATE ".$this->table . " SET num_docum=?, id_tipoD=?, nombre=?, telefono=?, foto=? WHERE num_docum=?";
        //     $stmt=$this->conn->prepare($query);
        //     $stmt->execute([$num_docum1, $id_tipoD, $nombre, $telefono, $foto, $num_docum]);
        // }
        // public function listCompra(){
        //     $query= "SELECT compra.fecha AS Fecha, compra.hora AS Hora, usuarios.nombre AS Usuario, producto.nombre AS Producto FROM " .$this->compra .
        //             " INNER JOIN " .$this->table .
        //             " ON " .$this->compra.".num_docum=". $this->table.".num_docum".
        //             " INNER JOIN " .$this->tablePr.
        //             " ON ".$this->compra.".id_producto= ".$this->tablePr.".id";            
        //     $stmt = $this->conn->query($query);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // }
        // public function getCompraByND($num_docum){
        //     $query= "SELECT usuarios.nombre AS Cliente, producto.nombre AS Producto, compra.fecha AS Fecha, compra.hora AS Hora FROM " .$this->compra .
        //             " INNER JOIN " .$this->table . " ON ". $this->compra. ".num_docum=". $this->table.".num_docum".
        //             " INNER JOIN " .$this->tablePr . " ON ". $this->compra.".id_producto=".$this->tablePr.".id".
        //             " WHERE " .$this->table.".num_docum=?";

        //     $stmt= $this->conn->prepare($query);
        //     $stmt->execute([$num_docum]);
        //     return $stmt->fetchAll(PDO::FETCH_ASSOC);        
        // }
        // public function deleteUser($num_docum){
        //     $query = "DELETE FROM ".$this->table. " WHERE num_docum= ?";
        //     $stmt= $this->conn->prepare($query);
        //     $stmt->execute([$num_docum]);
        // }
    }
?>