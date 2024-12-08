<?php 
    include_once __DIR__ . '/../database/database.php';

    class Aktiviti{
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
        
        public function __construct($id_aktiviti, $nama_akiviti, $kadar_harga, $penerangan_kemudahan, $penerangan, $status, $lisKemudahan, $gambarUtama, $gambarBanner, $gambarLain){
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

        public function getId(){
            return $this->id_aktiviti;
        }

        public function getNamaAktiviti(){
            return $this->nama_akiviti;
        }

        public function getKadarHarga(){
            return $this->kadar_harga;
        }

        public function getPeneranganKemudahan(){
            return $this->penerangan_kemudahan;
        }

        public function getPenerangan(){
            return $this->penerangan;
        }

        public function getStatus(){
            return $this->status;
        }

        public function getLisKemudahan(){
            return $this->lisKemudahan;
        }

        public function getGambarUtama(){
            return $this->gambarUtama;
        }

        public function getGambarBanner(){
            return $this->gambarBanner;
        }

        public function getGambarLain(){
            return $this->gambarLain;
        }

        //get all aktiviti object
        

    }