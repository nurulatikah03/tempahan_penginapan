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
                                <div class="card-header">
                                    <div class="d-flex justify-content-start gap-2">
                                        <button type="button" class="btn btn-primary" data-action="penginapan">Penginapan</button>
                                        <button type="button" class="btn btn-primary" data-action="kahwin">Kahwin</button>
                                        <button type="button" class="btn btn-primary" data-action="aktiviti">Aktiviti</button>
                                        <button type="button" class="btn btn-primary" data-action="dewan">Dewan</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" id="data-display">
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
    <script>
        $(document).ready(function() {
            fetchData("penginapan");

            $(document).on("click", "button[data-action]", function() {
                const action = $(this).data("action");
                fetchData(action);
            });

            function fetchData(action) {
                $.ajax({
                    url: "fetch_tempahan_data.php",
                    type: "POST",
                    data: {
                        action: action
                    },
                    success: function(response) {
                        $("#data-display").html(response);
                    },
                    error: function() {
                        $("#data-display").html("<p class='text-danger'>Error fetching data.</p>");
                    },
                });
            }
        });
    </script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="assets/js/pages/demo.products.js"></script>
    <!-- end demo js-->

</body>

</html>