<?php

    require_once 'controller/signupController.php';
    require_once 'controller/loginController.php';
    require_once 'controller/insertCommentsController.php';
    require_once 'controller/ClubController.php';
    require_once 'controller/DeportistaController.php';
    require_once 'controller/GetCommentsController.php';
    require_once 'controller/ElementosController.php';
    require_once 'controller/EventController.php';
    require_once 'controller/RankingController.php';


    $signupController= new SignupController();
    $loginController= new LoginController();
    $insertCommentsController= new InsertCommentsController();
    $clubControl= new ClubController();
    $depoControl= new DeportistaController();
    $eleControl= new ElementosController();
    $eventControl= new EventController();
    $rankingControl= new RankingController();
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
                include 'views/set_new_password.php';
                break;

            case 'set_new_pass':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                     if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $resultado=$loginController->establecer_newpass();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                     header("Location: index.php?action=principal");
                exit;
                }
            case 'cambiar_pass':
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $permitido=4;
                    $resultado=$loginController->cambiar_pass();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                      header("Location: index.php?action=principal");
                exit;
                }else {
                    $permitido=4;
                    $title = "Cambiar Contraseña";
                    $content = __DIR__ . '/views/cambiar_pass.php';
                    include __DIR__ . '/layouts/main.php';
                }break;
//=============================================================================================================================

         
            
            case 'search_club':
                $arrayC=$clubControl->buscarClub();
                include 'view-profile/list_clubes.php';
                break;
           
            case 'search_repres':
                $listaRep= $clubControl->buscarRepresentantes();
                include 'view-profile/list_repres.php';
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
//================================SECCIÓN DE SESIONES DE ENTRENAMIENTO=====================================
//========================================================================================================
        case 'trainer_manage':
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $permitido=2;
                $title = "Gestión de Entrenamientos";
                $content = __DIR__ . '/view_sesiones/trainer_m_opcional.php';
                include __DIR__ . '/layouts/main.php';
                }break;
//========================================================================================================
        case 'schedule_session':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido=2;
                $resultado=$eleControl->insertSession();
                $_SESSION['msg']= $resultado['msg'];
                $_SESSION['tipo']=$resultado['tipo'];
                $title = "Programar Sesioenes de Entrenamiento";
                $content = __DIR__ . '/view_sesiones/sesion_program.php';
                include __DIR__ . '/layouts/main_sesiones.php';

            }else{
                 $permitido=2;
                $title = "Programar Sesioenes de Entrenamiento";
                $content = __DIR__ . '/view_sesiones/sesion_program.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }break;
//========================================================================================================
        case 'list_your_sessions':
            $permitido=2;
            $sesiones=$eleControl->listYourSessions($fechaA, $horaA);
            $title = "Relación de Sesiones Programadas";
            $content = __DIR__ . '/view_sesiones/list_mySesiones.php';
            include __DIR__ . '/layouts/main_sesiones.php';
            break;
//========================================================================================================
        case 'list_sessionByFecha':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $permitido=2;
                $sesiones=$eleControl->listSessionByDate();
                $title = "Consulta sesiones por Fecha";
                $content = __DIR__ . '/view_sesiones/list_sesionByFecha.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }else{
                $permitido=2;
                $title = "Consulta sesiones por Fecha";
                $content = __DIR__ . '/view_sesiones/list_sesionByFecha.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }break;
//=======================================================================================================
case 'list_sessionBySite':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $permitido=2;
        $sesiones=$eleControl->listSessionsBySite($fechaA,$horaA);
         $title = "Consulta sesiones por Escenarios de Entrenamiento";
        $content = __DIR__ . '/view_sesiones/list_sesionBySite.php';
        include __DIR__ . '/layouts/main_sesiones.php';
    }else{
        $permitido=2;
        $title = "Consulta sesiones por Escenarios de Entrenamiento";
        $content = __DIR__ . '/view_sesiones/list_sesionBySite.php';
        include __DIR__ . '/layouts/main_sesiones.php';
    }break;
