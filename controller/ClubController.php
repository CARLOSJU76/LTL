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

                return $this->clubModel->insertClub($nombre_club, $representante,$fecha_conformacion);
              
            }else{
                return[
                    'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                    'tipo'=>"error"
                ];
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
            $telefono=$_POST['telefono'];
            $photo= $_FILES['foto']['name'];
                $target_dir="fotos/";
                $target_file= $target_dir .basename($photo);
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
//============================================================================================================
                $resultado= $this->clubModel->insertRepresentante($nombre,$apellido, $codigo_td,
                                                $num_docum, $genero, $email, $telefono, $photo);
                if($resultado['tipo']=="success"){
                    $this->clubModel->setPerfilR($email);
                }
                return $resultado;
            }else{
                return[
                    'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                    'tipo'=>"error"
                ];
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
        public function getClub_byRepre_Email($email){
            return $this->clubModel->getClub_byRepre_Email($email);
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

                    return $this->clubModel->updateClub($nombre_club, $id_representante,$fecha_conformacion, $codigo);
                }else{
                    return[
                        'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                        'tipo'=>"error"
                    ];
                }
            }
            public function deleteClub(){
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $codigo=$_POST['codigo_club'];

                   return $this->clubModel->deleteClub($codigo);
                  
                }else{
                    return[
                        'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                        'tipo'=>"error"
                        ];
                }
            }
//===================================================================================================================
            public function updateRepre(){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $id=$_POST['id_rep'];
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    $codigo_td=$_POST['codigo_td'];
                    $num_docum=$_POST['num_docum'];
                    $genero=$_POST['genero'];
                    $email=$_POST['email'];
                    $telefono=$_POST['telefono'];
                    $foto= $_FILES['foto']['name'];

                    $fotoActual=$this->clubModel->getFotoR($id);

                        if(empty($foto)){
                        // El valor que regresa getFoto es un array, por lo que debemos acceder al campo 'foto'
                        $foto = $fotoActual[0]['foto'];  // Asumimos que getFoto devuelve un array con 'foto'
                        } else {

                        $target_dir="fotos/";
                        $target_file= $target_dir .basename($foto);
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                        }
            
                $elementos= $this->clubModel->getEmailR($id);//Agregado para actualizar los perfiles de usuario.
                $emailAntiguo= $elementos;
                $this->clubModel->quitarPerfilR($emailAntiguo);
                $this->clubModel->setPerfilR($email);

                        return $this->clubModel->updateRepre($nombre, $apellido, $codigo_td,
                                                 $num_docum, $genero, $email, 
                                                 $telefono, $foto,  $id);
                        
                }else{
                    return[
                        'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                        'tipo'=>"error"
                        ];
                }
            }
            public function deleteRepre(){
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $id_rep=$_POST['id_rep'];
                
                    $elementos= $this->clubModel->getEmailR(($id_rep));
                    $emailAntiguo= $elementos;
                    $this->clubModel->quitarPerfilR($emailAntiguo);
                    return $this->clubModel->deleteRepre($id_rep);
                }else{
                    return[
                        'msg'=> "Hubo un error. El solicitud POST no encontrada.",
                        'tipo'=>"error"
                        ];
                }
            }
            public function getFotoR($id){
                return $this->clubModel->getFotoR($id);
            }

            public function getEmailR($id_rep){
                return $this->clubModel->getEmailR($id_rep);
            }

}
?>