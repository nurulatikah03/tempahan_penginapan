<?php
require_once 'dewan.php';
require_once __DIR__ . '/../database/DBConnec.php';


class PekejPerkahwinan extends Dewan
{
    private $id_pekej;
    private $nama_pekej;
    private $harga_pekej;
    private $penerangan_pendek;
    private $penerangan_penuh;
    private $gambarMainKahwin;
    private $gambarBannerKahwin;
    private $gambarAddKahwin;

    public function __construct(
    $id_dewan, 
    $nama_dewan, 
    $kadar_sewa, 
    $bilangan_muatan, 
    $penerangan, 
    $peneranganKemudahan, 
    $status_dewan, 
    $gambarMain, 
    $gambarBanner, 
    $gambarAdd, 
    $id_pekej, 
    $nama_pekej, 
    $harga_pekej, 
    $penerangan_pendek, 
    $penerangan_penuh, 
    $gambarMainKahwin, 
    $gambarBannerKahwin, 
    $gambarAddKahwin
    ) {
        parent::__construct($id_dewan, $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $peneranganKemudahan, $status_dewan, $gambarMain, $gambarBanner, $gambarAdd);
        $this->id_pekej = $id_pekej;
        $this->nama_pekej = $nama_pekej;
        $this->harga_pekej = $harga_pekej;
        $this->penerangan_pendek = $penerangan_pendek;
        $this->penerangan_penuh = $penerangan_penuh;
        $this->gambarMainKahwin = $gambarMainKahwin;
        $this->gambarBannerKahwin = $gambarBannerKahwin;
        $this->gambarAddKahwin = $gambarAddKahwin;
    }

    public function getIdPekej()
    {
        return $this->id_pekej;
    }

    public function getNamaPekej()
    {
        return $this->nama_pekej;
    }

    public function getHargaPekej()
    {
        return $this->harga_pekej;
    }

    public function getPeneranganPendek()
    {
        return $this->penerangan_pendek;
    }

    public function getPeneranganPenuh()
    {
        return $this->penerangan_penuh;
    }

    public function getGambarMainKahwin()
    {
        return $this->gambarMainKahwin;
    }

    public function getGambarBannerKahwin()
    {
        return $this->gambarBannerKahwin;
    }

    public function getGambarAddKahwin()
    {
        return $this->gambarAddKahwin;
    }

    public static function getAllPekejPerkahwinan()
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT
                    id_perkahwinan,
                    id_dewan
                FROM
                    perkahwinan;";

