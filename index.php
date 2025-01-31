<?php

    require_once('controller/controlVistas.php');
    require_once 'controller/signupController.php';
    require_once 'controller/loginController.php';
    require_once 'controller/insertCommentsController.php';
   

    
    $controlVistas= new controlVistas();
    $signupController= new SignupController(); 
    $loginController= new LoginController();   
    $insertCommentsController= new InsertCommentsController();
 
    
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

        case 'insert_comment':
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $insertCommentsController->insertCommment();
            }else{
                include './views/principal.php';
            }break;

            default:
                    include './views/principal.php';
            break;
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
                
    }
?>