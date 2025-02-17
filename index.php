<?php

    require_once('controller/controlVistas.php');
    require_once 'controller/signupController.php';
    require_once 'controller/loginController.php';
    require_once 'controller/insertCommentsController.php';
    require_once 'controller/ClubController.php';
    require_once 'controller/DeportistaController.php';
    require_once 'controller/GetCommentsController.php';
    require_once 'controller/ElementosController.php';
    require_once 'controller/EventController.php';

    
    $controlVistas= new controlVistas();
    $signupController= new SignupController(); 
    $loginController= new LoginController();   
    $insertCommentsController= new InsertCommentsController();
    $clubControl= new ClubController();
    $depoControl= new DeportistaController();
    $eleControl= new ElementosController();
    $eventControl= new EventController();

    $fechaHora = new DateTime();
    $fechaHora->setTimezone(new DateTimeZone('America/Bogota'));
    $fechaA = $fechaHora->format('Y-m-d');
    $horaA = $fechaHora->format('H:i:s');
 
    
    $action= $_GET['action'] ?? 'principal';

    switch ($action){

        case 'principal':            
            include './views/principal.php';
            break;
        case 'registro':
            if($_SERVER["REQUEST_METHOD"]=="POST"){               
                $signupController->registrar();               
            }else{
                include './views/principal.php';
            }         
            break;
        case 'sidebar':
            $controlVistas->sidebar();
            echo"Y ahora con el sidebar";
            break;
        case 'loguear':
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $loginController->login(); 
            }else{
                include './views/principal.php';
            }break;
//====================================================================================
            case 'insert_comment':
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $insertCommentsController->insertCommment();
            }else{
                include './views/principal.php';
            }break;
//=====================================================================================
            // En tu archivo index.php
            case 'get_comments':
                $getCommentsController = new GetCommentsController();
                $getCommentsController->getComments();
                break;
//=====================================================================================DANDO LIKE::::
            case 'dando_like': 
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $insertCommentsController->darLike($fechaA, $horaA);    
                }else{
                    include './views/principal.php';
                }break;
              
//==========================================================================================
            case 'verify_email':
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $signupController->verificarCuenta();
                    
                }
                include 'views/verify_email_confirm.php';  // Esto se ejecuta después de la verificación
                break;
            case'recover_pass':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $datos=$loginController->recover_pass_request();
                    
                }include 'views/rec_pass_form.php';
                break;
            case 'set_pass':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                   
                   
                }include 'views/set_new_password.php';
                break;
            case 'set_new_pass':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $loginController->establecer_newpass();
                }include 'views/set_new_password.php';
                break;
            case 'club_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    include 'view-profile/club_manage.php';
                }
                break;
            case 'sport_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                include 'view-nomina/sport_manage.php';
                }break;
                
            case 'event_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                include 'view-events/event-manage.php';
                }
                break;
            case 'insert_Club':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $clubControl->insertClub();   
                include 'view-profile/insert_Club.php';                     
                }else {
                include 'view-profile/insert_Club.php';
                }
                break;
            case 'insert_representante':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $clubControl->insertRepresentante(); 
                include 'view-profile/insert_representante.php';
                }else {
                include 'view-profile/insert_representante.php';
                }
                break;
            case 'list_club':
                $arrayC= $clubControl->getClubesByNombre();
                include 'view-profile/list_clubes.php';
                break;
            case 'list_repres':
                     $listaRep= $clubControl->listarRepresentantes();
                    include 'view-profile/list_repres.php';            
                    break;
            case 'search_club':
                $arrayC=$clubControl->buscarClub();
                include 'view-profile/list_clubes.php';
                break;
            case 'update_club':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                $clubControl->updateClub();
                $clubes=$clubControl->getClubesByNombre();
                }else{
                  $clubData=$clubControl->getClubesByNombre();
                  include_once './view-profile/update_club.php';
                }break;
            case 'delete_club':
                $clubControl->deleteClub();
                break;
            case 'search_repres':
                $listaRep= $clubControl->buscarRepresentantes();
                include 'view-profile/list_repres.php';            
                break;
            case 'update_repre':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                $clubControl->updateRepre();
                $repres=$clubControl->buscarRepresentantes();
              
            
                }else {
                    $mensaje=0;
                    // Verificar si 'id_rep' está presente y no está vacío en la URL
                    if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) {
                        $repreData = $clubControl->buscarRepresentantes();                    
                        include_once 'view-profile/update_repres.php';
                    } else if((isset($_GET['id_rep']) && empty($_GET['id_rep']))) {
                        $mensaje=1;
                        // Si 'id_rep' no está presente o está vacío, incluir 'list_repres.php' y mostrar mensaje
                        include_once 'view-profile/list_repres.php';  // Incluye la vista de los representantes
                        // Añadir el contenedor con el mensaje después de incluir la vista
                       
                    }
                }
                break;
//=============================================================================================================================
            case 'delete_repre':
                $clubControl->deleteRepre();
                include 'view-profile/list_repres.php'; 
                break;
//=============================================================================================================================
            case 'insert_deportista':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                    $depoControl->insertDeport();
                    include 'view-nomina/insert_deportista.php';
                    }else {
                    include_once 'view-nomina/insert_deportista.php';;
                    }
                    break;
