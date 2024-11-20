<?php 
session_start();
// if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
//     header("Location: ../index.php");
//     exit();
// }
function validate($data) {
    // Add your validation logic here
    return trim(htmlspecialchars($data));
}
$fullName = validate($_POST['full_name']);
$email = validate($_POST['form-email']);
$phoneNumber = validate($_POST['phone_number']);


if (strlen($fullName) < 5) {
    $_SESSION['err'] = "Nama perlu lebih dari 5 perkataan.";
    echo "<script>window.history.back();</script>";
    exit();
}

if (!preg_match('/^[0-9]{10,15}$/', $phoneNumber)) {
    $_SESSION['err'] = "Sila beri nombor telefon yang sah dan tanpa dash (-).";
    echo "<script>window.history.back();</script>";
    exit();
}
$_SESSION['cust_name'] = htmlspecialchars($fullName);
$_SESSION['form-email'] = htmlspecialchars($email);
$_SESSION['phone_number'] = htmlspecialchars($phoneNumber);
$_SESSION['num_of_night'] = htmlspecialchars($_POST['num_of_night']);
$_SESSION['total_price'] = htmlspecialchars($_POST['price']);
header("Location: ../payment_page.php");
