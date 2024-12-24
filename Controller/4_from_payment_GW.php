<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Kuala_Lumpur');

    //recieve data from payment gateway
    $_SESSION['status_code'] = $_REQUEST['rsp_appln_id'];
    $_SESSION['rsp_org_id'] = $_REQUEST['rsp_org_id'];
    $_SESSION['rsp_orderid'] = $_REQUEST['rsp_orderid'];
    $_SESSION['rsp_amount'] = $_REQUEST['rsp_amount'];
    $_SESSION['rsp_trxstatus'] = $_REQUEST['rsp_trxstatus'];
    $_SESSION['rsp_stcode'] = $_REQUEST['rsp_stcode'];
    $_SESSION['rsp_bankid'] = $_REQUEST['rsp_bankid'];
    $_SESSION['rsp_bankname'] = $_REQUEST['rsp_bankname'];
    $_SESSION['rsp_fpxid'] = $_REQUEST['rsp_fpxid'];
    $_SESSION['rsp_fpxorderno'] = $_REQUEST['rsp_fpxorderno'];
    $_SESSION['date_created'] = $_REQUEST['date_created'];
    $_SESSION['type'] = $_REQUEST['type'];
    $_SESSION['doc'] = $_REQUEST['doc'];
    $_SESSION['tarikh_cek'] = $_REQUEST['tarikh_cek'];


    if ($_SESSION['status_code'] == 00) {
        //payment success
        $tarikh_tempahan = date("Y-m-d H:i:s");
        require_once '../Models/tempahanBilik.php';
        $conn = DBConnection::getConnection();
        $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
        $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');


        $tempahan = new RoomReservation(null, ($_SESSION['booking_number'] . 'succ'), $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $_SESSION['roomsNum'], $tarikh_tempahan, $tarikhMasukSQL, $tarikhKeluarSQL, $_SESSION['total_price'], $_POST['payment_method'], $_SESSION['room_id']);

        $tempahan->insertReservation();

        header("Location: ../success.php");
        //send email to customer
        //include '../testEMAIL.php';

        exit();
    } else {
        $tarikh_tempahan = date("Y-m-d H:i:s");
        require_once '../Models/tempahanBilik.php';
        $conn = DBConnection::getConnection();
        $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
        $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');


        $tempahan = new RoomReservation(null, ($_SESSION['booking_number'] . 'fail'), $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $_SESSION['roomsNum'], $tarikh_tempahan, $tarikhMasukSQL, $tarikhKeluarSQL, $_SESSION['total_price'], $_POST['payment_method'], $_SESSION['room_id']);

        $tempahan->insertReservation();

        header("Location: ../success.php");
        //send email to customer
        //include '../testEMAIL.php';

        exit();
    }
}
