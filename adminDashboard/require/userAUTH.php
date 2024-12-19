<?php 
require_once 'UserFunctions.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}