<?php

    require_once('controller/controlVistas.php');
    require_once 'controller/signupController.php';
    $controlVistas= new controlVistas();
    $signupController= new SignupController();    


    //require_once('controllers/UserController.php');


    //$userController= new UserController();

    $action= $_GET['action'] ?? 'principal';

    switch ($action){

        case 'principal':
            $controlVistas->principal();             
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



        // case 'insertUser':
        //     if($_SERVER["REQUEST_METHOD"]== "POST"){
        //         $userController->insertUser();
                
        //     }else {
        //         include './views/insert_user.php';
        //     }
        //         break;
        // case'insertProduct':
        //     if($_SERVER["REQUEST_METHOD"]=="POST"){
        //         $userController->insertProduct();
        //     }else{
        //         include './views/insert_product.php';
        //     }
        //         break;

        // case'listUsers':
        //     $users= $userController->listUsers();
        //     include './views/list_users.php';
        //     break;

        // case 'searchUserByName':
        //     $users= $userController->UsersByName();
        //     include './views/list_user_By_Name_Form.php';
        //     break;   
            
        // case 'searchProducts':
        //     $products= $userController->getProducts();
        //     include './views/list_Products.php';
        //     break;

        // case 'listCompra':
        //     $compras=$userController->listCompra();
        //     include './views/list_Compra.php';
        //     break;

        // case 'listCompraByND':
        //     $compras=$userController->getCompraByND();
        //     include './views/listCompraByND.php';
        //     break;

        // case 'searchProductByName':
        //     $products= $userController->productsByName();
        //     include './views/list_Product_By_Name.php';
        //     break;

        // case 'insertTipoD':
        //     if($_SERVER["REQUEST_METHOD"]== "POST"){
        //         $userController->insertTipoD();
        //     }else {
        //         include './views/insert_TipoD.php';
        //     }
        //         break;

        // case 'insertTipoP':
        //     if($_SERVER["REQUEST_METHOD"]== "POST"){
        //         $userController->insertTipoP();
        //     }else {
        //                 include './views/insert_TipoP.php';
        //     }
        //     break;
            
        // case 'insertCompra':
        //     if($_SERVER['REQUEST_METHOD']=="POST"){
        //         $userController->insertCompra();
        //     }else{
        //         include './views/insertCompra.php';
        //     }
        //     break;
        // case 'openForm':
           
        //     $users=$userController->getUserByNumD();            
          
        //     include './views/list_user_By_Num_Docum.php';
        //     break;
        
        //     case 'updateUser':      
        //         if($_SERVER["REQUEST_METHOD"]== "POST"){
        //             $userController->updateUser();
        //             $usuarios=$userController->getUserByNumD();
        //         }else{
        //             $userData=$userController->getUserByNumD();
        //             include './views/updateUserForm.php';
        //         }
        //         break; 
            
        //     case 'deleteUserByND':
        //         $users= $userController->getUserByNumD();
        //     include './views/deleteUserByND.php';
        //     break;  

        //     case 'deleteUser':
        //             $userController->deleteUser();
        //             break;


                // if($_SERVER["REQUEST_METHOD"]=="GET"){
                //     $userController->deleteUser();
                // }else{

            default:
                    include './views/principal.html';
            break;
    }

?>