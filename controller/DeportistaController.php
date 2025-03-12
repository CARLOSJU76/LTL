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
            

            if($this->depoModel->insertDeport($nombre,$apellido, $codigo_td,$num_docum, $genero,
                                            $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
                                             $email, $modalidad,$club, $foto) ){
                    $this->depoModel->setPerfilD($email);
                echo"<br><p style='color:yellow;'>El Deportista ha sido registrado en la base de datos</p>";
                echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                                <button type='submit' name='action' value='principal'>Página de inicio</button>
                        </form>";
                }else{
                    echo"<p style='color:yellow;'>Se presentó un error en la inserción de los datos. Intenta nuevamente.</p>";
                    echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                                 <button type='submit' name='action' value='principal'>Página de inicio</button>
                        </form>";
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
        if ($resultado) {
            $this->depoModel->setPerfilE($email); // Si la inserción fue exitosa, establecer perfil
            // Aquí podrías redirigir a otra página o mostrar un mensaje de éxito
            echo"<p style='color:yellow;'>El Entrenador ha sido registrado en la base de datos</p>";
        } else {
            // Si hubo un error, mostrar un mensaje de error
            echo "<p style='color:yellow;'>Hubo un error al insertar el entrenador. Por favor, intenta nuevamente.</p>";
        }
        echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='principal'>Página de inicio</button>
                </form>";
    }
}

//=================================================================================================================
    public function listDeportistas(){
        $id_dep=$_GET['id_dep'] ?? '';
        return $this->depoModel->listDeportistasById($id_dep);
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

        $this->depoModel->updateDeportista($nombre,$apellido, $codigo_td,$num_docum, $genero,
        $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
         $email, $modalidad,$club, $foto, $id);
        echo"<br>Los datos del Deportistase han sido actualizado exitosamente<br>";
        echo "<form action='index.php?action=sport_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='sport_manage'>Gestión de Deportistas</button>
        </form>";
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

        $this->depoModel->updateEntrenador($nombre,$apellido, $codigo_td,$num_docum, $genero,
        $fecha, $pais, $dep, $ciudad, $direccion, $telefono,
         $email, $club, $foto, $id);
        echo"<br>Los datos del Entrenador han sido actualizado exitosamente<br>";
        echo "<form action='index.php?action=sport_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='sport_manage'>Gestión de Deportistas</button>
        </form>";
    }
}
//===================================================================================================================
public function deleteDeportista(){
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id_dep=$_GET['id_dep'];

        $elementos= $this->depoModel->getEmailD($id_dep);
        $emailAntiguo= $elementos[0]['email'];
        $this->depoModel->quitarPerfilD($emailAntiguo);
       
        $this->depoModel->deleteDeportista($id_dep);

        echo"<br>Los datos del Deportista han sido eliminados  de la base de datos<br>";
        echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
        </form>";
    }
}
//===================================================================================================================
public function deleteEntrenador(){
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id_ent=$_GET['id_ent'];

        $elementos= $this->depoModel->getEmailE($id_ent);
        $emailAntiguo= $elementos[0]['email'];
        $this->depoModel->quitarPerfilE($emailAntiguo);
       
        $this->depoModel->deleteEntrenador($id_ent);

        echo"<p style='color:yellow;'>Los datos del Entrenador han sido eliminados  de la base de datos<br>";
        echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
        </form>";
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