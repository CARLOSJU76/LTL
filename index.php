<?php

    require_once('controller/controlVistas.php');
    require_once 'controller/signupController.php';
    require_once 'controller/loginController.php';
    require_once 'controller/insertCommentsController.php';
    require_once 'controller/ClubController.php';
    require_once 'controller/DeportistaController.php';
    require_once 'controller/GetCommentsController.php';
   

    
    $controlVistas= new controlVistas();
    $signupController= new SignupController(); 
    $loginController= new LoginController();   
    $insertCommentsController= new InsertCommentsController();
    $clubControl= new ClubController();
    $depoControl= new DeportistaController();

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
                }else{
                   $repreData=$clubControl->buscarRepresentantes();
                   include_once 'view-profile/update_repres.php';
                }break;
            case 'delete_repre':
                $clubControl->deleteRepre();
                include 'view-profile/list_repres.php'; 
                break;
//=============================================================================================================================
            case 'insert_sport':
                if($_SERVER["REQUEST_METHOD"]== "POST"){
                    $depoControl->insertDeport();
                    include 'view-nomina/insert_deportista.php';
                    }else {
                    include_once 'view-nomina/insert_deportista.php';;
                    }
                    break;
    }
?>
