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
            COALESCE(utama.url_gambar, '') AS gambar_utama,
            COALESCE(banner.url_gambar, '') AS gambar_banner,
            COALESCE(tambahan.url_gambar, '') AS gambar_tambahan
        FROM 
            aktiviti a
        LEFT JOIN 
            aktiviti_pic utama ON a.id_aktiviti = utama.id_aktiviti AND utama.jenis_gambar = 'Utama'
        LEFT JOIN 
            aktiviti_pic banner ON a.id_aktiviti = banner.id_aktiviti AND banner.jenis_gambar = 'Banner'
        LEFT JOIN 
            aktiviti_pic tambahan ON a.id_aktiviti = tambahan.id_aktiviti AND tambahan.jenis_gambar = 'Tambahan'
        WHERE 
            a.id_aktiviti = $id_aktiviti
";}
?>