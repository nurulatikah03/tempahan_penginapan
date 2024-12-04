<?php
include_once "dewan.php";
include_once __DIR__ . '/../database/DBConnec.php';

class PekejPerkahwinan extends Dewan
{
    private $id_pekej;
    private $nama_pekej;
    private $harga_pekej;
    private $penerangan_pendek;
    private $penerangan_penuh;
    private $gambar_pekej;

    public function __construct($id_dewan, $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $peneranganKemudahan, $status_dewan, $gambarMain, $gambarBanner, $gambarAdd, $id_pekej, $nama_pekej, $harga_pekej, $penerangan_pendek, $penerangan_penuh, $gambar_pekej)
    {
        parent::__construct($id_dewan, $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $peneranganKemudahan, $status_dewan, $gambarMain, $gambarBanner, $gambarAdd);
        $this->id_pekej = $id_pekej;
        $this->nama_pekej = $nama_pekej;
        $this->harga_pekej = $harga_pekej;
        $this->penerangan_pendek = $penerangan_pendek;
        $this->penerangan_penuh = $penerangan_penuh;
        $this->gambar_pekej = $gambar_pekej;
    }

    public function getIdPekej()
    {
        return $this->id_pekej;
    }

    public function getNamaDewanKahwin()
    {
        return parent::getNamaDewan();
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

    public function getGambarPekej()
    {
        return $this->gambar_pekej;
    }

    public static function getAllPekejPerkahwinan()
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT
    id_perkahwinan,
    nama_pekej_kahwin,
    harga_pekej,
    huraian,
    huraian_pendek,
    gambar_pekej,
    id_dewan
FROM
    perkahwinan;";

        $result = $conn->query($sql);
        $packages = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
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
                    $row['gambar_pekej']
                );
                array_push($packages, $package);
            }
        }

        return $packages;
    }

    public static function getPekejPerkahwinanById($id)
    {
        $conn = DBConnection::getConnection();
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
            $row['gambar_pekej']
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
    public static function addPekejPerkahwinan($idDewan, $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh, $gambarPekej)
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO perkahwinan (id_dewan, nama_pekej_kahwin, harga_pekej, huraian_pendek, huraian, gambar_pekej) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isdsss", $idDewan, $namaPekej, $hargaPekej, $peneranganPendek, $peneranganPenuh, $gambarPekej);
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
