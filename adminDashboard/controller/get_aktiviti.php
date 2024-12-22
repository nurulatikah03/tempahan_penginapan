<?php
if (isset($_GET['id_aktiviti'])) {
    $id_aktiviti = intval($_GET['id_aktiviti']);

    $sql = "
        SELECT 
            a.id_aktiviti, 
            a.nama_aktiviti, 
            a.kadar_harga, 
			a.penerangan_kemudahan,  
            a.penerangan, 
            a.status_aktiviti, 
            COALESCE(main.url_gambar, '') AS gambar_main,
            COALESCE(banner.url_gambar, '') AS gambar_banner,
            COALESCE(add.url_gambar, '') AS gambar_tambahan
        FROM 
            aktiviti a
        LEFT JOIN 
            url_gambar  utama ON a.id_aktiviti = main.id_aktiviti AND main.jenis_gambar = 'main'
        LEFT JOIN 
            url_gambar  banner ON a.id_aktiviti = banner.id_aktiviti AND banner.jenis_gambar = 'banner'
        LEFT JOIN 
            url_gambar  tambahan ON a.id_aktiviti = add.id_aktiviti AND add.jenis_gambar = 'add'
        WHERE 
            a.id_aktiviti = $id_aktiviti
";}
?>