<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_penginapan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

?>