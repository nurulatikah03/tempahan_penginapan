<section class="section-padding">
    <div class="auto-container">
        <div class="section_heading text-left mb_30 mt_30">
            <h3 class="section_heading_title_big">Pilihan aktiviti lain</h3>
        </div>
        <div class="row">
            <?php
            try {
                if (isset($_GET['id_aktiviti'])) {
                    $selected_id_aktiviti = (int)$_GET['id_aktiviti'];
                } elseif (isset($_SESSION['id_aktiviti'])) {
                    $selected_id_aktiviti = (int)$_SESSION['id_aktiviti'];
                } else {
                    $selected_id_aktiviti = 0;
                }

                $allAktiviti = Aktiviti::getAllAktiviti();

                if (!empty($allAktiviti)) {
                    $delay = 0.2;
                    foreach ($allAktiviti as $aktiviti) {
                        if ($aktiviti->getId() != $selected_id_aktiviti) {
                        $id_aktiviti = $aktiviti->getId();
                        $nama_aktiviti = $aktiviti->getNamaAktiviti();
                        $kadar_harga = $aktiviti->getKadarHarga();
                        $penerangan = $aktiviti->getPenerangan();
                        $main_img = !empty($aktiviti->getGambarUtama()) ? $aktiviti->getGambarUtama() : 'default-image.jpg';
                        $delay += 0.2;
                        $animation_delay = $delay . 's';
            ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $animation_delay; ?>" data-wow-duration="1.2s">
                                <div class="room-1-image hvr-img-zoom-1">
                                    <img src="adminDashboard/controller/<?php echo $main_img; ?>" alt="<?php echo $nama_aktiviti; ?>" style="width: 100%; height: 250px; object-fit: cover;">
                                </div>
                                <div class="room-1-content">
                                    <p class="room-1-meta-info">Kadar Harga <span class="theme-color">RM<?php echo $kadar_harga; ?></span>/hari</p>
                                    <h4 class="room-1-title mb_20">
                                        <a href="aktivitiDetail.php?id_aktiviti=<?php echo $id_aktiviti; ?>">
                                            <?php echo $nama_aktiviti; ?>
                                        </a>
                                    </h4>
                                    <p class="room-1-text mb_30" style="display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;"><?php echo $penerangan; ?></p>
                                    <div class="link-btn">
                                        <a href="aktivitiDetail.php?id_aktiviti=<?php echo $id_aktiviti; ?>" class="btn-1 btn-alt">Lihat Butiran <span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                    echo '<p class="no-results">Tiada pilihan aktiviti lain buat masa ini.</p>';
                }
            } catch (mysqli_sql_exception $e) {
                echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>
</section>