//========================================================================================================
    case 'list_workout_byFecha':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $permitido=2;
        $workouts= $eleControl->listWorkOutsByFecha();
         $title = "Consulta sesiones por Fecha";
        $content = __DIR__ . '/view_sesiones/list_workOuts_by_fecha.php';
        include __DIR__ . '/layouts/main_sesiones.php';
    }else{
         $permitido=2;
        $title = "Consulta sesiones por Fecha";
        $content = __DIR__ . '/view_sesiones/list_workOuts_by_fecha.php';
        include __DIR__ . '/layouts/main_sesiones.php';
    }break;
//========================================================================================================
case 'delete_session':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=2;
    $resultado=$eleControl->deleteSession();
    $_SESSION['msg']=$resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
    header("Location: index.php?action=list_your_sessions&user_email=" . $_SESSION['email']);
    exit();
     case 'attendance_register':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 2;
            $resultado = $eleControl->registrarAsistencia();
            $_SESSION['msg'] = $resultado['msg'];
            $_SESSION['tipo'] = $resultado['tipo'];
            $id_sesion = $resultado['id_sesion'] ?? null;
            $estimulos = $eleControl->getEstimulos();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
        }else if ($_SERVER['REQUEST_METHOD']=='GET') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 2;
            $sesiones = $eleControl->listSessionsForAttendance($fechaA);
            $resultado = $depoControl->listDeportistas();
            $deports= $resultado['data'];
            $estimulos = $eleControl->getEstimulos();
               // Define título y contenido para el layout
               $title = "Registrar Asistencia";
               $content = __DIR__ . '/view_sesiones/registro_asistencias.php';
               include __DIR__ . '/layouts/main_sesiones.php';
        }break;
//========================================================================================================
 case 'otorgarEstimulo':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                  if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                $permmitido=2;
                $resultado = $eleControl->otorgarEstimulo();

                $_SESSION['msg'] = $resultado['msg'];
                $_SESSION['tipo'] = $resultado['tipo'];
                $asistencias=$eleControl->asistenciaxSesionGet();
                $estimulos=$eleControl->getEstimulos();
                 header("Location: index.php?action=attendance_register");
                exit();

            }else{
                $asistencias=$eleControl->asistenciaxSesionGet();
                $estimulos=$eleControl->getEstimulos();
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/otorgarEstimulo.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }break;
//========================================================================================================
    case 'verOtorgarEstimulo':
            if($_SERVER['REQUEST_METHOD']=='GET'){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido=2;
            $asistencias=$eleControl->asistenciaxSesionGet();
            $estimulos=$eleControl->getEstimulos();
            $title = "Registro de estimulos";
            $content = __DIR__ . '/view_sesiones/otorgarEstimulo.php';
            include __DIR__ . '/layouts/main_sesiones.php';
            }break;
    
    case 'asistenciax_sesion':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $permitido=2;
                $asistencias=$eleControl->asistenciaxSesion();
                 $title = "Asistencias por Sesión de Entrenamiento";
                $content = __DIR__ . '/view_sesiones/asistenciax_sesion.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }else{
                $permitido=2;
                $myAttendats= $eleControl->listMyAttendants();
                $title = "Asistencias por Sesión de Entrenamiento";
                $content = __DIR__ . '/view_sesiones/asistenciax_sesion.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }break;
//====================SECCIÓN DEPORTISTAS Y ENTRENADORES==================================================
//========================================================================================================
case 'sport_manage':
    if($_SERVER['REQUEST_METHOD']=='GET'){
        $permitido=0;
        $title = "Sección Deportistas y Entrenadores";
        $content = __DIR__ . '/view-nomina/sport_manage.php';
        include __DIR__ . '/layouts/main.php';
    }break;
//========================================================================================================
case 'list_deportista':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=0;
    $resultado= $depoControl->listDeportistas();
    $deportistas= $resultado['data'];
    $title = "Registro de Clubes";
    $content = __DIR__ . '/view-nomina/list_deportista.php';
    include __DIR__ . '/layouts/main_deportista.php';
    break;
