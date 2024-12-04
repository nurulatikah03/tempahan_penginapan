<?php
include_once __DIR__ . '/../database/DBConnec.php';

class Dewan {

    protected $id_dewan;
    protected $nama_dewan;
    protected $kadar_sewa;
    protected $bilangan_muatan;
    protected $penerangan;
    protected $status_dewan;
    protected $gambar;

    // Constructor
    public function __construct($id_dewan, $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $status_dewan, $gambar) {
        $this->id_dewan = $id_dewan;
        $this->nama_dewan = $nama_dewan;
        $this->kadar_sewa = $kadar_sewa;
        $this->bilangan_muatan = $bilangan_muatan;
        $this->penerangan = $penerangan;
        $this->status_dewan = $status_dewan;
        $this->gambar = $gambar;
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

    public function getStatusDewan() {
        return $this->status_dewan;
    }

    public function getGambar() {
        return $this->gambar;
    }

    // Static method to get all Dewans from the database
    public static function getAllDewan() {
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM dewan";
        $result = $conn->query($sql);
        $dewans = [];

        while($row = $result->fetch_assoc()) {
            $dewan = new Dewan(
                $row['id_dewan'], 
                $row['nama_dewan'], 
                $row['kadar_sewa'], 
                $row['bilangan_muatan'], 
                $row['penerangan'], 
                $row['status_dewan'], 
                $row['gambar']
            );
            array_push($dewans, $dewan);
        }
        return $dewans;
    }

    // Static method to get a single Dewan by ID
    public static function getDewanById($id_dewan) {
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM dewan WHERE id_dewan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_dewan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Dewan(
                $row['id_dewan'], 
                $row['nama_dewan'], 
                $row['kadar_sewa'], 
                $row['bilangan_muatan'], 
                $row['penerangan'], 
                $row['status_dewan'], 
                $row['gambar']
            );
        } else {
            return null;  // No dewan found
        }
    }
}
?>
