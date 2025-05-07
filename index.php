<?php

    require_once 'controller/signupController.php';
    require_once 'controller/loginController.php';
    require_once 'controller/insertCommentsController.php';
    require_once 'controller/ClubController.php';
    require_once 'controller/DeportistaController.php';
    require_once 'controller/GetCommentsController.php';
    require_once 'controller/ElementosController.php';
    require_once 'controller/EventController.php';


    $signupController= new SignupController();
    $loginController= new LoginController();
    $insertCommentsController= new InsertCommentsController();
    $clubControl= new ClubController();
    $depoControl= new DeportistaController();
    $eleControl= new ElementosController();
    $eventControl= new EventController();
    $email_user= $loginController->get_email_user();

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
        case 'loguear':
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $loginController->login();
                    // Redireccionar si el login fue exitoso
                header("Location: index.php?action=principal");
                exit;
            } else {
                include './views/principal.php';
            }break;
//===================================================================================
        case 'get_user_email':
                $email_user=$loginController->get_email_user();
                break;
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
           
            case 'sport_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                include 'view-nomina/sport_manage.php';
                }break;

            case 'list_repres':
                     $listaRep= $clubControl->listarRepresentantes();
                    include 'view-profile/list_repres.php';
                    break;
            case 'search_club':
                $arrayC=$clubControl->buscarClub();
                include 'view-profile/list_clubes.php';
                break;
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
                    include_once 'view-nomina/insert_deportista.php';
                    }
                    break;
//=============================================================================================================================
            case 'insert_entrenador':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                $depoControl->insertEntrenador();
                include 'view-nomina/insert_entrenador.php';
                }else {
                include_once 'view-nomina/insert_entrenador.php';
                }
                break;
//=============================================================================================================================
            
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


//========================================================================================================
            case 'view_auxiliar':
                include 'view_auxiliar.php';
                break;
//=====================================================================================
            case 'get_modalidades':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $eleControl->getModalidadesG();
                    exit();
                }break;
//======================================================================================================
            case 'get_categorias':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $eleControl->getCategoriasG();
                    exit();
                }break;
//=======================================================================================================
            case 'get_divisiones':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $eleControl->getDivisionesG();
                    exit();
                }break;
//====================SECCIÓN CLUB MANAGE=================================================================
//========================================================================================================
            case 'club_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $permitido=4;
                    $title = "Gestión de Clubes";
                    $content = __DIR__ . '/view-profile/club_manage.php';
                    include __DIR__ . '/layouts/main.php';
            }break;
//========================================================================================================
            case 'insert_Club':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $permitido=4;
                    $resultado=$clubControl->insertClub();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    $title = "Registro de Clubes";
                    $content = __DIR__ . '/view-profile/insert_Club.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                }else {
                    $permitido=4;
                    $title = "Registro de Clubes";
                    $content = __DIR__ . '/view-profile/insert_Club.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                }break;
//====================================================================================================
                case 'list_club':
                    $permitido=4;
                    $resultado= $clubControl->getClubesByNombre();
                    $arrayC=$resultado['data'];
                    $title = "Relación de Clubes";
                    $content = __DIR__ . '/view-profile/list_clubes.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                    break;
//=====================================================================================================
            case 'update_club':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                $permitido = 4;   
                $resultado=$clubControl->updateClub();
                $clubes=$clubControl->getClubesByNombre();
                $_SESSION['msg1']=$resultado['msg'];
                $_SESSION['tipo1']=$resultado['tipo'];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
                }else{
                    if(isset($_GET['codigo_club']) && !empty ($_GET['codigo_club'])){
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                    $permitido=4;
                    $resultado=$clubControl->getClubesByNombre();
                    $clubData=$resultado['data'];
                    $_SESSION['msg']=$resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    $title = "Actualizar Eventos";
                    $content = __DIR__ . '/view-profile/update_club.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                    exit;
                    }else {
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        $permitido = 4;   
                        $_SESSION['msg']="No es posible acceder a este recurso.";
                        $_SESSION['tipo']="error";
                        header("Location: index.php?action=list_club");
                        exit();
                    }
            }