//=============================================================================================================================
case 'list_deportista_Rep':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=1;
    $resultado= $depoControl->listDeportistas();
    $deportistas= $resultado['data'];
    $title = "Registro de Clubes";
    $content = __DIR__ . '/view-nomina/list_deportista_Rep.php';
    include __DIR__ . '/layouts/main.php';
    break;
case 'list_entrenadores_Rep':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=1;
    $resultado= $depoControl->listEntrenadores();
    $entrenadores= $resultado['data'];
    $title = "Registro de Clubes";
    $content = __DIR__ . '/view-nomina/list_entrenador_Rep.php';
    include __DIR__ . '/layouts/main.php';
    break;
//=============================================================================================================================
case 'insert_deportista':
    if($_SERVER["REQUEST_METHOD"]== "POST"){
          if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
        $permitido=0;
        $resultado= $depoControl->insertDeport();
        $_SESSION['msg']= $resultado['msg'];
        $_SESSION['tipo']=$resultado['tipo'];
        $title = "Registro Deportista";
        $content = __DIR__ . '/view-nomina/insert_deportista.php';
        include __DIR__ . '/layouts/main_deportista.php';
        }else {
            $permitido=0;
            $title = "Registro Deportista";
            $content = __DIR__ . '/view-nomina/insert_deportista.php';
            include __DIR__ . '/layouts/main_deportista.php';
        }break;
//================================================================================================================
case 'search_deportista':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $viene_de=$_GET['viene_de'];
    $desde=$_GET['desde'] ?? 'perfil_inicio';
    if($desde=="perfil_admin"){
         $permitido=0;
    }else{
        $permitido=1;
    }
   
    $deportistas= $depoControl->buscarDeportista();
     $title = "Actualizar Datos de Deportista";
   
    if($viene_de=="deportista_Rep"){
         $content = __DIR__ . '/view-nomina/list_deportista_Rep.php';
        include __DIR__ . '/layouts/main.php';
    }elseif($viene_de== "deportista_Adm"){
         $content = __DIR__ . '/view-nomina/list_deportista.php';
         include __DIR__ . '/layouts/main_deportista.php';
    }
    break;
//================================================================================================================
case 'update_deportista':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=0 ?? 1;
        $resultado=$depoControl->updateDeportista();
        $_SESSION['msg1']=$resultado['msg'];
        $_SESSION['tipo1']=$resultado['tipo'];
        
      header("Location: index.php?action=list_deportista");
                        exit();
    }else{
        if(isset($_GET['id_dep']) && !empty ($_GET['id_dep'])){
              if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
            $permitido=0 ?? 1;
            $data=$depoControl->buscarDeportista();
            $title = "Actualizar Eventos";
            $content = __DIR__ . '/view-nomina/update_deportista.php';
            include __DIR__ . '/layouts/main_deportista.php';
            exit;
        }
    }break;
//=============================================================================================================================
case 'delete_deportista':
     if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    $permitido=0;
    $resultado=$depoControl->deleteDeportista();
    $_SESSION['msg']=$resultado['msg'];
    $_SESSION['tipo']=$resultado['tipo'];
   header("Location: index.php?action=list_deportista");
                        exit();
//================================================================================================================
case 'list_entrenador':
     if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=0;
    $resultado= $depoControl->listEntrenadores();
    $entrenadores= $resultado['data'];
    $title = "Entrenadores";
    $content = __DIR__ . '/view-nomina/list_entrenador.php';
    include __DIR__ . '/layouts/main_deportista.php';
    break;
//================================================================================================================
case 'update_entrenador':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=0;
        $resultado=$depoControl->updateEntrenador();
         $_SESSION['msg1']=$resultado['msg'];
        $_SESSION['tipo1']=$resultado['tipo'];
        
        header("Location: index.php?action=list_entrenador");
        exit();
    }else{
        if(isset($_GET['id_ent']) && !empty ($_GET['id_ent'])){
             if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
            $permitido=0;
            $data=$depoControl->buscarEntrenador();
           $title = "Actualizar datos de Entrenador";
            $content = __DIR__ . '/view-nomina/update_entrenador.php';
            include __DIR__ . '/layouts/main_deportista.php';
            exit;
        }
    }break;
