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
                                <a href="mailto:<?php echo $tempahan->getEmail() ?>" class="action-icon" target="_blank"><img src="assets\icon-svg\gmail.svg"  class="theme-color" style="width: 20px; height: 20px;"></a>
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
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="<?php echo $tempahan->getEmail(); ?>"
                                                        readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Cara pembayaran</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $tempahan->getPaymentMethod(); ?>" readonly
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
                                                    <label class="form-label">Check In</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo formatDateFromSQL($tempahan->getCheckInDate()); ?>" readonly
                                                        style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Check Out</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo formatDateFromSQL($tempahan->getCheckOutDate()); ?>" readonly
                                                        style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name Bilik</label>
                                                    <input type="text" class="form-control" value="<?php echo $roomName; ?>" readonly
                                                        style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bilangan Bilik</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $tempahan->getNumOfPax(); ?>" readonly
                                                        style="background-color: white;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tutup</button>
                                            <a href="../assets/PDF/PDF_room.php?viewInvoice=<?php echo $bookingNumber; ?>" target="_blank" class="btn btn-primary rounded-button">Lihat Resit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php 
                    }exit;
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
                    <?php exit;
                } ?>
            </tbody>
        </table>
        <?php
    } elseif ($action === 'kahwin') {
        include_once '../Models\tempahanPerkahwinan.php';
        include_once '../Models\pekejPerkahwinan.php';
        $lisTempahanKawin = WeddingReservation::getAllReservations(); ?>

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
                    <th>Bilangan PAX</th>
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
                            <td><?php echo $tempahan->getNumOfPax(); ?></td>
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
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" value="<?php echo $tempahan->getEmail(); ?>"
                                                        readonly style="background-color: white;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Cara pembayaran</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $tempahan->getPaymentMethod(); ?>" readonly
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
                                                    <label class="form-label">Bilangan PAX</label>
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $tempahan->getNumOfPax(); ?>" readonly
                                                        style="background-color: white;">
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
                    exit;
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
                <?php }
                exit; ?>
            </tbody>
        </table>
		
        <?php
    } elseif ($action === 'aktiviti') {
        include 'db-connect.php';
		
		$query = "
			SELECT 
				t.id_tempahan,
				t.nombor_tempahan,
				t.nama_penuh,
				t.numbor_fon, 
				t.email,
				t.tarikh_tempahan,
				t.tarikh_daftar_masuk,
				t.tarikh_daftar_keluar,
				t.harga_keseluruhan,
				t.cara_bayar,
				t.reference_id,
				a.id_aktiviti,
				a.nama_aktiviti
			FROM 
				tempahan t
			LEFT JOIN 
				aktiviti a
			ON 
				t.id_aktiviti = a.id_aktiviti
			WHERE 
				t.id_aktiviti IS NOT NULL
		";

        $result = $conn->query($query);

        if (!$result) {
            die("Query gagal: " . $conn->error);
        }
        ?>
		<div class="table-responsive">
			<table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
				<thead class="table-light">
					<tr>
						<th style="width: 20px;">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="customCheck<?php echo htmlspecialchars($id_aktiviti); ?>">
								<label class="form-check-label" for="customCheck<?php echo htmlspecialchars($id_aktiviti); ?>">&nbsp;</label>
							</div>
						</th>
						<th class="all">Nombor Tempahan</th>
						<th>Nama</th>
						<th>Nombor fon</th>
						<th>Email</th>
						<th>Tarikh Masuk</th>
						<th>Tarikh Keluar</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$id_tempahan = $row['id_tempahan'];
							$nombor_tempahan = $row['nombor_tempahan'];
							$nama_penuh = $row['nama_penuh'];
							$numbor_fon = $row['numbor_fon'];
							$email = $row['email'];
							$tarikh_daftar_masuk = $row['tarikh_daftar_masuk'];
							$tarikh_daftar_keluar = $row['tarikh_daftar_keluar'];
							$cara_bayar = $row['cara_bayar'];
							$tarikh_tempahan = $row['tarikh_tempahan'];
							$nama_aktiviti = $row['nama_aktiviti'];
							$harga_keseluruhan = $row['harga_keseluruhan'];
							?>
							<tr>
								<td class="all" style="width: 20px;">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="customCheck<?php echo $id_tempahan; ?>">
										<label class="form-check-label" for="customCheck<?php echo $id_tempahan; ?>">&nbsp;</label>
									</div>
								</td>
								<td><?php echo $nombor_tempahan; ?></td>
								<td><?php echo $nama_penuh; ?></td>
								<td><?php echo $numbor_fon; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $tarikh_daftar_masuk; ?></td>
								<td><?php echo $tarikh_daftar_keluar; ?></td>
								<td class="table-action">
									<a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal"
										data-bs-target="#viewModal<?php echo $nombor_tempahan; ?>">
										<i class="mdi mdi-eye" style="color: #3299d1;"></i>
									</a>
									<a href="https://wa.me/6<?php echo $numbor_fon ?>" class="action-icon" target="_blank">
										<img src="assets/icon-svg/whatsapp.svg" alt="whatsapp" style="width: 20px; height: 20px;">
									</a>
									<a href="mailto:<?php echo $email ?>" class="action-icon" target="_blank">
										<img src="assets/icon-svg/gmail.svg" style="width: 20px; height: 20px;">
									</a>
								</td>
							</tr>
							<div class="modal fade modal-backdrop-view" id="viewModal<?php echo $nombor_tempahan; ?>" tabindex="-1"
								aria-labelledby="viewModalLabel<?php echo $nombor_tempahan; ?>" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
										<div class="modal-body">
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
												style="position: absolute; right: 25px; top: 25px;"></button>
											<div class="text-center p-4">
												<h3>Maklumat tempahan #<?php echo $nombor_tempahan; ?></h3>
											</div>

											<div class="row">
												<div class="col-md-6 ps-5 pe-2">
													<div class="mb-3">
														<label class="form-label">Nama penyewa</label>
														<input type="text" class="form-control"
															value="<?php echo $nama_penuh; ?>" readonly
															style="background-color: white;">
													</div>
													<?php
													// Gunakan DateTime dan date_diff untuk mengira bilangan hari
													$datetime1 = new DateTime($tarikh_daftar_masuk);
													$datetime2 = new DateTime($tarikh_daftar_keluar);
													$interval = $datetime1->diff($datetime2);

													// Dapatkan bilangan hari
													$bilangan_hari = $interval->days;
													?>
													<div class="mb-3">
														<label class="form-label">Bilangan Hari</label>
														<input type="text" class="form-control" value="<?php echo $bilangan_hari; ?>"
															readonly style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Nombor Telefon</label>
														<input type="text" class="form-control"
															value="<?php echo $numbor_fon; ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Email</label>
														<input type="text" class="form-control" value="<?php echo $email; ?>"
															readonly style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Cara pembayaran</label>
														<input type="text" class="form-control"
															value="<?php echo $cara_bayar; ?>" readonly
															style="background-color: white;">
													</div>
												</div>
												<div class="col-md-6 ps-2 pe-5">
													<div class="mb-3">
														<label class="form-label">Tarikh dan masa tempahan</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y H:i', strtotime($tarikh_tempahan)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Tarikh Masuk</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_masuk)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Tarikh Keluar</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_keluar)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Nama Aktiviti</label>
														<input type="text" class="form-control" value="<?php echo $nama_aktiviti; ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Jumlah Bayaran</label>
														<input type="text" class="form-control" value="<?php echo $harga_keseluruhan; ?>" readonly
															style="background-color: white;">
													</div>
												</div>
											</div>
											<div class="text-center">
												<h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
											</div>
											<div class="text-center">
												<button type="button" class="btn btn-secondary rounded-button"
													data-bs-dismiss="modal">Tutup</button>
												<button type="button" class="btn btn-primary rounded-button">Lihat Resit</button>

											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					} else {
						echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>

        <?php
    } elseif ($action === 'dewan') {
        include 'db-connect.php';

        $query = "
			SELECT 
				t.id_tempahan,
				t.nombor_tempahan,
				t.nama_penuh,
				t.numbor_fon, 
				t.email,
				t.tarikh_tempahan,
				t.tarikh_daftar_masuk,
				t.tarikh_daftar_keluar,
				t.harga_keseluruhan,
				t.cara_bayar,
				t.reference_id,
				d.id_dewan,
				d.nama_dewan
			FROM 
				tempahan t
			LEFT JOIN 
				dewan d
			ON 
				t.id_dewan = d.id_dewan
			WHERE 
				t.id_dewan IS NOT NULL
		";

        $result = $conn->query($query);

        if (!$result) {
            die("Query gagal: " . $conn->error);
        }
        ?>
		<div class="table-responsive">
			<table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
				<thead class="table-light">
					<tr>
						<th style="width: 20px;">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="customCheck<?php echo htmlspecialchars($id_dewan); ?>">
								<label class="form-check-label" for="customCheck<?php echo htmlspecialchars($id_dewan); ?>">&nbsp;</label>
							</div>
						</th>
						<th class="all">Nombor Tempahan</th>
						<th>Nama</th>
						<th>Nombor fon</th>
						<th>Email</th>
						<th>Tarikh Masuk</th>
						<th>Tarikh Keluar</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							$id_tempahan = $row['id_tempahan'];
							$nombor_tempahan = $row['nombor_tempahan'];
							$nama_penuh = $row['nama_penuh'];
							$numbor_fon = $row['numbor_fon'];
							$email = $row['email'];
							$tarikh_daftar_masuk = $row['tarikh_daftar_masuk'];
							$tarikh_daftar_keluar = $row['tarikh_daftar_keluar'];
							$cara_bayar = $row['cara_bayar'];
							$tarikh_tempahan = $row['tarikh_tempahan'];
							$nama_dewan = $row['nama_dewan'];
							$harga_keseluruhan = $row['harga_keseluruhan'];
							?>
							<tr>
								<td class="all" style="width: 20px;">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="customCheck<?php echo $id_tempahan; ?>">
										<label class="form-check-label" for="customCheck<?php echo $id_tempahan; ?>">&nbsp;</label>
									</div>
								</td>
								<td><?php echo $nombor_tempahan; ?></td>
								<td><?php echo $nama_penuh; ?></td>
								<td><?php echo $numbor_fon; ?></td>
								<td><?php echo $email; ?></td>
								<td><?php echo $tarikh_daftar_masuk; ?></td>
								<td><?php echo $tarikh_daftar_keluar; ?></td>
								<td class="table-action">
									<a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal"
										data-bs-target="#viewModal<?php echo $nombor_tempahan; ?>">
										<i class="mdi mdi-eye" style="color: #3299d1;"></i>
									</a>
									<a href="https://wa.me/6<?php echo $numbor_fon ?>" class="action-icon" target="_blank">
										<img src="assets/icon-svg/whatsapp.svg" alt="whatsapp" style="width: 20px; height: 20px;">
									</a>
									<a href="mailto:<?php echo $email ?>" class="action-icon" target="_blank">
										<img src="assets/icon-svg/gmail.svg" style="width: 20px; height: 20px;">
									</a>
								</td>
							</tr>
							<div class="modal fade modal-backdrop-view" id="viewModal<?php echo $nombor_tempahan; ?>" tabindex="-1"
								aria-labelledby="viewModalLabel<?php echo $nombor_tempahan; ?>" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
										<div class="modal-body">
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
												style="position: absolute; right: 25px; top: 25px;"></button>
											<div class="text-center p-4">
												<h3>Maklumat tempahan #<?php echo $nombor_tempahan; ?></h3>
											</div>

											<div class="row">
												<div class="col-md-6 ps-5 pe-2">
													<div class="mb-3">
														<label class="form-label">Nama penyewa</label>
														<input type="text" class="form-control"
															value="<?php echo $nama_penuh; ?>" readonly
															style="background-color: white;">
													</div>
													<?php
													// Gunakan DateTime dan date_diff untuk mengira bilangan hari
													$datetime1 = new DateTime($tarikh_daftar_masuk);
													$datetime2 = new DateTime($tarikh_daftar_keluar);
													$interval = $datetime1->diff($datetime2);

													// Dapatkan bilangan hari
													$bilangan_hari = $interval->days;
													?>
													<div class="mb-3">
														<label class="form-label">Bilangan Hari</label>
														<input type="text" class="form-control" value="<?php echo $bilangan_hari; ?>"
															readonly style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Nombor Telefon</label>
														<input type="text" class="form-control"
															value="<?php echo $numbor_fon; ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Email</label>
														<input type="text" class="form-control" value="<?php echo $email; ?>"
															readonly style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Cara pembayaran</label>
														<input type="text" class="form-control"
															value="<?php echo $cara_bayar; ?>" readonly
															style="background-color: white;">
													</div>
												</div>
												<div class="col-md-6 ps-2 pe-5">
													<div class="mb-3">
														<label class="form-label">Tarikh dan masa tempahan</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y H:i', strtotime($tarikh_tempahan)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Tarikh Masuk</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_masuk)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Tarikh Keluar</label>
														<input type="text" class="form-control"
															value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_keluar)); ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Nama Dewan</label>
														<input type="text" class="form-control" value="<?php echo $nama_dewan; ?>" readonly
															style="background-color: white;">
													</div>
													<div class="mb-3">
														<label class="form-label">Jumlah Bayaran</label>
														<input type="text" class="form-control" value="<?php echo $harga_keseluruhan; ?>" readonly
															style="background-color: white;">
													</div>
												</div>
											</div>
											<div class="text-center">
												<h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
											</div>
											<div class="text-center">
												<button type="button" class="btn btn-secondary rounded-button"
													data-bs-dismiss="modal">Tutup</button>
												<button type="button" class="btn btn-primary rounded-button">Lihat Resit</button>

											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					} else {
						echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>

        <?php
    } else {
        echo "<p class='text-warning'>Invalid action.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>Invalid request.</p>";
}
?>