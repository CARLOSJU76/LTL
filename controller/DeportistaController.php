<?php
    include_once('./config/Conexion.php');
    include_once('./models/ClubModel.php');
    include_once ('./models/DeportistaModel.php');

    class DeportistaController{
        private $db;
        private $clubModel;
        private $depoModel;

        public function clubManage(){
            require_once('./view-profile/club_manage.php');

        }
        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->clubModel= new ClubModel($this->db);
            $this->depoModel= new DeportistaModel($this->db);
        }
//================================================================================================================      
       public function insertDeport(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
       
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $codigo_td=$_POST['codigo_td'];
            $num_docum=$_POST['num_docum'];
            $genero=$_POST['genero'];
            $fecha=$_POST['fecha'];
            $pais=$_POST['pais'];
            $dep=$_POST['departamento'];
            $ciudad=$_POST['ciudad'];
            $telefono=$_POST['telefono'];
            $direccion=$_POST['direccion'];
            $email=$_POST['email'];
            $modalidad=$_POST['modalidad'];
            $club=$_POST['club'];
            $foto= $_FILES['foto']['name'];
            $target_dir="fotos/";
            $target_file= $target_dir .basename($foto);
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
            

            $resultado= $this->depoModel->insertDeport($nombre,$apellido, $codigo_td,$num_docum, $genero,
                                            $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
                                             $email, $modalidad,$club, $foto);
            if($resultado['tipo']=="success"){
                $this->depoModel->setPerfilD($email);
                return $resultado;
            }
            }        
       }
//================================================================================================================
public function insertEntrenador() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $codigo_td = $_POST['codigo_td'];
        $num_docum = $_POST['num_docum'];
        $genero = $_POST['genero'];
        $fecha = $_POST['fecha'];
        $pais = $_POST['pais'];
        $dep = $_POST['departamento'];
        $ciudad = $_POST['ciudad'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $club = $_POST['club'];
        $foto = $_FILES['foto']['name'];

        // Subir la foto
        $target_dir = "fotos/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

        // Llamar al modelo para insertar el entrenador
        $resultado = $this->depoModel->insertEntrenador($nombre, $apellido, $codigo_td, $num_docum, $genero, 
                                                       $fecha, $pais, $dep, $ciudad, $direccion, $telefono, 
                                                       $email, $club, $foto);

        // Verificar el resultado
        if ($resultado['tipo']=="success") {
            $this->depoModel->setPerfilE($email); 
        } 
         return $resultado;
    }
}
//=================================================================================================================
    public function listDeportistas(){
        $id_dep=$_GET['id_dep'] ?? '';
        return $this->depoModel->listDeportistasById($id_dep);
    }
    public function listSportman(){
        return $this->depoModel->listSportman();
    }
    public function get_id_by_email($email){
        return $this->depoModel->get_id_by_email($email);
    }
    //=================================================================================================================
    public function listEntrenadores(){
        $id_ent=$_GET['id_ent'] ?? '';
        return $this->depoModel->listEntrenadoresById($id_ent);
    }
//==================================================================================================================
    public function buscarDeportista(){
        $id_dep=$_GET['id_dep']?? '';
        return $this->depoModel->buscarDeportista($id_dep);
    }
//==================================================================================================================
public function buscarEntrenador(){
    $id_ent=$_GET['id_ent']?? '';
    return $this->depoModel->buscarEntrenador($id_ent);
}
public function getEntrenadores(){
    return $this->depoModel->getEntrenadores();
}
public function getEntrenadorByEmail($email){
    return $this->depoModel->getEntrenadorByEmail($email);
}
//==================================================================================================================
public function updateDeportista(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
            $id=$_POST['id_dep'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $codigo_td=$_POST['codigo_td'];
            $num_docum=$_POST['num_docum'];
            $genero=$_POST['genero'];
            $fecha=$_POST['fecha'];
            $pais=$_POST['pais'];
            $dep=$_POST['departamento'];
            $ciudad=$_POST['ciudad'];
            $telefono=$_POST['telefono'];
            $direccion=$_POST['direccion'];
            $email=$_POST['email'];
            $modalidad=$_POST['modalidad'];
            $club=$_POST['club'];
            $foto= $_FILES['foto']['name'];

            $fotoActual=$this->depoModel->getFotoD($id);

                        if(empty($foto)){
                        // El valor que regresa getFoto es un array, por lo que debemos acceder al campo 'foto'
                        $foto = $fotoActual[0]['foto'];  // Asumimos que getFoto devuelve un array con 'foto'
                        } else {

                        $target_dir="fotos/";
                        $target_file= $target_dir .basename($foto);
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                        }

    $elementos= $this->depoModel->getEmailD($id);
    $emailAntiguo= $elementos[0]['email'];
    $this->depoModel->quitarPerfilD($emailAntiguo);
    $this->depoModel->setPerfilD($email);

        return $this->depoModel->updateDeportista($nombre,$apellido, $codigo_td,$num_docum, $genero,
        $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
         $email, $modalidad,$club, $foto, $id);
    }else{
                    return[
                        'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                        'tipo'=>"error"
                        ];
                }
}
//==================================================================================================================
public function updateEntrenador(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
            $id=$_POST['id_ent'];
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $codigo_td=$_POST['codigo_td'];
            $num_docum=$_POST['num_docum'];
            $genero=$_POST['genero'];
            $fecha=$_POST['fecha'];
            $pais=$_POST['pais'];
            $dep=$_POST['departamento'];
            $ciudad=$_POST['ciudad'];
            $telefono=$_POST['telefono'];
            $direccion=$_POST['direccion'];
            $email=$_POST['email'];
           
            $club=$_POST['club'];
            $foto= $_FILES['foto']['name'];

            $fotoActual=$this->depoModel->getFotoE($id);

                        if(empty($foto)){
                        // El valor que regresa getFoto es un array, por lo que debemos acceder al campo 'foto'
                        $foto = $fotoActual[0]['foto'];  // Asumimos que getFoto devuelve un array con 'foto'
                        } else {

                        $target_dir="fotos/";
                        $target_file= $target_dir .basename($foto);
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                        }

        $elementos= $this->depoModel->getEmailE($id);
        $emailAntiguo= $elementos[0]['email'];
        $this->depoModel->quitarPerfilE($emailAntiguo);
        $this->depoModel->setPerfilE($email);

        return $this->depoModel->updateEntrenador($nombre,$apellido, $codigo_td,$num_docum, $genero,
        $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
         $email, $club, $foto, $id);
    }
}
//===================================================================================================================
public function deleteDeportista(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_dep=$_POST['id_dep'];

        $elementos= $this->depoModel->getEmailD($id_dep);
        $emailAntiguo= $elementos;
        $this->depoModel->quitarPerfilD($emailAntiguo);
       
        return $this->depoModel->deleteDeportista($id_dep);
    }
}
//===================================================================================================================
public function deleteEntrenador(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_ent=$_POST['id_ent'];

        $elementos= $this->depoModel->getEmailE($id_ent);
        $emailAntiguo= $elementos[0]['email'];
        $this->depoModel->quitarPerfilE($emailAntiguo);
       
        return $this->depoModel->deleteEntrenador($id_ent);
    }
}
//===================================================================================================================
        public function getTd(){
        return $this->clubModel->getTd();
        }
        public function getGenero(){
            return $this->clubModel->getGenero();
            }
        public function listD($id){
           return $this->depoModel->listDeportistasById($id);
        }
        public function listE($id){
            return $this->depoModel->listEntrenadoresById($id);
        }
      

}
?>