//=============================================================================================================================
case 'insert_entrenador':
    if($_SERVER["REQUEST_METHOD"]== "POST"){
          if (session_status() === PHP_SESSION_NONE){
                        session_start();
                    }
        $permitido=0;
        $resultado= $depoControl->insertEntrenador();
        $_SESSION['msg']= $resultado['msg'];
        $_SESSION['tipo']=$resultado['tipo'];
       header("Location: index.php?action=insert_entrenador");
        exit;
    }else {
          $permitido=0;
            $title = "Registro Entrenador";
            $content = __DIR__ . '/view-nomina/insert_entrenador.php';
            include __DIR__ . '/layouts/main_deportista.php';
    }break;
//================================================================================================================
case 'search_entrenador':
     if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $viene_de=$_GET['viene_de'];
    $desde=$_GET['desde'] ?? 'perfil_inicio';
    if($desde=="perfil_admin"){
        $permitido=0;
    }else{
        $permitido=1;
    }
    $entrenadores= $depoControl->buscarEntrenador();
    $title = "Datos del Entrenador";
    if ($viene_de=="entrenador_rep"){
          $content = __DIR__ . '/view-nomina/list_entrenador_Rep.php';
           include __DIR__ . '/layouts/main.php';
    }elseif($viene_de=="entrenador_adm"){
        $content = __DIR__ . '/view-nomina/list_entrenador.php';
        include __DIR__ . '/layouts/main_deportista.php';
    }
   
    break;
//=============================================================================================================================
case 'delete_entrenador':
    if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    $permitido=0;
    $resultado=$depoControl->deleteEntrenador();
    $_SESSION['msg1']=$resultado['msg'];
    $_SESSION['tipo1']=$resultado['tipo'];
    header("Location: index.php?action=list_entrenador");
    exit();


