<?php
    include_once('./config/Conexion.php');
    
    include_once './models/ElementosModel.php';

    class ElementosController{
        private $db;
    
        private $eleModel;

        public function __construct(){
            $database= new Conexion();
            $this->db= $database->getConnection();
            $this->eleModel= new ElementosModel($this->db);
        }
        public function getCategoriaxEdad(){
            return $this->eleModel->getCategoriasXEdad();
        }

    }

    $objeto= new ElementosController();

    $array = $objeto->getCategoriaXEdad();

    /*foreach($array as $i=> $categoria){
        echo $i+1 . ".- ". $categoria['nombre_Categoria'] ."<br>"; -->Válido para fetch All
    }
    */
    foreach ($array as $i =>$elemento){
        echo $array[$i]['nombre_Categoria']."<br>";
        echo(count($array));
    }
    
?>