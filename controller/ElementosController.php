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
        }
//==================CATEGORÍA POR EDAD===================================================================
        public function getCategoriaXEdad(){
            return $this->eleModel->getCategoriasXEdad();
        }
        public function insertCategoriaxEdad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $categoriaxEdad=$_POST['categoriaxEdad'];
                $this->eleModel->insertCategoriaxEdad($categoriaxEdad);
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

    }  

?>