<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'penginapan') {
        include_once '../Models\tempahanBilik.php';
        include_once '../Models\room.php';
        $lisTempahan = RoomReservation::getAllReservation();

?>
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
                        $bookingNumber = $tempahan->getBookingNumber();
                        $reservationDateTime = new DateTime($tempahan->getReservationDate());
                        $reservationDate = $reservationDateTime->format('d/m/Y');
                        $reservationTime = $reservationDateTime->format('h:i A');
                        $custName = ucwords(strtolower(implode(' ', array_slice(explode(' ', $tempahan->getCustName()), 0, 2))));
                        $roomName = Room::getRoomNameById($tempahan->getRoomId());
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
                            <td><?php echo $tempahan->getEmail(); ?></td>
                            <td><?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?></td>
                            <td><?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?></td>
                            <td class="table-action">
                                <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $bookingNumber; ?>"> <i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
                                <a href="https://wa.me/6<?php echo $tempahan->getPhoneNumber() ?>" class="action-icon" title="Chat with <?php echo $custName ?>" target="_blank"><img src="assets\icon-svg\whatsapp.svg" alt="whatsapp" class="theme-color" style="width: 20px; height: 20px;"></a>
                            </td>
                        </tr>
                        <!-- view ALERT -->
                        <div class="modal fade modal-backdrop-view" id="viewModal<?php echo $bookingNumber; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?php echo $bookingNumber; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
                                        <div class="text-center p-4">
                                            <h3>Maklumat tempahan #<?php echo $bookingNumber; ?></h3>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 ps-5 pe-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama penyewa</label>
                                                    <input type="text" class="form-control" value="<?php echo $tempahan->getCustName(); ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nombor Tempahan</label>
                                                    <input type="text" class="form-control" value="<?php echo $bookingNumber; ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nombor Telefon</label>
                                                    <input type="text" class="form-control" value="<?php echo $tempahan->getPhoneNumber(); ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="<?php echo $tempahan->getEmail(); ?>" readonly style="background-color: white;">
                                                </div>
                                            </div>
                                            <div class="col-md-6 ps-2 pe-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Tarikh dan masa tempahan</label>
                                                    <input type="text" class="form-control" value="<?php echo $reservationDate . ' @ ' . $reservationTime; ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Check In</label>
                                                    <input type="text" class="form-control" value="<?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Check Out</label>
                                                    <input type="text" class="form-control" value="<?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?>" readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name Bilik</label>
                                                    <input type="text" class="form-control" value="<?php echo $roomName; ?>" readonly style="background-color: white;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ps-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Cara pembayaran</label>
                                                    <p>FPX</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                        <td colspan="8" class="text-center"><strong>Tiada tempahan penginapan</strong></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
    } elseif ($action === 'kahwin') {
        include_once '../Models\tempahanPerkahwinan.php';
        include_once '../Models\pekejPerkahwinan.php';
        $lisTempahanKawin = WeddingReservation::getAllReservations();?>

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
                    <th>Email</th>
                    <th>Tarikh kenduri</th>
                    <th>Check out</th>
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
                            <td><?php echo $tempahan->getEmail(); ?></td>
                            <td><?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?></td>
                            <td><?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?></td>
                            <td class="table-action">
                                <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo $bookingNumber; ?>"> <i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
                                <a href="https://wa.me/6<?php echo $tempahan->getPhoneNumber() ?>" class="action-icon" title="Chat with <?php echo $custName ?>" target="_blank"><img src="assets\icon-svg\whatsapp.svg" alt="whatsapp" class="theme-color" style="width: 20px; height: 20px;"></a>
                            </td>
                        </tr>
                <?php }
                } ?>
                <?php if (empty($lisTempahanKawin)) { ?>
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
<?php
    } elseif ($action === 'aktiviti') {
        echo 'aktiviti';
    } elseif ($action === 'dewan') {
        echo 'dewan';
    } else {
        echo "<p class='text-warning'>Invalid action.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>Invalid request.</p>";
}
?>