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
        public function getCategoria(){
            return $this->eleModel->getAgeCat();
            
        }
//=======================================================================================================
public function insertCategoriaxEdad() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['categoriaxEdad']) && !empty(trim($_POST['categoriaxEdad']))) {
            $categoriaxEdad = trim($_POST['categoriaxEdad']);
            $resultado = $this->eleModel->insertAgeCat($categoriaxEdad);

            if ($resultado) {
                return [
                    'msg' => "La Categoría fue registrada exitosamente.",
                    'tipo' => "success"
                ];
            } else {
                return [
                    'msg' => "Hubo un error. NO fue posible ejecutar la consulta.",
                    'tipo' => "error"
                ];
            }
        } else {
            return [
                'msg' => "El campo 'Categoría por edad' es obligatorio.",
                'tipo' => "error"
            ];
        }
    }
}

//========================================================================================================

        public function insertModalidad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $modalidad=$_POST['modalidad'];
               $resultado= $this->eleModel->insertModalidad($modalidad);
                if($resultado){
                    return[
                        'msg'=>"La modalidad ha sido registrada exitosamente",
                        'tipo'=>"success"
                    ];
               }else{
                    return[
                        'msg'=>"Hubo un error, registro fallido.",
                        'tipo'=>"error"
                    ];
               }
            }else{
                return[
                    'msg'=> "Debes incluir una modalidad válida.",
                    'tipo'=> "error"
                ];
            }
        }
//=======================================================================================================
        public function getModalidad(){
            return $this->eleModel->getModalidad();
        }
//=======================================================================================================
        public function insertDivisionPeso(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $divisioxPeso=$_POST['divisionxPeso'];
                $id_ce=$_POST['id_ce'];
                $id_mod=$_POST['id_mod'];
                
               $resultado= $this->eleModel->insertDivisionPeso($divisioxPeso, $id_ce, $id_mod);
               if($resultado){
                    return [
                        'msg'=> "La Diviisión de Peso ha sido registrada exitosamente.",
                        'tipo'=> "success"
                    ];
               }else{
                return [
                    'msg'=> "Hubo un error. No fue posible hacer el registro",
                    'tipo'=> "error"
                ];
               }
            }else{
                return [
                    'msg'=> "Incluye datos válidos para la consulta",
                    'tipo'=> "error"
                ];
               }
        }
//==================================================================================================
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
                $resultado=$this->eleModel->deleteCategoria($codigo);
                if($resultado){
                    return[
                        'msg'=>"La Categoría ha sido eliminada con éxito",
                        'tipo'=>"success"
                    ];
                }else{
                    return ['msg'=>"Hubo un error. No fue posible eliminar el elemento.",
                        'tipo'=>"error"
                    ];
                }
        }else{
            return ['msg'=>"Prodedimiento errado. No fue posible eliminar el elemento.",
                'tipo'=>"error"
            ];
        }

    }
        public function deleteModalidad(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $id_modalidad= $_POST['id_modalidad'];
                $resultado=$this->eleModel->deleteModalidad($id_modalidad);

                if($resultado){
                    return[
                        'msg'=> "La Modalidad ha sido eliminada con éxito.",
                        'tipo'=>"success"
                    ];
                }else{
                    return[
                        'msg'=> "Hubo un error. No fue posible eliminar el elemento.",
                        'tipo'=>"error"
                    ];
                }
            }else{
                return[
                    'msg'=> "Procedimiento incorrecto. Vuelve a intentarlo.",
                    'tipo'=>"error"
                ];
            }
        } 
        public function deleteDivision(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $codigo_division= $_POST['id_division'];
                $resultado=$this->eleModel->deleteDivision($codigo_division);
                if($resultado){
                    return[
                        'msg'=>"La División por Peso ha sido eliminada con éxito.",
                        'tipo'=>"success"
                    ];
                }else{
                    return[
                        'msg'=>"Hubo un error. No fue posible eliminar el elemento",
                        'tipo'=>"error"
                    ];
                }
            }else{
                return[
                    'msg'=>"Hubo un error. No fue posible eliminar el elemento",
                    'tipo'=>"error"
                ];
            }
        } 

//=======================================================================================================
    public function cargarEstados(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nualidad = $_POST['nualidad'];
            $pdf = $_FILES['estados_pdf']['name'];
            $target_dir = "pdfs/";
            $target_file = $target_dir . basename($pdf);
            move_uploaded_file($_FILES["estados_pdf"]["tmp_name"], $target_file);
    
            return$this->eleModel->cargarEstados($nualidad, $pdf);
        }
    }
    public function updateEstados(){
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_estado = $_POST['id_estado'];
        
            $pdf = $_FILES['estados_pdf']['name'];
            $target_dir = "pdfs/";
            $target_file = $target_dir . basename($pdf);
            move_uploaded_file($_FILES["estados_pdf"]["tmp_name"], $target_file);
    
            return$this->eleModel->updateEstados( $pdf, $id_estado);
        }
    }
