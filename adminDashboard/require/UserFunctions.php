<?php 
require_once __DIR__ . '/../../database/DBConnec.php';

function checkUser($username, $password){
    $conn = DBConnection::getConnection();
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if($user){
        if(password_verify($password, $user['password_hash'])){
            return $user;
        }
    }
    return false;
}

