<?php
    include_once('./config/Conexion.php');
    include_once('./models/ClubModel.php');
    include_once ('./models/DeportistaModel.php');
    include_once './models/EventModel.php';

    class EventController{
        private $db;
        private $clubModel;
        private $depoModel;
        private $eventModel;

        public function clubManage(){
            require_once('./view-profile/club_manage.php');

        }
        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->clubModel= new ClubModel($this->db);
            $this->depoModel= new DeportistaModel($this->db);
            $this->eventModel= new EventModel($this->db);
        }
         
//================================================================================================================      
       public function insertEvento(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
       
            $tipoEv=$_POST['tipoEv'];
            $nombreEv=$_POST['nombreEv'];
            $fechaEv=$_POST['fechaEv'];
            $ciudad=$_POST['ciudad'];
            $departamento=$_POST['departamento'];
            $pais=$_POST['pais'];
            $categoriaxEdad=$_POST['categoriaxEdad'];
           

            if($this->eventModel->insertEvento($tipoEv,$nombreEv, $pais,
             $departamento,$ciudad,  $fechaEv, $categoriaxEdad)){
                    echo"<p style='color:yellow;'>El Evento ha sido registrado en la base de datos </p>";
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
//=================================================================================================================
    public function listEventos(){
        $id_evento=$_GET['id_evento'] ?? '';
        return $this->eventModel->listEventosById($id_evento);
    }
//==================================================================================================================
    public function buscarEvento(){
        $id_evento=$_GET['id_evento']?? '';
        return $this->eventModel->buscarEvento($id_evento);
    }
//==================================================================================================================
public function updateEvento(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_evento=$_POST['id_evento'];
            $tipoEv=$_POST['tipoEv'];
            $nombreEv=$_POST['nombreEv'];
            $fechaEv=$_POST['fechaEv'];
            $ciudad=$_POST['ciudad'];
            $departamento=$_POST['departamento'];
            $pais=$_POST['pais'];
            $categoriaxEdad=$_POST['categoriaxEdad'];

        if($this->eventModel->updateEvento($tipoEv,$nombreEv, $pais,
        $departamento,$ciudad,  $fechaEv, $categoriaxEdad, $id_evento)){
            echo"<p style='color:blue;'>Los datos del evento han sido actualizados exitosamente</pr>";
        }else{
            echo"<p style='color:red;'>Se presentó un error en la inserción de los datos. Intenta nuevamente.</p>";
        }
        echo "<form action='index.php?action=event_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='event_manage'>Gestión de Eventos</button>
        </form>";
    }
}
//===================================================================================================================
public function deleteEvento(){
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $id_evento=$_GET['id_evento'];
       
        $this->eventModel->deleteEvento($id_evento);

        echo"<br>Los datos del Evento han sido eliminados de la base de datos<br>";
        echo "<form action='index.php?action=club_manage' method='get' enctype='multipart/form-data'>
        <button type='submit' name='action' value='event_manage'>Gestión de Eventos</button>
        </form>";
    }
}
//===================================================================================================================
        
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