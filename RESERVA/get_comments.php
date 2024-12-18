<?php
    // get_comments.php

require_once '../controller/getCommentsController.php';
    $getCommentsController = new GetCommentsController();
    $getCommentsController->getComments();

?>