//====================SECCIÓN CLUB MANAGE=================================================================
//========================================================================================================
            case 'club_manage':
                if($_SERVER['REQUEST_METHOD']=='GET'){
                    $permitido=0;
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
                    $permitido=0;
                    $resultado=$clubControl->insertClub();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    $title = "Registro de Clubes";
                    $content = __DIR__ . '/view-profile/insert_Club.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                }else {
                    $permitido=0;
                    $title = "Registro de Clubes";
                    $content = __DIR__ . '/view-profile/insert_Club.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                }break;
//====================================================================================================
            case 'list_club':
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                    $permitido=0;
                    $resultado= $clubControl->getClubesByNombre();
                    $arrayC=$resultado['data'];
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
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
                    $permitido=0;
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
            case 'delete_club':
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $permitido=0;
                    $resultado=$clubControl->deleteClub();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    header("Location: index.php?action=list_club");
                    exit();
//=====================================================================================================
            case 'insert_representante':
                    if($_SERVER["REQUEST_METHOD"]== "POST"){
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        $permitido=0;
                    $resultado=$clubControl->insertRepresentante();
                    $_SESSION['msg']= $resultado['msg'];
                    $_SESSION['tipo']=$resultado['tipo'];
                    $title = "Registro de Representantes de Club";
                    $content = __DIR__ . '/view-profile/insert_representante.php';
                    include __DIR__ . '/layouts/main_clubes.php';
                    }else {
                        $permitido=0;
                        $title = "Registro de Representantes de Club";
                        $content = __DIR__ . '/view-profile/insert_representante.php';
                        include __DIR__ . '/layouts/main_clubes.php';
                    }break;
//========================================================================================================
            case 'list_repres':
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido=0;
                $resultado= $clubControl->listarRepresentantes();
                $listaRep=$resultado['data'];
                $title = "Relación de Representantes";
                $content = __DIR__ . '/view-profile/list_repres.php';
                include __DIR__ . '/layouts/main_clubes.php';
                break;
//========================================================================================================
            case 'update_repre':
                if($_SERVER['REQUEST_METHOD']=='POST'){

                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $permitido=0;
                    $resultado=$clubControl->updateRepre();
                    $repres=$clubControl->buscarRepresentantes();
                    $_SESSION['msg1']=$resultado['msg'];
                    $_SESSION['tipo1']=$resultado['tipo'];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }else {
                  
                    if (isset($_GET['id_rep']) && !empty($_GET['id_rep'])) {
                        $permitido=0;
                        $repreData = $clubControl->buscarRepresentantes();
                        $title = "Edición de datos de Representante";
                        $content = __DIR__ . '/view-profile/update_repres.php';
                        include __DIR__ . '/layouts/main_clubes.php';
                     
                    } else if((isset($_GET['id_rep']) && empty($_GET['id_rep']))) {
                        $permitido=0;
                        $mensaje=1;
                        $title = "Relación de Representantes";
                        $content = __DIR__ . '/view-profile/list_repres.php';
                        include __DIR__ . '/layouts/main_clubes.php';
                    }
                }break;
//=============================================================================================================================
            case 'delete_repre':

                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $permitido=0;
                $resultado=$clubControl->deleteRepre();
                $_SESSION['msg']= $resultado['msg'];
                $_SESSION['tipo']=$resultado['tipo'];
                header("Location: index.php?action=list_repres");
                exit();
//================SECCIÓN ADMINISTRAR ELEMENTOS===========================================================
//========================================================================================================
case 'elements_manage':
    
    $permitido=0;
    $title = "Administrar Elementos";
    $content = __DIR__ . '/view-elementos/elements_manage.php';
    include __DIR__ . '/layouts/main.php';
    break;
//========================================================================================================
case 'insert_elements':
    
    $permitido=0;
    $title = "Registrar Elementos";
    $content = __DIR__ . '/view-elementos/insert_elements.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;
//==========================================================================================================
case 'insert_categoriaxEdad':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=0;
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
    $permitido=0;    
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
    $permitido=0;   
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
    $permitido=0;   
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
    $permitido=0;  
    $title = "Relación de Categorías y Modalidades";
    $content = __DIR__ . '/view-elementos/delete_elements.php';
    include __DIR__ . '/layouts/main_elementos.php';
    break;

//========================================================================================================
case 'delete_categoria':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=0;  
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
    $permitido=0;  
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
    $permitido=0; 
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
    $permitido=0;  
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
    $permitido=0;   
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
    $permitido=0; 
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
                $permitido=0;
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
            $permitido = 0;   
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
            $permitido = 0;   
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
            $viene_de=$_GET['viene_de'];
            $permitido = 0;   
            $resultado= $eventControl->buscarEvento();
            $eventos=$resultado['data'] ?? [];
            $_SESSION['msg'] = $resultado['msg'];
            $_SESSION['tipo'] = $resultado['tipo'];  
            $title = "Consultar Eventos";
            if($viene_de == "programados"){
                $content = __DIR__ . '/view-events/list_programados.php';
            }elseif($viene_de== "finalizados"){
                 $content = __DIR__ . '/view-events/list_events.php';
            }
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
                $permitido = 0;   
        
                $resultado=$eventControl->registrarActuacion();
                $_SESSION['msg']= $resultado['msg'];
                $_SESSION['tipo'] = $resultado['tipo'];
                 $title = "Registrar Actuación";
                $content = __DIR__ . '/view-events/registro_actuaciones.php';
                $redirect = $_SERVER['HTTP_REFERER'];  
                header("Location: $redirect ");
            }else{
                $permitido = 0;   
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
            $permitido = 0;   
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
                $permitido = 0;   
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
            $permitido = 0;   
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
            $performances= $resultado['data']?? "";
            $_SESSION['msg'] = $resultado['msg'] ?? 'Este deportista no tiene registros.';
            $_SESSION['tipo'] = $resultado['tipo'] ?? 'error';
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
    $permitido=0;
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
        $permitido = -1;
        $estadosf= $eleControl->listarEstadosF();
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/ver_estados.php';
        include __DIR__ . '/layouts/main.php';
    }break;
//=======================================================================================================
case 'update_estados':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;
        $resultado = $eleControl->updateEstados();
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=update_estados");
        exit();
    }else{
        $permitido = 0;
        $estadosf= $eleControl->listarEstadosF();
        $title = "Actualizar Estados Financieros";
        $content = __DIR__ . '/view_plataforma/update_estadosf.php';
        include __DIR__ . '/layouts/main_plataforma.php';
    }break;
