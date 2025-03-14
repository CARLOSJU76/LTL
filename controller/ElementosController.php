<?php
    include_once('./config/Conexion.php');
    
    include_once './models/ElementosModel.php';

    class ElementosController{
        private $db;
    
        private $eleModel;

        
        public function clubManage(){
            require_once('./view-profile/club_manage.php');

        }
        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->eleModel= new ElementosModel($this->db);
        }
        public function insertPais(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $pais=$_POST['pais'];
                $this->eleModel->insertPais($pais);
            }
        }
        public function getPaises(){
            header('Content-Type: application/json');          
            $paises= $this->eleModel->getPaises();         
            echo json_encode($paises);
        }
        
        public function insertDep(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $dep=$_POST['departamento'];
                $id_pais=$_POST['id_pais'];
                $this->eleModel->insertDpto($dep, $id_pais);
            }
        }
//================================================================================

        public function getDepartamento(){
            header('Content-Type: application/json');
            if (isset($_GET['id_pais'])) {
            $id_pais = $_GET['id_pais'];
            $dptos=$this->eleModel->getDpto($id_pais);
            echo json_encode($dptos);    
        }else {
        // Si no se recibe el parámetro id_pais, devolver un error
            echo json_encode(['error' => 'ID de país no proporcionado']);
        }
}
//=================================================================================
        public function insertCiudad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $ciudad=$_POST['ciudad'];
                $id_dpto=$_POST['id_dpto'];
                $this->eleModel->insertCiudad($ciudad, $id_dpto);
        }
    }
        public function getCiudad(){
            header('Content-Type: application/json');    
            if (isset($_GET['id_dpto'])) {
                $id_dpto = $_GET['id_dpto'];
                $ciudades=$this->eleModel->getCiudad($id_dpto);
                echo json_encode($ciudades);    
            }else {
                // Si no se recibe el parámetro id_pais, devolver un error
                echo json_encode(['error' => 'ID de departamento no proporcionado']);
            }     
        } 
        public function getModalidades(){
            return $this->eleModel->getModalidades();
        }
        public function getTipoEvento(){
            return $this->eleModel->getTipoEvento();
        }                                                                           // insertAgeCat-getAgeCat
//==================CATEGORÍA POR EDAD===================================================================
        public function getCategoria(){
            return $this->eleModel->getAgeCat();
            
        }
        public function insertCategoriaxEdad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $categoriaxEdad=$_POST['categoriaxEdad'];
                $this->eleModel->insertAgeCat($categoriaxEdad);
            }
//========================================================================================================
        }
        public function insertModalidad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $modalidad=$_POST['modalidad'];
                $this->eleModel->insertModalidad($modalidad);
            }
        }
        public function getModalidad(){
            return $this->eleModel->getModalidad();
        }
