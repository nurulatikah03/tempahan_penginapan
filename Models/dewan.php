<?php
include_once __DIR__ . '/../database/DBConnec.php';

class Dewan {

    protected $id_dewan;
    protected $nama_dewan;
    protected $kadar_sewa;
    protected $bilangan_muatan;
    protected $penerangan;
    protected $peneranganKemudahan;
    protected $status_dewan;
    protected $gambarMain;
    protected $gambarBanner;
    protected $gambarAdd;

    // Constructor
    public function __construct($id_dewan, $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $peneranganKemudahan, $status_dewan, $gambarMain, $gambarBanner, $gambarAdd) {
        $this->id_dewan = $id_dewan;
        $this->nama_dewan = $nama_dewan;
        $this->kadar_sewa = $kadar_sewa;
        $this->bilangan_muatan = $bilangan_muatan;
        $this->penerangan = $penerangan;
        $this->peneranganKemudahan = $peneranganKemudahan;
        $this->status_dewan = $status_dewan;
        $this->gambarMain = $gambarMain;
        $this->gambarBanner = $gambarBanner;
        $this->gambarAdd = $gambarAdd;
    }

    // Getter methods
    public function getIdDewan() {
        return $this->id_dewan;
    }

    public function getNamaDewan() {
        return $this->nama_dewan;
    }

    public function getKadarSewa() {
        return $this->kadar_sewa;
    }

    public function getBilanganMuatan() {
        return $this->bilangan_muatan;
    }

    public function getPenerangan() {
        return $this->penerangan;
    }

    public function getPeneranganKemudahan() {
        return $this->peneranganKemudahan;
    }

    public function getStatusDewan() {
        return $this->status_dewan;
    }

    public function getGambarMain() {
        return $this->gambarMain;
    }

    public function getGambarBanner() {
        return $this->gambarBanner;
    }

    public function getGambarAdd() {
        return $this->gambarAdd;
    }
    // Static method to get all Dewans from the database
    public static function getAllDewan() 
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT d.*, dp.url_gambar, dp.jenis_gambar 
                FROM dewan d 
                LEFT JOIN dewan_pic dp ON d.id_dewan = dp.id_dewan";
        $result = $conn->query($sql);

        $dewans = [];
        while ($row = $result->fetch_assoc()) {
            $gambarMain = null;
            $gambarBanner = null;
            $gambarAdd = null;

            if ($row['jenis_gambar'] == 'Utama') {
                $gambarMain = $row['url_gambar'];
            } elseif ($row['jenis_gambar'] == 'Banner') {
                $gambarBanner = $row['url_gambar'];
            } elseif ($row['jenis_gambar'] == 'Tambahan') {
                $gambarAdd = $row['url_gambar'];
            }

            $dewans[] = new Dewan(
                $row['id_dewan'],
                $row['nama_dewan'],
                $row['kadar_sewa'],
                $row['bilangan_muatan'],
                $row['penerangan'],
                $row['penerangan_kemudahan'],
                $row['status_dewan'],
                $gambarMain,
                $gambarBanner,
                $gambarAdd
            );
        }

        return $dewans;
    }

    public static function getDewanById($id) 
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT d.*, dp.url_gambar, dp.jenis_gambar 
                FROM dewan d 
                LEFT JOIN dewan_pic dp ON d.id_dewan = dp.id_dewan 
                WHERE d.id_dewan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $gambarMain = null;
        $gambarBanner = null;
        $gambarAdd = null;

        if ($row['jenis_gambar'] == 'Utama') {
            $gambarMain = $row['url_gambar'];
        } elseif ($row['jenis_gambar'] == 'Banner') {
            $gambarBanner = $row['url_gambar'];
        } elseif ($row['jenis_gambar'] == 'Tambahan') {
            $gambarAdd = $row['url_gambar'];
        }

        $dewan = new Dewan(
            $row['id_dewan'],
            $row['nama_dewan'],
            $row['kadar_sewa'],
            $row['bilangan_muatan'],
            $row['penerangan'],
            $row['penerangan_kemudahan'],
            $row['status_dewan'],
            $gambarMain,
            $gambarBanner,
            $gambarAdd
        );

        $stmt->close();

        return $dewan;
    }
}