//=======================================================================================================
case 'ver_estadosf':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $permitido = -1;
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
    $permitido = -1; // Permiso para ver la misión
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
    $permitido = -1;
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
        $permitido = 0;
        $eleControl->updateMision();
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=update_mision");
        exit();
    }else{
        $permitido = 0;
        $mision= $eleControl->getMision();
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
        $permitido = 0;
        $eleControl->updateVision();
        $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';
        header("Location: index.php?action=update_vision");
        exit();
    }else{
        $permitido = 0;
         $vision= $eleControl->getVision();
        $title = "Consultar Actuaciones por Evento";
        $content = __DIR__ . '/view_plataforma/update_vision.php';
        include __DIR__ . '/layouts/main_plataforma.php';
    }break;

case 'list_sessionById':
      if($_SERVER['REQUEST_METHOD']=='POST'){
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;
            $resultado=$eleControl->listSessionbyTrainer($fechaA, $horaA);
              $entrenadores=$depoControl->getEntrenadores();
            $sesiones = $resultado['data'] ?? [];
            $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
            $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';

            $title = "Sesiones por Entrenador";
            $content = __DIR__ . '/view_sesiones/list_sesiones.php';
            include __DIR__ . '/layouts/main_sessiones_deportista.php';

        }else{
             if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;
            $entrenadores=$depoControl->getEntrenadores();
             $title = "Sesiones por Entrenador";
            $content = __DIR__ . '/view_sesiones/list_sesiones.php';
            include __DIR__ . '/layouts/main_sessiones_deportista.php';
        }break; 
//=========================================================================================================
    case 'list_sesion_by_sport':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $permitido=2;
                $resultado=$eleControl->getSessionsBySport();
                $sesiones = $resultado['data'] ?? [];
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/list_sesiones_by_sportman.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }else{
                $permitido=2;
                $deportistas= $depoControl->listSportman();
                $title = "Registrar Asistencia";
                $content = __DIR__ . '/view_sesiones/list_sesiones_by_sportman.php';
                include __DIR__ . '/layouts/main_sesiones.php';
            }break;
    
        case 'obtener_categoriasxpeso':
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $eleControl->obtenerCategoriasxPeso();
                exit();
            }break;
//=========================================================================================
case 'list_sessionById_dep':
      if($_SERVER['REQUEST_METHOD']=='POST'){
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 3;
            $resultado=$eleControl->listSessionbyTrainer($fechaA, $horaA);
              $entrenadores=$depoControl->getEntrenadores();
            $sesiones = $resultado['data'] ?? [];
            $_SESSION['msg'] = $resultado['msg'] ?? 'Operación realizada.';
            $_SESSION['tipo'] = $resultado['tipo'] ?? 'success';

            $title = "Sesiones por Entrenador";
            $content = __DIR__ . '/view_sesiones/list_sesiones_dep.php';
            include __DIR__ . '/layouts/main_sessiones_deportista.php';

        }else{
             if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 3;
            $entrenadores=$depoControl->getEntrenadores();
             $title = "Sesiones por Entrenador";
            $content = __DIR__ . '/view_sesiones/list_sesiones_dep.php';
            include __DIR__ . '/layouts/main_sessiones_deportista.php';
        }break; 