//=====================================================================================================
//=====================================================================================================
                case 'insert_representante':
                    if($_SERVER["REQUEST_METHOD"]== "POST"){
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        $permitido=4;
                    $resultado=$clubControl->insertRepresentante();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    $title = "Registro de Representantes de Club";
                    $content = __DIR__ . '/view-profile/insert_representante.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                    }else {
                        $permitido=4;
                        $title = "Registro de Representantes de Club";
                        $content = __DIR__ . '/view-profile/insert_representante.php';
                        include __DIR__ . '/layouts/main_clubes.php';
                    }break;
//================SECCIÓN ADMINISTRAR ELEMENTOS===========================================================
//========================================================================================================
case 'elements_manage':
    
    $permitido=4;
    $title = "Administrar Elementos";
    $content = __DIR__ . '/view-elementos/elements_manage.php';
    include __DIR__ . '/layouts/main.php';
    break;
//========================================================================================================
case 'insert_elements':
    
    $permitido=4;
    $title = "Registrar Elementos";
    $content = __DIR__ . '/view-elementos/insert_elements.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;
//==========================================================================================================
case 'insert_categoriaxEdad':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;
    $resultado=$eleControl->insertCategoriaxEdad();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=insert_elements");
    exit();
//==========================================================================================================
case 'insert_modalidad':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;    
    $resultado=$eleControl->insertModalidad();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=insert_elements");
    exit();

//=======================================================================================================
case 'insert_divisionxPeso':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;   
    $resultado= $eleControl->insertDivisionPeso();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=insert_elements");
    exit();
//========================================================================================================
case 'list_elements':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;   
    $edades=$eleControl->getCategoria();
    $modalidades=$eleControl->getModalidades();
    $divisiones=$eleControl->getDivisiones();
    $title = "Relación de Categorías y Modalidades";
    $content = __DIR__ . '/view-elementos/list_elementos.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;

//========================================================================================================
case 'delete_elements':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;  
    $title = "Relación de Categorías y Modalidades";
    $content = __DIR__ . '/view-elementos/delete_elements.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;

//========================================================================================================
case 'delete_categoria':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;  
    $resultado=$eleControl->deleteCategoria();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=list_elements");
    exit();

//========================================================================================================
case 'delete_modalidad':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;  
    $resultado=$eleControl->deleteModalidad();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=list_elements");
    exit();

//========================================================================================================
case 'delete_division':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4; 
    $resultado=$eleControl->deleteDivision();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=list_elements");
    exit();
//=============================================================================================================
case 'lugar_entrenamiento':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;  
    $lugares= $eleControl->listLugares();
    $title = "Relación de Categorías y Modalidades";
    $content = __DIR__ . '/view-elementos/lugar_entrenamiento.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;
//===============================================================================================
case 'insert_lugar':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4;   
    $resultado= $eleControl->insertLugar();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=lugar_entrenamiento");
    exit();
//=============================================================================================================
case 'search_lugar':
    if(isset($_GET['id_lugar']) && !empty ($_GET['id_lugar'])){
        $lugares=$eleControl->buscarLugar();
        include_once 'view-elementos/lugar_entrenamiento.php';
        }else if(isset($_GET['id_lugar']) && empty ($_GET['id_lugar'])){
        $lugares=$eleControl->listLugares();
        include_once 'view-elementos/lugar_entrenamiento.php';
        }break;
//=============================================================================================================
case 'delete_lugar':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=4; 
    $resultado=   $eleControl->deleteLugar();
    $_SESSION['msg']= $resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=lugar_entrenamiento");
    exit();
//===================GESTIÓN DE EVENTOS========================================================================
//=============================================================================================================
        case 'event_manage':
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $title = "Administrar Eventos";
                $permitido=4;
                $content = __DIR__ . '/view-events/event-manage.php';
                include __DIR__ . '/layouts/main.php';
            }break;
//=======================================================================================================
        case 'insert_events':
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido = 4;          
                $resultado=$eventControl->insertEvento();
                $title = "Cargar Eventos";
                $_SESSION['msg'] = $resultado['msg'];
                $_SESSION['tipo'] = $resultado['tipo'];
                header("Location: index.php?action=insert_events");
                exit();
            }else {
                $permitido = 4;
                $title = "Consultar Actuaciones por Evento";
                $content = __DIR__ . '/view-events/insert_event.php';
                include __DIR__ . '/layouts/main_eventos.php';
            }break;
