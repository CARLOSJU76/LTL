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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nualidad = $_POST['nualidad'];
            $pdf = $_FILES['estados_pdf']['name'];
            $target_dir = "pdfs/";
            $target_file = $target_dir . basename($pdf);
            move_uploaded_file($_FILES["estados_pdf"]["tmp_name"], $target_file);
    
            if($this->eleModel->cargarEstados($nualidad, $pdf)) {
                return[
                    'msg' => "El documento fue cargado exitosamente. =)",
                    'tipo' => 'success'
                ];
            } else {
               return [
                    'msg' => "Hubo un error al cargar el documento. =(",
                    'tipo' => 'error'
                ];
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
            $email_entrenador=$_POST['user_email'];
            $id_lugar=$_POST['id_lugar'];
            $fecha=$_POST['fecha'];
            $hora=$_POST['hora'];
            if($this->eleModel->insertSession($email_entrenador, $id_lugar,$fecha, $hora)){
                echo"<br><p style='color:orange;'>Se ha agregado la sesión exitosamente</p>";
            }else{
                echo"<p style='color:orange;'>Se presentó un error al tratar de excluir el lugar de entrenamiento. Intenta nuevamente.</p>";
            }
            echo "<div style='display:flex; flex-direction: row;'>
                    <form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form> 
                    <form action='index.php?action=trainer_manage' method='get' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='trainer_manage'>Administrados de Sesiones</button>
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
    public function listYourSessions($fechaA,$horaA){
        $email=$_GET['user_email'] ?? '';
        return $this->eleModel->listYourSessions($email,$fechaA,$fechaA,$horaA);
    }
    public function listSessionsBySite($fechaA, $horaA){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_lugar=$_POST['id_lugar'];
            return $this->eleModel->listSessionsBySite($id_lugar,$fechaA,$horaA);
        }
    }
    public function listSessionsForAttendance($hoy){
        $email=$_GET['user_email']??'';
        return $this->eleModel->listYourSession_for_Attendance($hoy, $email);
    }
    public function deleteSession(){
        if($_SERVER['REQUEST_METHOD']='POST'){
            $id=$_POST['id'];
            if($this->eleModel->deleteSession($id)){
                echo "<br><p style='color:orange;'>Se ha eliminado la sesión de entrenamiento.</p>";
            }else{
                echo"<br><p style='color:orange;'>Hubo un error al tratar de elminar la sesión de entrenamiento.</p>";
            }
            echo "<div style='display:flex; flex-direction: row;'>
                    <form action='index.php?action=principal' method='post' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='principal'>Ir al inicio</button>
                    </form> 
                    <form action='index.php?action=list_your_sessions' method='get' enctype='multipart/form-data'>
                        <button type='submit' name='action' value='list_your_sessions'>Sesiones de Entrenamiento</button>
                    </form>
                </div>";
        }
    }
    public function registrarAsistencia() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_sesion = $_POST['id_sesion'];
            $id_deportistas = $_POST['id_deportista'] ?? [];
    
            if (empty($id_deportistas)) {
                return [
                    'success' => false,
                    'msg' => "Debe seleccionar al menos un deportista.",
                    'tipo' => 'error',
                    'id_sesion' => $id_sesion
                ];
            }
    
            $resultado = $this->eleModel->registrarAsistencia($id_sesion, $id_deportistas);
    
            if ($resultado === false) {
                return [
                    'success' => false,
                    'msg' => "Ocurrió un error al registrar la asistencia.",
                    'tipo' => 'error',
                    'id_sesion' => $id_sesion
                ];
            }
    
            if ($resultado['insertados'] > 0 && $resultado['duplicados'] === 0) {
                return [
                    'success' => true,
                    'msg' => "Se registraron correctamente {$resultado['insertados']} asistencias.",
                    'tipo' => 'success',
                    'id_sesion' => $id_sesion
                ];
            } elseif ($resultado['insertados'] > 0 && $resultado['duplicados'] > 0) {
                return [
                    'success' => true,
                    'msg' => "Se registraron {$resultado['insertados']} asistencias. {$resultado['duplicados']} ya estaban registradas.",
                    'tipo' => 'warning',
                    'id_sesion' => $id_sesion
                ];
            } else {
                return [
                    'success' => false,
                    'msg' => "Todos los deportistas ya estaban registrados. No se insertó nada.",
                    'tipo' => 'error',
                    'id_sesion' => $id_sesion
                ];
            }
        }
    
        return [
            'success' => false,
            'msg' => null,
            'tipo' => null
        ];
    }
    
    
    public function listWorkOutsByFecha(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $fecha1= $_POST['fecha1'];
            $fecha2= $_POST['fecha2'];
            return $this->eleModel->listWorkOuts($fecha1, $fecha2);
        }
    }
    public function asistenciaxSesion(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_sesion=$_POST['id_sesion'];
            return $this->eleModel->asistenciaxSesion( $id_sesion);
        }
    }
    public function asistenciaxSesionGet(){
       
            $id_sesion=$_GET['id_sesion'] ?? '';
            return $this->eleModel->asistenciaxSesion( $id_sesion);
        }
    public function listMyAttendants(){
        $email=$_GET['user_email'] ?? '';
        return $this->eleModel->listMyAttendans($email);
    }
    public function otorgarEstimulo() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigos = $_POST['codigo_asistencia'];
        $estimulos = $_POST['estimulo'];
        $errores = 0;

        for ($i = 0; $i < count($codigos); $i++) {
            $codigo = $codigos[$i];
            $estimulo = $estimulos[$i];

            if (!empty($estimulo)) {
                $resultado = $this->eleModel->otorgarEstimulo($codigo, $estimulo);
                if (!$resultado) {
                    $errores++;
                }
            }
        }

        if ($errores === 0) {
            return [
                'success' => true,
                'msg' => "Los estímulos fueron otorgados exitosamente.",
                'tipo' => 'success'
            ];
        } else {
            return [
                'success' => false,
                'msg' => "Hubo un error. No fue posible otorgar todos los estímulos.",
                'tipo' => 'error'
            ];
        }
    }

    // Si no es POST, no hace nada
    return [
        'success' => false,
        'msg' => null,
        'tipo' => null
    ];
}

    public function getEstimulos(){
        return $this->eleModel->getEstimulos();
    }
    public function getSessionsBySport() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_deportista = $_POST['id_deportista'];
    
            // Obtener sesiones desde el modelo
            $sesiones = $this->eleModel->getSessionsBySport($id_deportista);
    
            if (!empty($sesiones)) {
                return [
                    'success' => true,
                    'msg' => "Las asistencias del deportista fueron obtenidas exitosamente.",
                    'tipo' => 'success',
                    'data' => $sesiones
                ];
               
            }
            } else {
                return [
                    'success' => false,
                    'msg' => "No se encontraron asistencias para el deportista.",
                    'tipo' => 'error',
                    'data' => []
                ];
            }
        }
        public function obtenerCategoriasxPeso() {
            $id_ce = $_GET['id_ce'] ?? null;
            $id_mod = $_GET['id_mod'] ?? null;
        
            if (!$id_ce || !$id_mod) {
                echo json_encode([]);
                return;
            }
        
            // Suponiendo que tienes un modelo que hace esto:
            $categorias = $this->eleModel->getCategoriaxPesoPorEdadYModalidad($id_ce, $id_mod);
        
            header('Content-Type: application/json');
            echo json_encode($categorias);
        }
        
    }


?>