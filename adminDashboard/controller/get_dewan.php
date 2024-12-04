<?php
if (isset($_GET['id_dewan'])) {
    $id_dewan = intval($_GET['id_dewan']);

    $sql = "
        SELECT 
            d.id_dewan, 
            d.nama_dewan, 
            d.kadar_sewa, 
            d.bilangan_muatan, 
            d.penerangan, 
            d.penerangan_kemudahan,  
            d.penerangan_ringkas, 
            d.status_dewan, 
            d.max_capacity, 
            COALESCE(utama.url_gambar, '') AS gambar_utama,
            COALESCE(banner.url_gambar, '') AS gambar_banner,
            COALESCE(tambahan.url_gambar, '') AS gambar_tambahan
        FROM 
            dewan d
        LEFT JOIN 
            dewan_pic utama ON d.id_dewan = utama.id_dewan AND utama.jenis_gambar = 'Utama'
        LEFT JOIN 
            dewan_pic banner ON d.id_dewan = banner.id_dewan AND banner.jenis_gambar = 'Banner'
        LEFT JOIN 
            dewan_pic tambahan ON d.id_dewan = tambahan.id_dewan AND tambahan.jenis_gambar = 'Tambahan'
        WHERE 
            d.id_dewan = $id_dewan
";}
?>