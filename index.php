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
            include './views/principal.html';
            break;

        case 'registro':
            if($_SERVER["REQUEST_METHOD"]=="POST"){               
                $signupController->registrar();               
            }else{
                include './views/principal.html';
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
                include './views/principal.html';
            }break;

        case 'insert_comment':
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $insertCommentsController->insertCommment();
            }else{
                include './views/principal.html';
            }break;

            default:
                    include './views/principal.html';
            break;
    }
?>