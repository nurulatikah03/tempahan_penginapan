<?php 
require_once 'UserAUTH.php';
    session_destroy();
    header('Location: ../login.php');
    exit;
