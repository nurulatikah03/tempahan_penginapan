<?php 
if ($_SESSION['role'] !== 'admin') {
    header('Location: accessDenied.php');
}