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
                return[
                    'msg'=>"El Evento ha sido registrado exitosamente.",
                    'tipo'=>"success"
                ];
                }else{
                    return[
                        'msg'=>"Hubo un error. No fue posible registrar el evento",
                        'tipo'=>"error"
                    ];
                }
            }        
       }
//=================================================================================================================
    public function listEventos(){
        $id_evento=$_GET['id_eventos'] ?? '';
        return $this->eventModel->listEventosById($id_evento);
    }
//==================================================================================================================
    public function buscarEvento(){
        $id_evento=$_GET['id_evento']?? '';
        return $this->eventModel->buscarEvento($id_evento);
    }
    public function getEventos(){
        return $this->eventModel->getEventos();
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
            return[
                'msg'=>"El evento ha sido actualizado exitosamente.",
                'tipo'=>"success"
            ];
        }else{
            return[
                'msg'=>"No fue posible actualizar el evento",
                'tipo'=>"error"
            ];
        }
        
    }
}
//===================================================================================================================
public function deleteEvento(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id_evento=$_POST['id_evento'];
       
        if($this->eventModel->deleteEvento($id_evento)){
            return [
                'msg'=>"El registro ha sido eliminado exitosamente.",
                'tipo'=>'success'
            ];
        }else{
            return[
                'msg'=>"Hubo un error. No fue posible borrar el registro.",
                'tipo'=>'error'
            ];
        }
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
            public function registrarActuacion() {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $codigo_Evento = $_POST['codigo_evento'] ?? null;
                    $id_deportistas = $_POST['id_deportistas'] ?? [];
                    $modalidades = $_POST['modalidades'] ?? [];
                    $categoriasxPeso = $_POST['categoriasxPeso'] ?? [];
                    $posiciones = $_POST['posiciones'] ?? [];
            
                    if (empty($codigo_Evento)) {
                        return [
                            'success' => false,
                            'msg' => "Debe seleccionar un evento.",
                            'tipo' => 'error',
                            'codigo_evento' => null
                        ];
                    }
            
                    if (empty($id_deportistas)) {
                        return [
                            'success' => false,
                            'msg' => "Debe seleccionar al menos un deportista.",
                            'tipo' => 'error',
                            'codigo_evento' => $codigo_Evento
                        ];
                    }
            
                    // Llamar al modelo
                    $resultado = $this->eventModel->registrarActuacion(
                        $codigo_Evento,
                        $id_deportistas,
                        $modalidades,
                        $categoriasxPeso,
                        $posiciones
                    );
            
                    if ($resultado === false) {
                        return [
                            'success' => false,
                            'msg' => "Ocurrió un error al registrar/actualizar las actuaciones.",
                            'tipo' => 'error',
                            'codigo_evento' => $codigo_Evento
                        ];
                    }
            
                    $insertados = $resultado['insertados'] ?? 0;
                    $actualizados = $resultado['actualizados'] ?? 0;
            
                    if ($insertados > 0 && $actualizados === 0) {
                        return [
                            'success' => true,
                            'msg' => "Se registraron correctamente {$insertados} actuaciones.",
                            'tipo' => 'success',
                            'codigo_evento' => $codigo_Evento
                        ];
                    } elseif ($insertados === 0 && $actualizados > 0) {
                        return [
                            'success' => true,
                            'msg' => "Se actualizaron correctamente {$actualizados} actuaciones existentes.",
                            'tipo' => 'success',
                            'codigo_evento' => $codigo_Evento
                        ];
                    } elseif ($insertados > 0 && $actualizados > 0) {
                        return [
                            'success' => true,
                            'msg' => "Se registraron {$insertados} nuevas actuaciones y se actualizaron {$actualizados} ya existentes.",
                            'tipo' => 'success',
                            'codigo_evento' => $codigo_Evento
                        ];
                    } else {
                        return [
                            'success' => false,
                            'msg' => "No se realizaron cambios. Todos los registros están ya actualizados.",
                            'tipo' => 'error',
                            'codigo_evento' => $codigo_Evento
                        ];
                    }
                }
            
                // Si no es POST
                return [
                    'success' => false,
                    'msg' => null,
                    'tipo' => null
                ];
            }
            public function showPerformanceByEvent(){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $codigo = $_POST['codigo_evento'] ?? null;
                $performances= $this->eventModel->showPerformanceByEvent($codigo);
                if (!empty($performances)) {
                    return [
                        'success' => true,
                        'msg' => "Las actuacionces en este evento fueron obtenidas exitosamente.",
                        'tipo' => 'success',
                        'data' => $performances
                    ];
                   
                }
                } else {
                    return [
                        'success' => false,
                        'msg' => "No se encontraron actuaciones de la Liga en este evento.",
                        'tipo' => 'error',
                        'data' => []
                    ];
                }
            }
            public function showPerformanceByAthlete(){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $email = $_POST['email'] ?? null;
                    $performances= $this->eventModel->showPerformanceByAthlete($email);
                    if (!empty($performances)) {
                        return [
                            'success' => true,
                            'msg' => "Las actuaciones de este deportista fueron obtenidas exitosamente.",
                            'tipo' => 'success',
                            'data' => $performances
                        ];
                    }
                } else {
                    return [
                        'success' => false,
                        'msg' => "No se encontraron actuaciones del Deportista.",
                        'tipo' => 'error',
                        'data' => []
                    ];
                }
            }
            public function getMyPerformances($email) {
              
                    $performances= $this->eventModel->showPerformanceByAthlete($email);
                    if (!empty($performances)) {
                        return [
                            'success' => true,
                            'msg' => "Las actuaciones de este deportista fueron obtenidas exitosamente.",
                            'tipo' => 'success',
                            'data' => $performances
                        ];
                    }else {
                    return [
                        'success' => false,
                        'msg' => "No se encontraron actuaciones del Deportista.",
                        'tipo' => 'error',
                        'data' => []
                    ];
                }
                
            }
}
?>