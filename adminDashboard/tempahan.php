<?php
include_once '../Models\tempahan.php';
$lisTempahan = RoomReservation::getAllReservation();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>INSKET Booking</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
    </style>
</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Tempahan</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tempahan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="all" style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                                        </div>
                                                    </th>
                                                    <th class="all">Tarikh tempahan</th>
                                                    <th>Nama</th>
                                                    <th>Nombor fon</th>
                                                    <th>Email</th>
                                                    <th>Check in</th>
                                                    <th>Check out</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($lisTempahan)) {
                                                    foreach ($lisTempahan as $tempahan) {
                                                        $tempahan_id = $tempahan->getId();
                                                        $reservationDateTime = new DateTime($tempahan->getReservationDate());
                                                        $reservationDate = $reservationDateTime->format('d/m/Y');
                                                        $reservationTime = $reservationDateTime->format('h:i A');
                                                        $custName = ucwords(strtolower(implode(' ', array_slice(explode(' ', $tempahan->getCustName()), 0, 2))));
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input" id="customCheck<?php echo $tempahan_id; ?>">
                                                                    <label class="form-check-label" for="customCheck<?php echo $tempahan_id; ?>">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="m-0 d-inline-block align-middle font-16">
                                                                    <span class="text-body"><?php echo $reservationDate . ' @' . $reservationTime; ?></span>
                                                                </p>
                                                            </td>
                                                            <td><?php echo $custName; ?></td>
                                                            <td><?php echo $tempahan->getPhoneNumber(); ?></td>
                                                            <td><?php echo $tempahan->getEmail(); ?></td>
                                                            <td><?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?></td>
                                                            <td><?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?></td>
                                                            <td class="table-action">
                                                                <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
                                                                <a href="https://wa.me/6<?php echo $tempahan->getPhoneNumber() ?>" class="action-icon" title="Chat with <?php echo $custName ?>" target="_blank"><img src="assets\icon-svg\whatsapp.svg" alt="whatsapp" class="theme-color" style="width: 20px; height: 20px;"></a>

                                                                <!--start delete modal-->
                                                                <a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $tempahan_id; ?>"><i class="mdi mdi-delete" style="color: red;"></i></a>

                                                                <!-- DELETE ALERT -->
                                                                <div class="modal fade modal-backdrop-del" id="deleteModal<?php echo $tempahan_id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $tempahan_id; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog ">
                                                                        <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
                                                                                <div class="text-center p-4">
                                                                                    <img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Padam <?php echo $tempahan->getBookingNumber(); ?></h1>

                                                                                    <p class="pt-3"> Tindakan tidak boleh undur semula. </p>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <form method="post" action="controller/delete_tempahan.php">
                                                                                        <input type="hidden" name="nombor_tempahan" value="<?php echo $tempahan->getBookingNumber(); ?>">
                                                                                        <button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tidak, Kembali semula.</button>
                                                                                        <button type="submit" name="Submit" class="btn btn-danger rounded-button">Ya, Padam</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                            </td>
                                                        </tr>

                                                <?php }
                                                } ?>
                                                <?php if (empty($lisTempahan)) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck<?php echo $tempahan_id; ?>">
                                                                <label class="form-check-label" for="customCheck<?php echo $tempahan_id; ?>">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="8" class="text-center"><strong>Tiada tempahan</strong></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
                                            echo '<div class="alert alert-success" role="alert">Tempahan berjaya dipadamkan.</div>';
                                            unset($_SESSION['status']);
                                        }
                                        ?>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>

        <?php include 'partials/right-sidemenu.php'; ?>
    </div>
    <!-- END wrapper -->




    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    <!-- third party js -->
    <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>

    <!-- third party js ends -->

    <!-- demo app -->
    <script src="assets/js/pages/demo.products.js"></script>
    <!-- end demo js-->

</body>

</html>