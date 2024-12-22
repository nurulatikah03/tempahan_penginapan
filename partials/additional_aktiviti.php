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
				$conn = DBConnection::getConnection();
                $stmt = $conn->prepare("SELECT r.*, dp.url_gambar AS gambar_utama
                                        FROM aktiviti r 
                                        LEFT JOIN url_gambar dp ON r.id_aktiviti = dp.id_aktiviti AND dp.jenis_gambar = 'main'
                                        WHERE r.id_aktiviti != ?");
                $stmt->bind_param("i", $selected_id_aktiviti);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $delay = 0.2;
                    while ($aktiviti = $result->fetch_assoc()) {
                        $id_aktiviti = htmlspecialchars($aktiviti['id_aktiviti']);
                        $nama_aktiviti = htmlspecialchars($aktiviti['nama_aktiviti']);
                        $kadar_harga = htmlspecialchars($aktiviti['kadar_harga']);
                        $penerangan_kemudahan = htmlspecialchars($aktiviti['penerangan_kemudahan']);
                        $penerangan = htmlspecialchars($aktiviti['penerangan']);
                        $main_img = !empty($aktiviti['gambar_utama']) ? htmlspecialchars($aktiviti['gambar_utama']) : 'default-image.jpg';
                        $animation_delay = $delay . 's';
                        $delay += 0.2;
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
                        <p class="room-1-text mb_30"><?php echo $penerangan; ?></p>
                        <div class="link-btn">
                            <a href="aktivitiDetail.php?id_aktiviti=<?php echo $id_aktiviti; ?>" class="btn-1 btn-alt">Lihat Butiran <span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
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