        $result = $conn->query($sql);
        $packages = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $dewan = Dewan::getDewanById($row['id_dewan']);
                $pekej = PekejPerkahwinan::getPekejPerkahwinanById($row['id_perkahwinan']);
                $package = new PekejPerkahwinan(
                    $row['id_dewan'],
                    $dewan->getNamaDewan(),
                    $dewan->getKadarSewa(),
                    $dewan->getBilanganMuatan(),
                    $dewan->getPenerangan(),
                    $dewan->getPeneranganKemudahan(),
                    $dewan->getStatusDewan(),
                    $dewan->getGambarMain(),
                    $dewan->getGambarBanner(),
                    $dewan->getGambarAdd(),
                    $row['id_perkahwinan'],
                    $pekej->getNamaPekej(),
                    $pekej->getHargaPekej(),
                    $pekej->getPeneranganPendek(),
                    $pekej->getPeneranganPenuh(),
                    $pekej->getGambarMainKahwin(),
                    $pekej->getGambarBannerKahwin(),
                    $pekej->getGambarAddKahwin()
                );
                array_push($packages, $package);
            }
        }

        return $packages;
    }

    public static function getPekejPerkahwinanById($id)
    {
        $conn = DBConnection::getConnection();

        $imgMain = PekejPerkahwinan::getPerkahwinanImageByType($id, 'main');
        $imgBanner = PekejPerkahwinan::getPerkahwinanImageByType($id, 'banner');
        $imgList = PekejPerkahwinan::getPerkahwinanImageByType($id, 'add');

        $sql = "SELECT * FROM perkahwinan WHERE id_perkahwinan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $dewan = Dewan::getDewanById($row['id_dewan']);
        $package = new PekejPerkahwinan(
            $row['id_dewan'],
            $dewan->getNamaDewan(),
            $dewan->getKadarSewa(),
            $dewan->getBilanganMuatan(),
            $dewan->getPenerangan(),
            $dewan->getPeneranganKemudahan(),
            $dewan->getStatusDewan(),
            $dewan->getGambarMain(),
            $dewan->getGambarBanner(),
            $dewan->getGambarAdd(),
            $row['id_perkahwinan'],
            $row['nama_pekej_kahwin'],
            $row['harga_pekej'],
            $row['huraian_pendek'],
            $row['huraian'],
            $imgMain,
            $imgBanner,
            $imgList
        );
        $stmt->close();
        return $package;
    }


    public static function getPackageNameById($id)
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT nama_pekej_kahwin FROM perkahwinan WHERE id_perkahwinan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['nama_pekej_kahwin'];
    }

    public static function getPerkahwinanImageByType($id_perkahwinan, $type)
    {
        try {
            $conn = DBConnection::getConnection();
    
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT url_gambar FROM url_gambar WHERE id_perkahwinan = ? AND jenis_gambar = ?";
            $stmt = $conn->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Failed to prepare statement: " . $conn->error);
            }
    
            $stmt->bind_param("is", $id_perkahwinan, $type);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $images = [];
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['url_gambar'];
            }
    
            $stmt->close();
    
            return ($type === 'main' || $type === 'banner') ? ($images[0] ?? null) : $images;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null; 
        }
    }
    


    public static function getAllAddOn()
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM add_on_perkahwinan";
        $result = $conn->query($sql);
        $addons = [];
        while ($row = $result->fetch_assoc()) {
            $addon = [
                'add_on_id' => $row['add_on_id'],
                'add_on_nama' => $row['add_on_nama'],
                'harga' => $row['harga']
            ];
            array_push($addons, $addon);
        }
        return $addons;
    }

    //update package
    public static function updatePekejPerkahwinan($id, $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh, $idDewan, $gambarPekej)
    {
        $conn = DBConnection::getConnection();
        $sql = "UPDATE perkahwinan SET nama_pekej_kahwin = ?, harga_pekej = ?, huraian_pendek = ?, huraian = ?, id_dewan = ?, gambar_pekej = ? WHERE id_perkahwinan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssisi", $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh, $idDewan, $gambarPekej, $id);
        $stmt->execute();
        $stmt->close();
    }

    //update add-on
    public static function updateAddOn($id, $addOnName, $harga)
    {
        $conn = DBConnection::getConnection();
        $sql = "UPDATE add_on_perkahwinan SET add_on_nama = ?, harga = ? WHERE add_on_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $addOnName, $harga, $id);
        $stmt->execute();
        $stmt->close();
    }

    //add package
    public static function addPekejPerkahwinan($idDewan, $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh, $gambarMainKahwin)
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO perkahwinan (id_dewan, nama_pekej_kahwin, harga_pekej, huraian_pendek, huraian) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdss", $idDewan, $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh);
        $stmt->execute();
        $stmt->close();
        PekejPerkahwinan::addImages($conn->insert_id, 'main', $gambarMainKahwin);
    }

    //add images
    public static function addImages($id, $type, $url)
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO url_gambar (id_perkahwinan, jenis_gambar, url_gambar) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $id, $type, $url);
        $stmt->execute();
        $stmt->close();
    }

    //add addon
    public static function addAddOn($addOnName, $harga)
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO add_on_perkahwinan (add_on_nama, harga) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $addOnName, $harga);
        $stmt->execute();
        $stmt->close();
    }

    //deletion of package
    public static function deletePekejPerkahwinan($id)
    {
        $conn = DBConnection::getConnection();
        $sql = "DELETE FROM perkahwinan WHERE id_perkahwinan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    //deletion of add-on
    public static function deleteAddon($id)
    {
        $conn = DBConnection::getConnection();
        $sql = "DELETE FROM add_on_perkahwinan WHERE add_on_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

function checkAvailabilityWed($id, $date)
{
    $conn = DBConnection::getConnection();
    $sql = "SELECT * FROM tempahan WHERE id_perkahwinan = ? AND tarikh_tempahan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $id, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->num_rows === 0;
}
