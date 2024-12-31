<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit();
}
function validate($data) {
    // Add your validation logic here
    return trim(htmlspecialchars($data));
}


$fullName = validate($_POST['full_name']);
$email = validate($_POST['form-email']);
$phoneNumber = validate($_POST['phone_number']);


if (strlen($fullName) < 3) {
    $_SESSION['err'] = "Nama perlu lebih dari 3 perkataan.";
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

if ($_POST['process'] == 'penginapan') {
    $_SESSION['num_of_night'] = htmlspecialchars($_POST['num_of_night']);
    $_SESSION['total_price'] = htmlspecialchars($_POST['price']);
    header("Location: ../payment_page.php");
    exit();
}
else if ($_POST['process'] == 'kahwin') {
    header("Location: ../payment_page_kahwin.php");
    exit();
}else if ($_POST['process'] == 'dewan') {
    // Retrieve 'id_dewan' from the GET parameter
    $id_dewan = isset($_SESSION['id_dewan']) ? intval($_SESSION['id_dewan']) : 0;
    if ($id_dewan <= 0) {
        $_SESSION['err'] = "ID dewan tidak sah.";
        echo "<script>window.history.back();</script>";
        exit();
    }
    header("Location: ../payment_Dewan.php");
    exit();
}
else if ($_POST['process'] == 'aktiviti') {
    // Retrieve 'id_aktiviti' from the GET parameter
    $id_aktiviti = isset($_GET['id_aktiviti']) ? intval($_GET['id_aktiviti']) : 0;
    if ($id_aktiviti <= 0) {
        $_SESSION['err'] = "ID aktiviti tidak sah.";
        echo "<script>window.history.back();</script>";
        exit();
    }
    header("Location: ../payment_aktiviti.php?id_aktiviti=" . $id_aktiviti);
    exit();
}