//================================================================================================================
        case 'list_events':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
            $eventos= $eventControl->listEventos();
            $title = "Consultar Eventos Finalizados";
            $content = __DIR__ . '/view-events/list_events.php';
            include __DIR__ . '/layouts/main_eventos.php';
            break;
//================================================================================================================
        case 'list_programados':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
            $eventos= $eventControl->listEventos();
            $title = "Consultar Eventos Programados";
            $content = __DIR__ . '/view-events/list_programados.php';
            include __DIR__ . '/layouts/main_eventos.php';
                break;
//================================================================================================================
        case 'search_event':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
            $resultado= $eventControl->buscarEvento();
            $eventos=$resultado['data'];
            $_SESSION['msg'] = $resultado['msg'];
            $_SESSION['tipo'] = $resultado['tipo'];  
            $title = "Consultar Eventos";
            $content = __DIR__ . '/view-events/list_events.php';
            include __DIR__ . '/layouts/main_eventos.php';
            break;
//================================================================================================================
        case 'update_event':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido = 4;   
                $eventControl->updateEvento();
                $_SESSION['msg']=$resultado['msg'];
                $_SESSION['tipo']=$resultado['tipo'];
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }else{
            if(isset($_GET['id_evento']) && !empty ($_GET['id_evento'])){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido = 4;   
                $resultado=$eventControl->buscarEvento();
                $data=$resultado['data'];
                $_SESSION['msg']=$resultado['msg'];
                $_SESSION['tipo']=$resultado['tipo'];
                $title = "Actualizar Eventos";
                $content = __DIR__ . '/view-events/update_events.php';
                include __DIR__ . '/layouts/main_eventos.php';
                exit;
            }else {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido = 4;   
                $_SESSION['msg']="No es posible acceder a este recurso.";
                $_SESSION['tipo']="error";
                header("Location: index.php?action=list_events");
                exit();
            }
        }
//================================================================================================================
        case 'delete_event':
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
          
            $resultado=$eventControl->deleteEvento();
            $_SESSION['msg'] = $resultado['msg'];
            $_SESSION['tipo'] = $resultado['tipo'];
            $redirect = $_SERVER['HTTP_REFERER'];  
            header("Location: $redirect ");
            exit();
//=======================================================================================================
        case 'registrar_actuacion':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido = 4;   
        
                $resultado=$eventControl->registrarActuacion();
                $_SESSION['msg']= $resultado['msg'];
                $_SESSION['tipo'] = $resultado['tipo'];
                 $title = "Registrar Actuación";
                $content = __DIR__ . '/view-events/registro_actuaciones.php';
                $redirect = $_SERVER['HTTP_REFERER'];  
                header("Location: $redirect ");
            }else{
                $permitido = 4;   
                $eventos= $eventControl->getEventos();// -> función para listar eventos
                $deportistas= $depoControl->listSportman();
                $modalidades= $eleControl->getModalidades(); //-> función para listar modalidades
                //$divisiones= $eleControl->getDivisiones(); //-> función para listar categorías
                $title = "Registrar Actuación";
                $content = __DIR__ . '/view-events/registro_actuaciones.php';
                include __DIR__ . '/layouts/main_eventos.php';
            }break;
//=======================================================================================================
        case 'show_performanceByEvent':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
            $permitido = 4;   
            $resultado = $eventControl->showPerformanceByEvent();
        
            // Verifica si el resultado es un array y contiene las claves esperadas
            if (is_array($resultado) && isset($resultado['data'])) {
                $performances = $resultado['data'];
                $_SESSION['msg'] = $resultado['msg'];
                $_SESSION['tipo'] = $resultado['tipo'];
            } else {
                if (session_status() === PHP_SESSION_NONE) {
                session_start();
                }
                $permitido = 4;   
                // Si no hay datos o hay un problema, asignamos valores predeterminados
                $performances = [];
                $_SESSION['msg']= "No hay registros incluidos en este evento.";
                $_SESSION['tipo'] = "error";
            }
        
            $title = "Consultar Actuaciones por Evento";
            $content = __DIR__ . '/view-events/performances_by_event.php';
            include __DIR__ . '/layouts/main_eventos.php';
            } else {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
            $eventos = $eventControl->getEventos(); // Función para listar eventos
            $title = "Consultar Actuaciones por Evento";
            $content = __DIR__ . '/view-events/performances_by_event.php';
            include __DIR__ . '/layouts/main_eventos.php';
            }break;