//=========================================================================================
            case 'rankingx_eventos':
            if($_SERVER['REQUEST_METHOD']=='POST'){
                 if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                $from= $_POST['from']?? '';
                $permitido=0;
                $deportistas= $depoControl->listSportman();
                 
                $resultado=$rankingControl->rankingEventos();
                $deportista= $resultado['deportista'] ?? " ";
                $detalles= $resultado['detalle'] ?? [];
                $eventos= $resultado['eventos'] ?? 0;
                $_SESSION['msg']= $resultado['total_eventos_mensaje'] ?? 'Operación realizada.';
                $_SESSION['tipo']= $resultado['tipo'] ?? 'success';
                if($from=="perfil_deportista"){
                     $title = "Mis puntajes";
                      $content = __DIR__ . '/view-nomina/mis_puntajes.php';
                }else{
                     $title = "Datos de Ranking por Deportista";
                $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
                }
                include __DIR__ . '/layouts/main.php';
            }else{
                $permitido=0;
                $deportistas= $depoControl->listSportman();
                $title = "Datos de Ranking por Eventos" ;
                $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
                include __DIR__ . '/layouts/main_deportista.php';
            }break;
            case 'rankingx_asistencias':
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    if(session_status()=== PHP_SESSION_NONE){
                        session_start();
                    }
                    $from= $_POST['from']?? '';
                    $permitido=0;
                    $deportistas= $depoControl->listSportman();
                    $resultado=$rankingControl->rankingAsistencia();
                    $deportista= $resultado['deportista'] ?? " ";
                    $asistencias=$resultado['total_asistencias'] ?? 0;
                    $detalles= $resultado['detalle'] ?? [];
                     $_SESSION['msg']= $resultado['total_asistencias_mensaje'] ?? 'Operación realizada.';
                    $_SESSION['tipo']= $resultado['tipo'] ?? 'error';
                    if($from=="perfil_deportista"){
                        $title = "Mis puntajes";
                        $content = __DIR__ . '/view-nomina/mis_puntajes.php';
                    }else{
                        $title = "Datos de Ranking por Deportista";
                $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
                }
                include __DIR__ . '/layouts/main.php';
                }else{
                $permitido=0;
                $deportistas= $depoControl->listSportman();
                $title = "Datos de Ranking por Asistencias" ;
                $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
                include __DIR__ . '/layouts/main_deportista.php';
            }break;
case 'ranking_total':
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $from= $_POST['from']?? '';
        $permitido=0;
        $deportistas= $depoControl->listSportman();
        $resultado=$rankingControl->ranking();
        $deportista= $resultado['deportista'] ?? " ";
        $detalles= $resultado['ranking'] ?? 0;
        $ranking= $resultado['detalle']?? "El deportista no tiene puntos de ranking.";
        $_SESSION['msg']= $resultado['msg'] ?? 'Operación realizada.';
        $_SESSION['tipo']= $resultado['tipo'] ?? 'success';
        if($from=="perfil_deportista"){
                     $title = "Mis puntajes";
                      $content = __DIR__ . '/view-nomina/mis_puntajes.php';
                }else{
                     $title = "Datos de Ranking por Deportista";
                $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
                }
                include __DIR__ . '/layouts/main.php';
    }else{
        $permitido=0;
        $deportistas= $depoControl->listSportman();
        $title = "Datos de Ranking por Deportista" ;
        $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
        include __DIR__ . '/layouts/main_deportista.php';
    }break;
    case 'mis_puntajes':
          if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=3;
         $title = "Mis puntajes de ranking" ;
        $content = __DIR__ . '/view-nomina/mis_puntajes.php';
        include __DIR__ . '/layouts/main.php';
        break;

    case 'puntajes_de_ranking':
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=0;
        $deportistas= $depoControl->listSportman();
         $title = "Datos de Ranking por Deportista" ;
        $content = __DIR__ . '/view-nomina/puntajes_de_ranking.php';
        include __DIR__ . '/layouts/main.php';
        break;
