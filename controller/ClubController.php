<?php
    include_once('./config/Conexion.php');
    include_once('./models/ClubModel.php');

    class ClubController{
        private $db;
        private $clubModel;

        public function clubManage(){
            require_once('./view-profile/club_manage.php');

        }
        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->clubModel= new ClubModel($this->db);
        }
         
        public function insertClub(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $nombre_club=$_POST['nombre_club'];
                $representante=$_POST['representante'];
                $fecha_conformacion= $_POST['fecha_conformacion'];     

                $this->clubModel->insertClub($nombre_club, $representante,$fecha_conformacion);
                //header("Location: index.php?action=dashboard");
                echo"<br>El Club ha sido registrado en la base de datos";
                echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                <button type='submit' name='action' value='principal'>Página de inicio</button>
                </form>";
            }
        }

       public function insertRepresentante(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
       
            $nombre=$_POST['nombre'];
            $apellido=$_POST['apellido'];
            $codigo_td=$_POST['codigo_td'];
            $num_docum=$_POST['num_docum'];
            $genero=$_POST['genero'];
            $email=$_POST['email'];
            $this->clubModel->insertRepresentante($nombre,$apellido, $codigo_td, 
                                                $num_docum, $genero, $email);
                echo"<br>El Dirigente ha sido registrado en la base de datos";
                echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='principal'>Página de inicio</button>
                    </form>";
            }        
       }
        public function getTd(){
        return $this->clubModel->getTd();
        }
        public function getGenero(){
            return $this->clubModel->getGenero();
            }
        public function getRepresentante(){
           return $this->clubModel->getRepresentante();
            }

            public function listClubes(){
                return $this->clubModel->getClubes();
            }
            public function listarRepresentantes(){
                $id_rep=$_GET['id_rep'] ?? '';
                return $this->clubModel->listRepresentantesById($id_rep);
            }
            public function buscarRepresentantes(){
                $id_rep=$_GET['id_rep'] ?? '';
                return $this->clubModel->buscarRepresentantes($id_rep);
            }
            
            public function getNombreClubes(){
                return $this->clubModel->getNombreClubes();
            }
            public function getClubesByNombre(){               
                    $codigo=$_GET['codigo_club'] ?? '';
                    return $this->clubModel->getClubesbyNombre($codigo);
                }
            public function buscarClub(){
                    $codigo=$_GET['codigo_club'] ?? '';
                    return $this->clubModel->buscarClub($codigo);
                }
            
            public function updateClub(){
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $codigo=$_POST['codigo_club'];
                    $id_representante= $_POST['id_representante'];
                    $nombre_club= $_POST['nombre_club'];
                    $fecha_conformacion=$_POST['fecha'];
                    
                                 
                    $this->clubModel->updateClub($nombre_club, $id_representante,$fecha_conformacion, $codigo);
                    echo"<br>Los datos del Club han sido actualizado exitosamente<br>";
                    echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
                    </form>";
                }     
            }
            public function deleteClub(){
                if($_SERVER["REQUEST_METHOD"]=="GET"){
                    $codigo=$_GET['codigo_club'];
                    
                    $this->clubModel->deleteClub($codigo);
                    echo"<br>Los datos del Club han sido eliminados<br>";
                    echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
                    </form>";
                }
            }
            public function updateRepre(){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $id=$_POST['id_rep'];
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    $codigo_td=$_POST['codigo_td'];
                    $num_docum=$_POST['num_docum'];
                    $genero=$_POST['genero'];
                    $email=$_POST['email'];

                    $this->clubModel->updateRepre($nombre, $apellido, $codigo_td,
                                                 $num_docum, $genero, $email, $id);
                    echo"<br>Los datos del Representante han sido actualizado exitosamente<br>";
                    echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
                    </form>";
                }
            }
            public function deleteRepre(){
                if($_SERVER['REQUEST_METHOD']=='GET '){
                    $id_rep=$_GET['id_rep'];
                   
                    $this->clubModel->deleteRepre($id_rep);

                    echo"<br>Los datos del Representante han sido eliminados  de la base de datos<br>";
                    echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='club_manage'>Gestión de Clubes</button>
                    </form>";
                }
            }
           
}
?>