//=======================================================================================================
    case 'show_performanceByAthlete':
        if($_SERVER['REQUEST_METHOD']=='POST'){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
            $permitido = 4;   
            $resultado=$eventControl->showPerformanceByAthlete();
            $performances= $resultado['data'];
            $_SESSION['msg']  = $resultado['msg'];
            $_SESSION['tipo']  = $resultado['tipo'];
            $title = "Consultar Actuaciones por Deportista";
            $content = __DIR__ . '/view-events/performances_by_athlete.php';
            include __DIR__ . '/layouts/main_eventos.php';
        }else{
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 4;   
            $deportistas= $depoControl->listSportman();// -> función para listar eventos
            $title = "Consultar Actuaciones por Deportista";
            $content = __DIR__ . '/view-events/performances_by_athlete.php';
            include __DIR__ . '/layouts/main_eventos.php';
        }break;
//===============================SECCIÓN PLATAFORMA======================================================
//========================================================================================================
case 'platform_manage':    
    $title = "Administrar Plataforma";
    $permitido=4;
    $content = __DIR__ . '/view_plataforma/platform_manage.php';
    include __DIR__ . '/layouts/main.php';
    break;
//========================================================================================================
case 'cargar_estados':
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 4;
        $resultado = $eleControl->cargarEstados();

        $title = "Cargar Estados Financieros";
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=cargar_estados");
        exit();
    } else {
        $permitido = 4;
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/insert_estados.php';
        include __DIR__ . '/layouts/main_plataforma.php';
    }
    break;
//=======================================================================================================
case 'ver_estados':
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $permitido = 4;
        $estadosf= $eleControl->listarEstadosF();
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/ver_estados.php';
        include __DIR__ . '/layouts/main.php';
    }break;
//=======================================================================================================
case 'ver_estadosf':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $permitido = 4;
        $estates= $eleControl->getEstadosById();
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/ver_anio.php';
        include __DIR__ . '/layouts/main.php';
    }break;
//=====================================================================================================0=
case 'ver_mision':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido = 4;
    $mision= $eleControl->getMision();
    $title = "Consultar Actuaciones por Evento";
    $content = __DIR__ . '/view_plataforma/ver_mision.php';
    include __DIR__ . '/layouts/main.php';
    break;
//=======================================================================================================
case 'ver_vision':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido = 4;
    $vision= $eleControl->getVision();
    $title = "Consultar Actuaciones por Evento";
    $content = __DIR__ . '/view_plataforma/ver_vision.php';
    include __DIR__ . '/layouts/main.php';
    break;
//========================================================================================================
case 'update_mision':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 4;
        $eleControl->updateMision();
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=update_mision");
        exit();
    }else{
        $permitido = 4;
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/update_mision.php';
        include __DIR__ . '/layouts/main_plataforma.php';
        
    }break;
//===========================================================================================================
case 'update_vision':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 4;
        $eleControl->updateVision();
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=update_vision");
        exit();
    }else{
        $permitido = 4;
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/update_vision.php';
        include __DIR__ . '/layouts/main_plataforma.php';
    }break;



case 'trainer_manage':
            if($_SERVER['REQUEST_METHOD']=='GET'){
                //include 'view_sesiones/trainer_manage.php';
                include 'view_sesiones/trainer_m_opcional.php';
            }break;
case 'schedule_session':
            if($_SERVER['REQUEST_METHOD']=='POST'){
               $eleControl->insertSession();
            }else{
                include_once 'view_sesiones/sesion_program.php';
            }break;
case 'list_sessionById':
      if($_SERVER['REQUEST_METHOD']=='POST'){
            $sesiones=$eleControl->listSessionbyTrainer();
            include_once 'view_sesiones/list_sesiones.php';
        }else{
            include_once 'view_sesiones/list_sesiones.php';
        }break;
