<?php
    include_once 'controller/loginController.php';

    $objeto= new $loginController();

    $user_email= $objeto->get_email_user();
    
?>