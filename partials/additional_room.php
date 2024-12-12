<!-- Related room -->
 
<?php include_once 'database/DBConnec.php';?>
<section class="section-padding">
        <div class="auto-container">
            <div class="section_heading text-left mb_30 mt_30">
                <h3 class="section_heading_title_big">Pilihan penginapan lain</h3>
            </div>
            <div class="row">
                <?php
                try{
                    $conn = DBConnection::getConnection();
                    $selected_room_id = isset($_SESSION['room_id']) ? (int)$_SESSION['room_id'] : 0;
                    $stmt = "SELECT * FROM bilik r LEFT JOIN url_gambar ri ON r.id_bilik = ri.id_bilik WHERE jenis_gambar = 'main';";
                    $result = $conn->query($stmt);

                    if ($result->num_rows > 0) {
                        while ($room = $result->fetch_assoc()) {
                            $room_id = $room['id_bilik'];
                            
                            if ($room_id == $selected_room_id) {
                                continue; 
                            }

                            $room_name = $room['nama_bilik'];
                            $short_description = $room['huraian_pendek'];
                            $price = $room['harga_semalaman'];
                            $main_img = $room['url_gambar']; 
                    ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.2s">
                                <div class="room-1-image hvr-img-zoom-1" style="height: 200px; width:auto">
                                    <img src="<?php echo htmlspecialchars($main_img); ?>" alt="">
                                </div>
                                <div class="room-1-content">
                                    <p class="room-1-meta-info">Bermula dari <span class="theme-color">RM<?php echo htmlspecialchars($price); ?></span>/malam</p>
                                    <h4 class="room-1-title mb_20">
                                        <a href="room_details.php?room_id=<?php echo htmlspecialchars($room_id); ?>.php">
                                            <?php echo htmlspecialchars($room_name); ?>
                                        </a>
                                    </h4>
                                    <p class="room-1-text mb_30"><?php echo htmlspecialchars($short_description); ?></p>
                                    <div class="link-btn">
                                        <a href="room_details.php?room_id=<?php echo htmlspecialchars($room_id); ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    } 
                    else {
                        echo "<p>No rooms available at the moment.</p>";
                    }
                }catch (mysqli_sql_exception $e) {
                    echo "Error: " . $e->getMessage();
                }
                    ?>
                
                
            </div>
        </div>
    </section>