//=======================================================================================================
        public function insertDivisionPeso(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $divisioxPeso=$_POST['divisionxPeso'];
                $id_ce=$_POST['id_ce'];
                $id_mod=$_POST['id_mod'];
                
                $this->eleModel->insertDivisionPeso($divisioxPeso, $id_ce, $id_mod);
            }
        }
        public function getDivisiones(){
            return $this->eleModel->getDivisionPeso();
        }
        public function getModalidadesG(){
            //header('Content-Type: application/json');          
            $modalidades= $this->eleModel->getModalidades();         
            echo json_encode($modalidades);
        }
        public function getCategoriasG(){
            //header('Content-Type: application/json');          
            $categorias= $this->eleModel->getAgeCat();         
            echo json_encode($categorias);
        }
        
        public function getDivisionesG(){
            header('Content-Type: application/json');    
            if (isset($_GET['id_categoria'])) {
                $id_categoria = $_GET['id_categoria'];
                $id_modalidad=  $_GET['id_modalidad'];
                $divisiones=$this->eleModel->getDivisionesById($id_categoria, $id_modalidad);
                echo json_encode($divisiones);    
            }else {
                // Si no se recibe el parámetro id_pais, devolver un error
                echo json_encode(['error' => 'ID de departamento no proporcionado']);
            }     
        } 
        public function deleteCategoria(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $codigo= $_POST['id_categoria'];
                $this->eleModel->deleteCategoria($codigo);
        }

    }
        public function deleteModalidad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $id_modalidad= $_POST['id_modalidad'];
                $this->eleModel->deleteModalidad($id_modalidad);
            }
        } 
        public function deleteDivision(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $codigo_division= $_POST['id_division'];
                $this->eleModel->deleteDivision($codigo_division);
        } 
    }
    public function cargarEstados(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nualidad=$_POST['nualidad'];
            $pdf= $_FILES['estados_pdf']['name'];
            $target_dir="pdfs/";
            $target_file= $target_dir .basename($pdf);
            move_uploaded_file($_FILES["estados_pdf"]["tmp_name"], $target_file);
            

            if($this->eleModel->cargarEstados($nualidad, $pdf) ){
                echo"<br><p style='color:orange;'>El documento fue cargado correctamente</p>";
                echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                                <button type='submit' name='action' value='principal'>Página de inicio</button>
                        </form>";
                }else{
                    echo"<p style='color:orange;'>Se presentó un error al cargar el documento. Intenta nuevamente.</p>";
                    echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                                 <button type='submit' name='action' value='principal'>Página de inicio</button>
                        </form>";
                }

        }
    }
    public function listarEstadosF(){
        return $this->eleModel->listarEstadosF();
    }
    public function getEstadosById(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id=$_POST['id'];
            return $this->eleModel->getEstadosById($id);
        }
    
    }
    public function getMision(){
        return $this->eleModel->getMision();
    }
    public function getVision(){
        return $this->eleModel->getVision();
    }
    public function updateMision(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nueva_mision=$_POST['nueva_mision'];
            if($this->eleModel->updateMision($nueva_mision) ){
                echo"<br><p style='color:orange;'>La misión fue actualizada exitosamente</p>";
            }else{
                echo"<p style='color:orange;'>Se presentó un error al tratar de actualizar el documento. Intenta nuevamente.</p>";
            }
            echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                             <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form>";
        }
    }
    public function updateVision(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nueva_vision=$_POST['nueva_vision'];
            if($this->eleModel->updateVision($nueva_vision) ){
                echo"<br><p style='color:orange;'>La Visión fue actualizada exitosamente</p>";
            }else{
                echo"<p style='color:orange;'>Se presentó un error al tratar de actualizar el documento. Intenta nuevamente.</p>";
            }
            echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                             <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form>";
        }
    }
    public function insertLugar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $lugar=$_POST['lugar'];
            $id_pais= $_POST['pais'];
            $id_dpto=$_POST['dpto'];
            $id_ciudad=$_POST['ciudad'];

            if($this->eleModel->insertLugar($lugar, $id_pais, $id_dpto, $id_ciudad)){
                echo"<br><p style='color:orange;'>El Sitio de entrenamiento fué incluido exitosamente</p>";
            }else{
                echo"<p style='color:orange;'>Se presentó un error al tratar de incluir el lugar de entrenamiento. Intenta nuevamente.</p>";
            }
            echo "<form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                             <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form>";
        }
    }
    public function listLugares(){
        $id=$_GET['id_lugar'] ?? '';
        return $this->eleModel->getLugares($id);
    }
    public function buscarLugar(){
        $id=$_GET['id_lugar']?? '';
    return $this->eleModel->buscarLugar($id);
    }
    public function deleteLugar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_lugar= $_POST['id_lugar'];
          if($this->eleModel->delete_lugar($id_lugar)){
            echo"<br><p style='color:orange;'>El Sitio de entrenamiento excluido de la base de datos exitosamente</p>";
          }else{
            echo"<p style='color:orange;'>Se presentó un error al tratar de excluir el lugar de entrenamiento. Intenta nuevamente.</p>";
          }
            echo "<div style='display:flex; flex-direction: row;'><form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='principal'>Ir al inicio</button>
                </form> 
                <form action='index.php?action=lugar_entrenamiento' method='post' enctype='multipart/form-data'>
                    <button type='submit' name='action' value='principal'>Sitios de Entrenamiento</button>
                </form>
                </div>";
        }
    }
    public function insertSession(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_entrenador=$_POST['id_entrenador'];
            $id_lugar=$_POST['id_lugar'];
            $fecha=$_POST['fecha'];
            $hora=$_POST['hora'];
            if($this->eleModel->insertSession($id_entrenador, $id_lugar,$fecha, $hora)){
                echo"<br><p style='color:orange;'>Se ha agregado la sesión exitosamente</p>";
            }else{
                echo"<p style='color:orange;'>Se presentó un error al tratar de excluir el lugar de entrenamiento. Intenta nuevamente.</p>";
            }
            echo "<div style='display:flex; flex-direction: row;'>
                    <form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form> 
                    <form action='index.php?action=trainer_manage' method='get' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='trainer_manage'>Sitios de Entrenamiento</button>
                    </form>
                </div>";
        }
        
    }
    public function listSessionbyTrainer(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_entrenador= $_POST['id_entrenador'];
            return $this->eleModel->listSessionbyTrainer($id_entrenador);
        }
    }
    public function listSessionByDate(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $fecha1= $_POST['fecha1'];
            $fecha2= $_POST['fecha2'];
            return $this->eleModel->listSessionByDate($fecha1,$fecha2);
        }
    }
    public function listYourSessions(){
        $email=$_GET['user_email'] ?? '';
        return $this->eleModel->listYourSessions($email);
    }
}
    

?>