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
}
    

?>