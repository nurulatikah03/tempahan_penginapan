<?php 
require_once __DIR__ . '/require/UserAUTH.php';
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
        .form-control-display {
            background-color: #edf7f0;
        }
    </style>
</head>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php
                include 'partials/topbar.php';
                include_once '../Models/tempahanPerkahwinan.php';
                include_once '../Models/pekejPerkahwinan.php';
                $lisTempahanKawin = WeddingReservation::getAllReservations(); ?>

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
                                <h4 class="page-title">Tempahan Perkahwinan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"></div>
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
                                                    <th class="all">Nombor Tempahan</th>
                                                    <th>Nama</th>
                                                    <th>Nombor fon</th>
                                                    <th>Bilangan Pax</th>
                                                    <th>Tarikh Kenduri</th>
                                                    <th>Tarikh Tempah</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($lisTempahanKawin)) {
                                                    foreach ($lisTempahanKawin as $tempahan) {
                                                        $tempahan_id = $tempahan->getId();
                                                        $bookingNumber = $tempahan->getBookingNumber();
                                                        $reservationDateTime = new DateTime($tempahan->getReservationDate());
                                                        $reservationDate = $reservationDateTime->format('d/m/Y');
                                                        $reservationTime = $reservationDateTime->format('h:i A');
                                                        $custName = ucwords(strtolower(implode(' ', array_slice(explode(' ', $tempahan->getCustName()), 0, 2))));
                                                        $PekejName = PekejPerkahwinan::getPackageNameById($tempahan->getWeddingId());
                                                        $addons = $tempahan->getAddOnsByReservationId($tempahan_id);
                                                        $namaDewan = PekejPerkahwinan::getDewanNameByDewanId($tempahan->getDewanId());;
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
                                                                    <span class="text-body"><?php echo $bookingNumber; ?></span>
                                                                </p>
                                                            </td>
                                                            <td><?php echo $custName; ?></td>
                                                            <td><?php echo $tempahan->getPhoneNumber(); ?></td>
                                                            <td><?php echo $tempahan->getNumOfPax(); ?></td>
                                                            <td><?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?></td>
                                                            <td><?php echo $reservationDate . ' @ ' . $reservationTime; ?></td>
                                                            <td class="table-action">
                                                                <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal"
                                                                    data-bs-target="#viewModal<?php echo $bookingNumber; ?>"> <i class="mdi mdi-eye"
                                                                        style="color: #3299d1;"></i></a>
                                                                <a href="https://wa.me/6<?php echo $tempahan->getPhoneNumber() ?>" class="action-icon"
                                                                    title="Chat with <?php echo $custName ?>" target="_blank"><img src="assets\icon-svg\whatsapp.svg"
                                                                        alt="whatsapp" class="theme-color" style="width: 20px; height: 20px;"></a>
                                                                <a href="mailto:<?php echo $tempahan->getEmail() ?>" class="action-icon" target="_blank"><img
                                                                        src="assets\icon-svg\gmail.svg" class="theme-color" style="width: 20px; height: 20px;"></a>

                                                            </td>
                                                        </tr>
                                                        <!-- view ALERT -->
                                                        <div class="modal fade modal-backdrop-view" id="viewModal<?php echo $bookingNumber; ?>" tabindex="-1"
                                                            aria-labelledby="viewModalLabel<?php echo $bookingNumber; ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                                                    <div class="modal-body">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                                            style="position: absolute; right: 25px; top: 25px;"></button>
                                                                        <div class="text-center p-4">
                                                                            <h3>Maklumat tempahan #<?php echo $bookingNumber; ?></h3>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-6 ps-5 pe-2">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nama penyewa</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo $tempahan->getCustName(); ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nombor Tempahan</label>
                                                                                    <input type="text" class="form-control" value="<?php echo $bookingNumber; ?>"
                                                                                        readonly style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nombor Telefon</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo $tempahan->getPhoneNumber(); ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nama Pekej</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo $PekejName; ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 ps-2 pe-5">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Tarikh dan masa tempahan</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo $reservationDate . ' @ ' . $reservationTime; ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Tarikh Kenduri</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Tarikh Akhir Kenduri</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Nama Dewan</label>
                                                                                    <input type="text" class="form-control"
                                                                                        value="<?php echo $namaDewan; ?>" readonly
                                                                                        style="background-color: white;">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <!-- Left side with email and payment method -->
                                                                                <div class="col-md-6 pe-2 ps-5">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Bilangan PAX</label>
                                                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($tempahan->getNumOfPax()); ?>" readonly style="background-color: white;">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Email</label>
                                                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($tempahan->getEmail()); ?>" readonly style="background-color: white;">
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Cara pembayaran</label>
                                                                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($tempahan->getPaymentMethod()); ?>" readonly style="background-color: white;">
                                                                                    </div>
                                                                                </div>

                                                                                <!-- Right side with add-ons -->
                                                                                <div class="col-md-6 ps-2">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Add-ons</label>
                                                                                        <?php if (!empty($addons)) { ?>
                                                                                            <ul class="list-group list-group-flush ps-4">
                                                                                                <?php foreach ($addons as $addon) { ?>
                                                                                                    <li class="form-label">
                                                                                                        <strong><?php echo htmlspecialchars($addon['name']); ?></strong>
                                                                                                        - RM<?php echo number_format($addon['price'], 2); ?>
                                                                                                        x <?php echo htmlspecialchars($addon['quantity']); ?>
                                                                                                    </li>
                                                                                                <?php } ?>
                                                                                            </ul>
                                                                                        <?php } else { ?>
                                                                                            <p>Tiada add on dipilih.</p>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="text-center">
                                                                            <h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
                                                                        </div>
                                                                        <div class="text-center">
                                                                            <button type="button" class="btn btn-secondary rounded-button"
                                                                                data-bs-dismiss="modal">Tutup</button>
                                                                            <a href="../assets/PDF/PDF_kahwin.php?viewInvoice=<?php echo $bookingNumber; ?>"
                                                                                target="_blank" class="btn btn-primary rounded-button">Lihat Resit</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php }
                                                }  if (empty($lisTempahanKawin)) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="customCheck<?php echo $tempahan_id; ?>">
                                                                <label class="form-check-label" for="customCheck<?php echo $tempahan_id; ?>">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="8" class="text-center"><strong>Tiada tempahan perkahwinan</strong></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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