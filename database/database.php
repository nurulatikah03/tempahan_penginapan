<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "insket_service";

$conn = "";

try {
    $conn = mysqli_connect($hostname, $username, $password, $database );
    }

catch (mysqli_sql_exception)
    {echo "couldn't connect to database";}