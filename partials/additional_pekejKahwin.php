<!-- Related room -->

<?php include_once 'database/DBConnec.php';
include_once 'Models/pekejPerkahwinan.php'; ?>
<section class="section-padding">
    <div class="auto-container">
        <div class="section_heading text-left mb_30 mt_30">
            <h3 class="section_heading_title_big">Pilihan pekej perkahwinan lain</h3>
        </div>
        <div class="row">
            <?php
            $selected_package_id = isset($_GET['id_perkahwinan']) ? htmlspecialchars($_GET['id_perkahwinan']) : (isset($_SESSION['id_perkahwinan']) ? htmlspecialchars($_SESSION['id_perkahwinan']) : null);
            $packages = pekejPerkahwinan::getAllPekejPerkahwinan();

            foreach ($packages as $pack) {
                if ($pack->getIdPekej() !== $selected_package_id) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.2s">

                            <div class="room-1-image hvr-img-zoom-1" style="height: 200px; width:auto">
                                <img src="<?php echo htmlspecialchars($pack->getGambarMainKahwin()); ?>" alt="">
                            </div>
                            <div class="room-1-content">
                                <p class="room-1-meta-info">Bermula dari <span class="theme-color">RM<?php echo htmlspecialchars($pack->getHargaPekej()); ?></span>/malam</p>
                                <h4 class="room-1-title mb_20">
                                    <a href="perkahwinanDetail.php?id_perkahwinan=<?php echo htmlspecialchars($pack->getIdPekej()); ?>">
                                        <?php echo htmlspecialchars($pack->getNamaPekej()); ?>
                                    </a>
                                </h4>
                                <p class="room-1-text mb_30"><?php echo htmlspecialchars($pack->getPeneranganPendek()); ?></p>
                                <div class="link-btn">
                                    <a href="perkahwinanDetail.php?id_perkahwinan=<?php echo htmlspecialchars($pack->getIdPekej()); ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } 
            } 
            ?>

        </div>
    </div>
</section>