//===============================================================================================================
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
//=======================================================================================================
    public function updateMision(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nueva_mision=$_POST['nueva_mision'];
            if($this->eleModel->updateMision($nueva_mision) ){
                return[
                    'msg' => "La Misión ha sido cargada exitosamente. =)",
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
//=======================================================================================================
    public function updateVision(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nueva_vision=$_POST['nueva_vision'];
            if($this->eleModel->updateVision($nueva_vision) ){
                return[
                    'msg' => "La misión ha sido cargada exitosamente. =)",
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
//==============================================================================================================
    public function insertLugar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $lugar=$_POST['lugar'];
            $id_pais= $_POST['pais'];
            $id_dpto=$_POST['dpto'];
            $id_ciudad=$_POST['ciudad'];

            if($this->eleModel->insertLugar($lugar, $id_pais, $id_dpto, $id_ciudad)){
                return [
                    'msg'=> "El sitio de entrenamiento fué registrado exitosamente.",
                    'tipo'=>"success"
                ];
            }else{
                return [
                    'msg'=> "Hubo un error. No fue registrado el lugar de entrenamiento.",
                    'tipo'=>"error"
                ];
            }
        }else{
            return [
                'msg'=> "Hubo un error. No fue registrado el lugar de entrenamiento.",
                'tipo'=>"error"
            ];
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
                return [
                    'msg'=> "Datos del lugar fueron eliminados con éxito.",
                    'tipo'=>"success"
                ];
          }else{
                return[
                    'msg'=> "No fue posible borrar el registro.",
                    'tipo'=> "error"
                ];
          }
        }else{
            return[
                'msg'=> "Solicitud denegada. No es POST.",
                'tipo'=> "error"
            ];
        }
    }
    public function insertSession(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $email_entrenador=$_POST['user_email'];
            $id_lugar=$_POST['id_lugar'];
            $fecha=$_POST['fecha'];
            $hora=$_POST['hora'];
            return $this->eleModel->insertSession($email_entrenador, $id_lugar,$fecha, $hora);
        }
        
    }
    public function listSessionbyTrainer($fechaA, $horaA){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_entrenador= $_POST['id_entrenador'];
            return $this->eleModel->listSessionbyTrainer($id_entrenador, $fechaA, $horaA);
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
        return $this->eleModel->listYourSessions($email,$fechaA,$horaA);
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
             return $this->eleModel->deleteSession($id);
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
            $email=$_POST['user_email'] ?? '';
            return $this->eleModel->listWorkOuts($fecha1, $fecha2, $email);
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
        public function getmySessions($id_deportista) {
        // Obtener sesiones desde el modelo
            $sesiones = $this->eleModel->getSessionsBySport($id_deportista);
    
            if (!empty($sesiones)) {
                return [
                    'success' => true,
                    'msg' => "Las asistencias del deportista fueron obtenidas exitosamente.",
                    'tipo' => 'success',
                    'data' => $sesiones
                ];
               
            }else {
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
        public function sliderItems(){
            return $this->eleModel->sliderItems();
        }
        public function procesarSlider() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $targetDir = "uploads/slider/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                foreach ($_FILES['multimedia']['tmp_name'] as $i => $tmpName) {
                $name = $_FILES['multimedia']['name'][$i];
                $path = $targetDir . time() . '_' . basename($name);
                $type = mime_content_type($tmpName);
               
                  if (move_uploaded_file($tmpName, $path)) {
                        $tipo = str_starts_with($type, 'video') ? 'video' : 'imagen';
                        $this->eleModel->procesarSlider($tipo, $path);
                        return [
                            'msg' => "El archivo $name se ha subido correctamente.",
                            'tipo' => 'success'
                        ];
                  }else {
                        return [
                            'msg' => "Error al subir el archivo $name.",
                            'tipo' => 'error'
                        ];
                    }
            }
        }
        
        
    }
    public function toggleSlider() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            return $this->eleModel->toggleSliderItem($id);
        }
    }
    public function deleteSliderItem() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            return $this->eleModel->deleteSliderItem($id);
        }
    }
    public function getSliderItems() {
        return $this->eleModel->getSliderItems();
    }
    public function getUnidades(){
        return $this->eleModel->getUnidades();
    }
    public function creacionDePruebas(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $nombre_prueba=$_POST['nombre_prueba'];
            $unidades=$_POST['unidades'];
            return $this->eleModel->creacionDePruebas($nombre_prueba, $unidades);
        }
    }
    public function getTodasLasPruebas(){
        return $this->eleModel->getTodasLasPruebas();
    }
   public function ejecutarPrueba() {
    $entrenador_id = $_POST['entrenador_id'];
    $prueba_id = $_POST['prueba_id'];
    $fecha = $_POST['fecha'];
    $deportistas = $_POST['deportista']; // Corrección clave

    // Contadores
    $insertadas = 0;
    $actualizadas = 0;
    $fallidas = 0;

    foreach ($deportistas as $item) {
        $deportista_id = $item['deportista_id'];
        $resultado = $item['resultado'];

        $respuesta = $this->eleModel->ejecutarPrueba(
            $entrenador_id,
            $prueba_id,
            $fecha,
            $deportista_id,
            $resultado
        );

        switch ($respuesta) {
            case 2: // Actualización exitosa
                $actualizadas++;
                break;
            case 4: // Inserción exitosa
                $insertadas++;
                break;
            default: // Cualquier otro caso es error
                $fallidas++;
                break;
        }
    }

    // Construir mensaje para el usuario
    $total = $insertadas + $actualizadas + $fallidas;
    return [
        'tipo' => $fallidas > 0 ? 'warning' : 'success',
        'msg' => "Total procesadas: $total. Registradas por primera vez: $insertadas. Actualizadas: $actualizadas. Fallidas: $fallidas."
    ];
}
public function getResultadosPruebasXDeportista() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $prueba_id = $_POST['prueba_id'];
        $deportista= $_POST['deportista_id'];
        return $this->eleModel->getResultadosPruebasXDeportista($deportista, $prueba_id);
    }
}

}
?>