//=============================================================================================================================
            case 'insert_entrenador':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $depoControl->insertEntrenador();
                include 'view-nomina/insert_entrenador.php';
                }else {
                include_once 'view-nomina/insert_entrenador.php';;
                }
                break;
//=============================================================================================================================
            case 'insert_events':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $eventControl->insertEvento();
                include_once 'view-events/insert_event.php';
                }else {
                    include_once 'view-events/insert_event.php';
                }
                break;
//=============================================================================================================================
            case 'insert_programados':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $eventControl->insertEvento();
                include_once 'view-events/insert_programados.php';
                }else {
                include_once 'view-events/insert_programados.php';
                }
                break;                  
//==============================================================================================================================
            case 'get_paises':
                if($_SERVER['REQUEST_METHOD']=='GET'){ 
                    $eleControl->getPaises();                            
                    exit();                    
                }break;

            case 'get_dptos':
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $eleControl->getDepartamento(); 
                    exit();
                }break;

            case 'get_ciudad':
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $eleControl->getCiudad();
                    exit();
                    }break;
//================================================================================================================
            case 'list_deportista':
                $deportistas= $depoControl->listDeportistas();
                include_once 'view-nomina/list_deportista.php';
                break;
//================================================================================================================
            case 'list_entrenador':
                $entrenadores= $depoControl->listEntrenadores();
                include_once 'view-nomina/list_entrenador.php';
                break; 
//================================================================================================================
            case 'list_events':
                $eventos= $eventControl->listEventos();
                include_once 'view-events/list_events.php';
                break;
//================================================================================================================
            case 'list_programados':
                $eventos= $eventControl->listEventos();
                include_once 'view-events/list_programados.php';
                break;                        
//================================================================================================================
            case 'search_deportista':
                $deportistas= $depoControl->buscarDeportista();
                include_once 'view-nomina/list_deportista.php';
                break;
//================================================================================================================
            case 'search_entrenador':
                $entrenadores= $depoControl->buscarEntrenador();
                include_once 'view-nomina/list_entrenador.php';
                break;
//================================================================================================================
            case 'search_event':
                $eventos= $eventControl->buscarEvento();
                include_once 'view-events/list_events.php';
                break;                  
//================================================================================================================
            case 'update_deportista':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $depoControl->updateDeportista();
                    $data=$depoControl->buscarDeportista();
                }else{
                     if(isset($_GET['id_dep']) && !empty ($_GET['id_dep'])){
                            $data=$depoControl->buscarDeportista();
                            include_once 'view-nomina/update_deportista.php';
                    }else if(isset($_GET['id_dep']) && empty ($_GET['id_dep'])){
                            $deportistas=$depoControl->listDeportistas();
                            include_once 'view-nomina/list_deportista.php';
                    }
            }break;
//================================================================================================================
                case 'update_entrenador':
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $depoControl->updateEntrenador();
                        $data=$depoControl->buscarEntrenador();
                    }else{
                        if(isset($_GET['id_ent']) && !empty ($_GET['id_ent'])){
                        $data=$depoControl->buscarEntrenador();
                        include_once 'view-nomina/update_entrenador.php';
                    }else if(isset($_GET['id_ent']) && empty ($_GET['id_ent'])){
                        $entrenadores=$depoControl->listEntrenadores();
                        include_once 'view-nomina/list_entrenador.php';
                    }
                }break;
//================================================================================================================
            case 'update_event':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                $eventControl->updateEvento();
                $data=$eventControl->buscarEvento();
                }else{
                    if(isset($_GET['id_evento']) && !empty ($_GET['id_evento'])){
                    $data=$eventControl->buscarEvento();
                    include_once 'view-events/update_events.php';
                    }else if(isset($_GET['id_evento']) && empty ($_GET['id_evento'])){
                    $eventos=$eventControl->listEventos();
                    include_once 'view-events/list_events.php.php';
                    }
                }break;
//================================================================================================================
            case 'delete_event':
                $eventControl->deleteEvento();
                include_once 'view-events/list_events.php'; 
                break;
//=============================================================================================================================
            case 'delete_deportista':
                $depoControl->deleteDeportista();
                include 'view-nomina/list_deportista.php'; 
                break;
//=============================================================================================================================
            case 'delete_entrenador':
                $depoControl->deleteEntrenador();
                include 'view-nomina/list_entrenador.php'; 
                break;
//==========================================================================================================
            case 'insert_categoriaxEdad':
                $eleControl->insertCategoriaxEdad();
                include 'view-elementos/insert_elements.php';
                break;
//=======================================================================================================            
            case 'insert_divisionxPeso':
                $eleControl->insertDivisionPeso();
                include 'view-elementos/insert_elements.php';
                break;
//==========================================================================================================
            case 'insert_modalidad':
                $eleControl->insertModalidad();
                include 'view-elementos/insert_elements.php';
                break; 
//========================================================================================================                               
            case 'elements_manage':
                include 'view-elementos/elements_manage.php';
                break;
//========================================================================================================                
            case 'insert_elements':
                include 'view-elementos/insert_elements.php';
                break;
//========================================================================================================                
            case 'list_elements':
                
                $edades=$eleControl->getCategoriaXEdad();
                $modalidades=$eleControl->getModalidades();
                $divisiones=$eleControl->getDivisiones();
                include_once 'view-elementos/list_elementos.php';
                break;
//========================================================================================================                

}
?>
