<style>
/* Ensure that each room card has consistent height and layout */
.room-1-block {
    display: flex;
    flex-direction: column;
    height: 500px; /* Increased height for the card */
    margin-bottom: 40px; /* Increased space between cards */
}

/* Image container styling */
.room-1-image {
    height: 300px; /* Increased image height */
    width: 100%;
    overflow: hidden;
}

/* Content container styling */
.room-1-content {
    flex-grow: 1; /* Allow content to take up the remaining space */
    padding: 20px; /* Increased padding for more space */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensure the button stays at the bottom */
    padding-left: 30px; /* Added left padding for space between text and button */
}

/* Styling for the description (penerangan_ringkas) */
.room-1-text {
    overflow: hidden; /* Prevent overflow */
    text-overflow: ellipsis; /* Truncate text with ellipsis */
    max-height: 80px; /* Increased max height for description */
    margin-bottom: 20px; /* Space between text and the button */
}

/* Button link styling */
.link-btn a {
    margin-top: auto; /* Push the button down to the bottom */
    padding: 12px 20px; /* Increased padding for the button */
    font-size: 16px; /* Increased font size */
    margin-left: 10px; /* Add left margin to button for some space */
}

/* Add hover effect for the button */
.link-btn a:hover {
    background-color: #007bff;
    color: #fff;
}

</style>


<section class="section-padding">
    <div class="auto-container">
        <div class="section_heading text-left mb_30 mt_30">
            <h3 class="section_heading_title_big">Pilihan penginapan lain</h3>
        </div>
        <div class="row">
            <?php
            try {
                if (isset($_GET['id_dewan'])) {
                    $selected_id_dewan = (int)$_GET['id_dewan'];
                } elseif (isset($_SESSION['id_dewan'])) {
                    $selected_id_dewan = (int)$_SESSION['id_dewan'];
                } else {
                    $selected_id_dewan = 0;
                }

                $stmt = $conn->prepare("SELECT r.*, dp.url_gambar AS gambar_utama
                                        FROM dewan r 
                                        LEFT JOIN dewan_pic dp ON r.id_dewan = dp.id_dewan AND dp.jenis_gambar = 'Utama'
                                        WHERE r.id_dewan != ?");
                $stmt->bind_param("i", $selected_id_dewan);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $delay = 0.2;
                    while ($dewan = $result->fetch_assoc()) {
                        $id_dewan = htmlspecialchars($dewan['id_dewan']);
                        $nama_dewan = htmlspecialchars($dewan['nama_dewan']);
                        $kadar_sewa = htmlspecialchars($dewan['kadar_sewa']);
                        $bilangan_muatan = htmlspecialchars($dewan['bilangan_muatan']);
                        $penerangan_ringkas = htmlspecialchars($dewan['penerangan_ringkas']);
                        $main_img = !empty($dewan['gambar_utama']) ? htmlspecialchars($dewan['gambar_utama']) : 'default-image.jpg';
                        $animation_delay = $delay . 's';
                        $delay += 0.2;
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $animation_delay; ?>" data-wow-duration="1.2s">
                    <div class="room-1-image hvr-img-zoom-1">
                        <img src="adminDashboard/controller/<?php echo $main_img; ?>" alt="<?php echo $nama_dewan; ?>" style="width: 100%; height: 250px; object-fit: cover;">
                    </div>
                    <div class="room-1-content">
                        <p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM<?php echo $kadar_sewa; ?></span>/hari</p>
                        <h4 class="room-1-title mb_20">
                            <a href="dewanDetail.php?id_dewan=<?php echo $id_dewan; ?>">
                                <?php echo $nama_dewan; ?>
                            </a>
                        </h4>
                        <p class="room-1-text mb_30"><?php echo $penerangan_ringkas; ?></p>
                        <div class="link-btn">
                            <a href="dewanDetail.php?id_dewan=<?php echo $id_dewan; ?>" class="btn-1 btn-alt">Lihat Butiran <span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                } else {
                    echo '<p class="no-results">Tiada pilihan penginapan lain buat masa ini.</p>';
                }
            } catch (mysqli_sql_exception $e) {
                echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>
</section>
