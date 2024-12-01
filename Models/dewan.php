<?php
include_once __DIR__ . '/../database/DBConnec.php';
    class Dewan {

        protected $idDewan;
        protected $nama;
        protected $kadar_sewa;
        protected $kapasiti;
        protected $penerangan;
        protected $status;
        protected $gambar;

        public function __construct($idDewan, $nama, $kadar_sewa, $kapasiti, $penerangan, $status, $gambar){
            $this->idDewan = $idDewan;
            $this->nama = $nama;
            $this->kadar_sewa = $kadar_sewa;
            $this->kapasiti = $kapasiti;
            $this->penerangan = $penerangan;
            $this->status = $status;
            $this->gambar = $gambar;
        }

        public function getidDewan(){
            return $this->idDewan;
        }

        public function getNamaDewan(){
            return $this->nama;
        }

        public function getKadarSewa(){
            return $this->kadar_sewa;
        }

        public function getKapasiti(){
            return $this->kapasiti;
        }

        public function getPenerangan(){
            return $this->penerangan;
        }

        public function getStatus(){
            return $this->status;
        }

        public function getGambar(){
            return $this->gambar;
        }

        public static function getAllDewan(){
            $conn = DBConnection::getConnection();
            $sql = "SELECT * FROM dewan";
            $result = $conn->query($sql);
            $dewans = [];
            while($row = $result->fetch_assoc()){
                $dewan = new Dewan($row['id_dewan'], $row['nama_dewan'], $row['kadar_sewa'], $row['bilangan_muatan'], $row['penerangan'], $row['status_dewan'], $row['gambar']);
                array_push($dewans, $dewan);
            }
            return $dewans;
        }
    }