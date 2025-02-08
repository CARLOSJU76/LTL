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
            return $this->eleModel->getPaises();            
        }
        public function insertDep(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $dep=$_POST['departamento'];
                $id_pais=$_POST['id_pais'];
                $this->eleModel->insertDep($dep, $id_pais);
            }
        }
        public function getDepartamento(){
            return $this->eleModel->getDep();            
        }
        public function insertCiudad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $ciudad=$_POST['ciudad'];
                $id_depart=$_POST['id_depart'];
                $this->eleModel->insertDep($id_depart, $id_depart);
            }    
        }
        public function getCiudad(){
        return $this->eleModel->getCiudad();            
        }
    }
         

?>