case 'list_sessionByFecha':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sesiones=$eleControl->listSessionByDate();
        include_once 'view_sesiones/list_sesionByFecha.php';
    }else{
        include_once 'view_sesiones/list_sesionByFecha.php';
    }break;
case 'list_sessionBySite':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sesiones=$eleControl->listSessionsBySite($fechaA,$horaA);
        include_once 'view_sesiones/list_sesionBySite.php';
    }else{
        include_once 'view_sesiones/list_sesionBySite.php';
    }break;


case 'list_your_sessions':
    $sesiones=$eleControl->listYourSessions($fechaA, $horaA);
    include_once 'view_sesiones/list_mySesiones.php';
    break;
case 'delete_session':
    $eleControl->deleteSession();
    break;
    case 'attendance_register':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $resultado = $eleControl->registrarAsistencia();

            $msg = $resultado['msg'];
            $tipo = $resultado['tipo'];
            $id_sesion = $resultado['id_sesion'] ?? null;
            $estimulos = $eleControl->getEstimulos();
            $title = "Registrar Asistencia";
            $content = __DIR__ . '/view_sesiones/registro_asistencias.php';
            include __DIR__ . '/layouts/main.php';
        }else if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sesiones = $eleControl->listSessionsForAttendance($fechaA);
            $deports = $depoControl->listDeportistas();
            $estimulos = $eleControl->getEstimulos();
               // Define título y contenido para el layout
               $title = "Registrar Asistencia";
               $content = __DIR__ . '/view_sesiones/registro_asistencias.php';

               // Incluye la plantilla base que carga el header, contenido y footer
               include __DIR__ . '/layouts/main.php';
        } else {
            $sesiones = $eleControl->listSessionsForAttendance($fechaA);
            $deports = $depoControl->listDeportistas();
            $estimulos = $eleControl->getEstimulos();

            // Define título y contenido para el layout
            $title = "Registrar Asistencia";
            $content = __DIR__ . '/view_sesiones/registro_asistencias.php';

            // Incluye la plantilla base que carga el header, contenido y footer
            include __DIR__ . '/layouts/main.php';
        }
        break;

case 'list_workout_byFecha':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $workouts= $eleControl->listWorkOutsByFecha();
        include_once 'view_sesiones/list_workOuts_by_fecha.php';
    }else{
        include_once 'view_sesiones/list_workOuts_by_fecha.php';
    }break;
case 'asistenciax_sesion':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $asistencias=$eleControl->asistenciaxSesion();

        include_once 'view_sesiones/asistenciax_sesion.php';
    }else{
        $myAttendats= $eleControl->listMyAttendants();

        include_once 'view_sesiones/asistenciax_sesion.php';
    }break;

    case 'verOtorgarEstimulo':
            if($_SERVER['REQUEST_METHOD']=='GET'){

            $asistencias=$eleControl->asistenciaxSesionGet();
            $estimulos=$eleControl->getEstimulos();
           include_once 'view_sesiones/otorgarEstimulo.php';
            }break;
    case 'otorgarEstimulo':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $resultado = $eleControl->otorgarEstimulo();

                $msg = $resultado['msg'];
                $tipo = $resultado['tipo'];
                $asistencias=$eleControl->asistenciaxSesionGet();
                $estimulos=$eleControl->getEstimulos();
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/otorgarEstimulo.php';
                include __DIR__ . '/layouts/main.php';
            }else{
                $asistencias=$eleControl->asistenciaxSesionGet();
                $estimulos=$eleControl->getEstimulos();
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/otorgarEstimulo.php';
                include __DIR__ . '/layouts/main.php';
            }break;
    case 'list_sesion_by_sport':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $resultado=$eleControl->getSessionsBySport();
                $sesiones= $resultado['data'];
                $msg = $resultado['msg'];
                $tipo = $resultado['tipo'];
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/list_sesiones_by_sportman.php';
                include __DIR__ . '/layouts/main.php';
            }else{
                $deportistas= $depoControl->listSportman();
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/list_sesiones_by_sportman.php';
                include __DIR__ . '/layouts/main.php';
            }break;
    
        case 'obtener_categoriasxpeso':
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $eleControl->obtenerCategoriasxPeso();
                exit();
            }break;
           
    }

?>
