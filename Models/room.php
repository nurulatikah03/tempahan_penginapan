<?php
    include_once __DIR__ . '/../database/database.php';

    class Room {

        private $id;
        private $name;
        private $capacity;
        private $type;
        private $price;
        private $amenDesc;
        private $shortDesc;
        private $longDesc;
        private $saiz;
        private $imgMain;
        private $imgBanner;
        private $imgList;
        private $aminitiesList;

        public function __construct($id, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $saiz, $imgMain, $imgBanner, $imgList, $aminitiesList) {
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->type = $type;
            $this->price = $price;
            $this->amenDesc = $amenDesc;
            $this->shortDesc = $shortDesc;
            $this->longDesc = $longDesc;
            $this->saiz = $saiz;
            $this->imgMain = $imgMain;
            $this->imgBanner = $imgBanner;
            $this->imgList = $imgList;
            $this->aminitiesList = $aminitiesList;
        }

        public function getId() {
            return $this->id;
        }

        public function getName() {
            return $this->name;
        }

        public function getCapacity() {
            return $this->capacity;
        }

        public function getType() {
            return $this->type;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getAmenDesc() {
            return $this->amenDesc;
        }

        public function getShortDesc() {
            return $this->shortDesc;
        }

        public function getLongDesc() {
            return $this->longDesc;
        }

        public function getSaiz() {
            return $this->saiz;
        }

        public function getImgMain() {
            return $this->imgMain;
        }

        public function getImgBanner() {
            return $this->imgBanner;
        }

        public function getImgList() {
            return $this->imgList;
        }

        public function getAminitiesList() {
            return $this->aminitiesList;
        }
        
        public static function getRoomById($roomId) {
            global $conn;
            $imgMain = Room::getRoomImageByType($roomId, 'main');
            $imgBanner = Room::getRoomImageByType($roomId, 'banner');
            $imgList = Room::getRoomImageByType($roomId, 'add');
            $aminitiesList = Room::getAmenList($roomId);
    
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT * FROM bilik WHERE id_bilik = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $roomId);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $room = new Room(
                    $row['id_bilik'],
                    $row['nama_bilik'],
                    $row['kapasiti'],
                    $row['jenis_bilik'],
                    $row['harga_semalaman'],
                    $row['huraian_kemudahan'],
                    $row['huraian_pendek'],
                    $row['huraian'],
                    $row['keluasan'],
                    $imgMain,
                    $imgBanner,
                    $imgList,
                    $aminitiesList,
                );
                $stmt->close();
                return $room;
            } else {
                $stmt->close();
                return null;
            }
        }

        public static function getRoomImageByType($room_id, $type) {
            global $conn;
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            $sql = "SELECT url_gambar FROM bilik_pic WHERE id_bilik = ? AND jenis_gambar = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $room_id, $type);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $images = [];
            while ($row = $result->fetch_assoc()) {
                $images[] = $row['url_gambar'];
            }
        
            $stmt->close();
        
            // Return a single URL if only one image is expected, otherwise return the list
            return ($type === 'main' || $type === 'banner') ? ($images[0] ?? null) : $images;
        }
        

        public static function getAmenList($room_id) {
            global $conn;
    
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT k.nama, k.icon FROM kemudahan k LEFT JOIN bilik_kemudahan b ON k.id_kemudahan = b.id_bilik_kemudahan WHERE b.id_bilik = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            $amenList = [];
            while ($row = $result->fetch_assoc()) {
            $amenList[] = [
                'name' => $row['nama'],
                'icon' => $row['icon']
            ];
            }
    
            $stmt->close();
            return $amenList;
        }

    }