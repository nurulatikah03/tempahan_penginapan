<?php
include_once __DIR__ . '/../database/DBConnec.php';

class Aktiviti
{
    private $id_aktiviti;
    private $nama_akiviti;
    private $kadar_harga;
    private $penerangan_kemudahan;
    private $penerangan;
    private $status;
    private $lisKemudahan;
    private $gambarUtama;
    private $gambarBanner;
    private $gambarLain;

    public function __construct($id_aktiviti, $nama_akiviti, $kadar_harga, $penerangan_kemudahan, $penerangan, $status, $lisKemudahan, $gambarUtama, $gambarBanner, $gambarLain)
    {
        $this->id_aktiviti = $id_aktiviti;
        $this->nama_akiviti = $nama_akiviti;
        $this->kadar_harga = $kadar_harga;
        $this->penerangan_kemudahan = $penerangan_kemudahan;
        $this->penerangan = $penerangan;
        $this->status = $status;
        $this->lisKemudahan = $lisKemudahan;
        $this->gambarUtama = $gambarUtama;
        $this->gambarBanner = $gambarBanner;
        $this->gambarLain = $gambarLain;
    }

    public function getId()
    {
        return $this->id_aktiviti;
    }

    public function getNamaAktiviti()
    {
        return $this->nama_akiviti;
    }

    public function getKadarHarga()
    {
        return $this->kadar_harga;
    }

    public function getPeneranganKemudahan()
    {
        return $this->penerangan_kemudahan;
    }

    public function getPenerangan()
    {
        return $this->penerangan;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getLisKemudahan()
    {
        return $this->lisKemudahan;
    }

    public function getGambarUtama()
    {
        return $this->gambarUtama;
    }

    public function getGambarBanner()
    {
        return $this->gambarBanner;
    }

    public function getGambarLain()
    {
        return $this->gambarLain;
    }

    //get all aktiviti object
    public static function getAllAktiviti()
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM aktiviti";
        $result = $conn->query($sql);

        $aktivitiList = [];
        while ($row = $result->fetch_assoc()) {
            $aktivitiList[] = new Aktiviti(
                $row['id_aktiviti'],
                $row['nama_aktiviti'],
                $row['kadar_harga'],
                $row['penerangan_kemudahan'],
                $row['penerangan'],
                $row['status_aktiviti'],
                self::getAmenList($row['id_aktiviti']),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Utama'),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Banner'),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Tambahan')
            );
        }

        $conn->close();
        return $aktivitiList;
    }

    public static function getAktivitiById($id)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM aktiviti WHERE id_aktiviti = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $aktiviti = new Aktiviti(
                $row['id_aktiviti'],
                $row['nama_aktiviti'],
                $row['kadar_harga'],
                $row['penerangan_kemudahan'],
                $row['penerangan'],
                $row['status_aktiviti'],
                self::getAmenList($row['id_aktiviti']),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Utama'),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Banner'),
                self::getAktivitiImgByType($row['id_aktiviti'], 'Tambahan')
            );
        } else {
            $aktiviti = null;
        }

        $stmt->close();
        return $aktiviti;
    }

    public static function getAktivitiImgByType($id, $type)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT url_gambar FROM aktiviti_pic WHERE id_aktiviti = ? AND jenis_gambar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $id, $type);
        $stmt->execute();
        $result = $stmt->get_result();

        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['url_gambar'];
        }

        $stmt->close();

        // Return a single URL if only one image is expected, otherwise return the list
        return ($type === 'Utama' || $type === 'Banner') ? ($images[0] ?? null) : $images;
    }

    public static function getAmenList($id)
    {
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT k.nama, k.icon_url FROM kemudahan k LEFT JOIN aktiviti_kemudahan b ON k.id_kemudahan = b.id_kemudahan WHERE b.id_aktiviti = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $amenList = [];
        while ($row = $result->fetch_assoc()) {
            $amenList[] = [
                'name' => $row['nama'],
                'icon_url' => $row['icon_url']
            ];
        }

        $stmt->close();
        return $amenList;
    }
}
