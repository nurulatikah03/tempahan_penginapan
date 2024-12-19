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
            COALESCE(main.url_gambar, '') AS gambar_main,
            COALESCE(banner.url_gambar, '') AS gambar_banner,
            COALESCE(add.url_gambar, '') AS gambar_tambahan
        FROM 
            dewan d
        LEFT JOIN 
            url_gambar main ON d.id_dewan = main.id_dewan AND main.jenis_gambar = 'main'
        LEFT JOIN 
            url_gambar banner ON d.id_dewan = banner.id_dewan AND banner.jenis_gambar = 'banner'
        LEFT JOIN 
            url_gambar add ON d.id_dewan = add.id_dewan AND add.jenis_gambar = 'add'
        WHERE 
            d.id_dewan = $id_dewan
";}
?>