case 'lista_ranking':
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $permitido=-1;
    $resultado= $rankingControl->listaRanking();
    $ranking= $resultado['lista_ranking'] ?? [];
    $asistencia=$resultado['lista_asistencia'] ?? [];
    $eventos=$resultado['lista_eventos'] ?? [];
    
    $title = "Listado de Ranking Local";
    $content = __DIR__ . '/view-nomina/listas_de_ranking.php';
    include __DIR__ . '/layouts/main.php';
    break;
    case 'mis_entrenamientos':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=-1;
      
        $title = "Mis Entrenamientos";
        $content = __DIR__ . '/view_sesiones/listar_mis_entrenamientos.php';
        include __DIR__ . '/layouts/main.php';
        break;

    case 'mis_competencias':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=3;
        
        $title = "Mis Actuaciones";
        $content = __DIR__ . '/view-events/my_performaces.php';
        include __DIR__ . '/layouts/main.php';
        break;
    case 'menu_sesiones':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=3;
        $title = "Próximas Sesiones de Entrenamiento";
        $content = __DIR__ . '/view_sesiones/menu_sesiones_to_sportman.php';
        include __DIR__ . '/layouts/main.php';
        break;
    case 'proximas_xsite':
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $permitido=3;
        $sesiones=$eleControl->listSessionsBySite($fechaA,$horaA);
         $title = "Consulta sesiones por Escenarios de Entrenamiento";
        $content = __DIR__ . '/view_sesiones/list_sesionBysite_depor.php';
        include __DIR__ . '/layouts/main_sessiones_deportista.php';
    }else{
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=3;
        $title = "Consulta sesiones por Escenarios de Entrenamiento";
        $content = __DIR__ . '/view_sesiones/list_sesionBysite_depor.php';
        include __DIR__ . '/layouts/main_sessiones_deportista.php';
    }break;
    case 'listar_eventos':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=-1;
        $eventos= $eventControl->listEventos();
        $title = "Consultar Eventos";
        $content = __DIR__ . '/view-events/listar_todos_eventos.php';
        include __DIR__ . '/layouts/main.php';
        break;

    case 'manual':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido=-1;
        $title = "Manual de Usuario";
        $content = __DIR__ . '/views/manual.php';
        include __DIR__ . '/layouts/main.php';
        break;
    case 'insert_deportista_Rep':
    if($_SERVER["REQUEST_METHOD"]== "POST"){
          if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
        $permitido=1;
        $resultado= $depoControl->insertDeport();
        $_SESSION['msg']= $resultado['msg'];
        $_SESSION['tipo']=$resultado['tipo'];
        $title = "Registro Deportista";
        $content = __DIR__ . '/view-nomina/insert_deportista_rep.php';
        include __DIR__ . '/layouts/main.php';
        }else {
            $permitido=1;
            $title = "Registro Deportista";
            $content = __DIR__ . '/view-nomina/insert_deportista_rep.php';
            include __DIR__ . '/layouts/main.php';
        }break;
    case 'slider_items':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;   
        $items= $eleControl->sliderItems();
        $title = "Administrar Slider";
        $content = __DIR__ . '/view-elementos/admin_slider.php';
        include __DIR__ . '/layouts/main_elementos.php';
        break;
    case 'procesar_slider':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $permitido = 0;   
            $resultado = $eleControl->procesarSlider();
            $_SESSION['msg'] = $resultado['msg'];
            $_SESSION['tipo'] = $resultado['tipo'];
            header("Location: index.php?action=slider_items");
            exit();
        }break;
    case 'toggle_slider':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;   
        $resultado = $eleControl->toggleSlider();
        $_SESSION['msg'] = $resultado['msg'];
        $_SESSION['tipo'] = $resultado['tipo'];
        header("Location: index.php?action=slider_items");
        exit();
    case 'eliminar_slider':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;   
        $resultado = $eleControl->deleteSliderItem();
        $_SESSION['msg'] = $resultado['msg'];
        $_SESSION['tipo'] = $resultado['tipo'];
        header("Location: index.php?action=slider_items");
        exit();
    case 'crear_pruebas':
         if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0; 
        $pruebas= $eleControl->getTodasLasPruebas();
        $resultado= $eleControl->creacionDePruebas();
        $unidades= $eleControl->getUnidades();
        $_SESSION['msg'] = $resultado['msg'];
        $_SESSION['tipo'] = $resultado['tipo'];
        $title = "Incluir Tests Físicos";
        $content = __DIR__ . '/view-elementos/crear_pruebas.php';
        include __DIR__ . '/layouts/main_elementos.php';
    }else{
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $permitido = 0;   
        $pruebas= $eleControl->getTodasLasPruebas();
        $unidades= $eleControl->getUnidades();
        $title = "Incluir Tests Físicos";
        $content = __DIR__ . '/view-elementos/crear_pruebas.php';
        include __DIR__ . '/layouts/main_elementos.php';
    }break;
}

