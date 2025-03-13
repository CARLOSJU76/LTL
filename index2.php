<?php
   include_once 'controller/loginController.php';
   $objeto= new LoginController();
   $user_email= $objeto->get_email_user();

   echo $user_email;
?>