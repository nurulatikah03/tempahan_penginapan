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
        private $maxCapacity;
        private $imgMain;
        private $imgBanner;
        private $imgList;
        private $aminitiesList;

        public function __construct($id, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $imgMain, $imgBanner, $imgList, $aminitiesList) {
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->type = $type;
            $this->price = $price;
            $this->amenDesc = $amenDesc;
            $this->shortDesc = $shortDesc;
            $this->longDesc = $longDesc;
            $this->maxCapacity = $maxCapacity;
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

        public function getMaxCapacity() {
            return $this->maxCapacity;
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
        
        public static function getAllRooms() {
            global $conn;
            $rooms = [];
    
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "SELECT id_bilik FROM bilik";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $rooms[] = Room::getRoomById($row['id_bilik']);
                }
            }
    
            return $rooms;
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
                    $row['max_capacity'],
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

      //Update a Room

      public static function setRoomById($roomId, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $imgMain, $imgBanner, $imgList, $aminitiesList) {
        global $conn;

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE bilik SET nama_bilik = ?, kapasiti = ?, jenis_bilik = ?, harga_semalaman = ?, huraian_kemudahan = ?, huraian_pendek = ?, huraian = ?, max_capacity = ? WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisissssi", $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $roomId);
        $stmt->execute();

        // Update images and amenities if necessary
        Room::updateRoomImages($roomId, $imgMain, $imgBanner, $imgList);
        Room::updateAmenList($roomId, $aminitiesList);

        $stmt->close();
    }

    private static function updateRoomImages($roomId, $imgMain, $imgBanner, $imgList) {
        global $conn;

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        // Update main image
        $sql = "UPDATE bilik_pic SET url_gambar = ? WHERE id_bilik = ? AND jenis_gambar = 'main'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imgMain, $roomId);
        $stmt->execute();

        // Update banner image
        $sql = "UPDATE bilik_pic SET url_gambar = ? WHERE id_bilik = ? AND jenis_gambar = 'banner'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imgBanner, $roomId);
        $stmt->execute();

        // Update additional images
        $sql = "DELETE FROM bilik_pic WHERE id_bilik = ? AND jenis_gambar = 'add'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        foreach ($imgList as $img) {
        $sql = "INSERT INTO bilik_pic (id_bilik, jenis_gambar, url_gambar) VALUES (?, 'add', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $roomId, $img);
        $stmt->execute();
        }

        $stmt->close();
    }

    private static function updateAmenList($roomId, $aminitiesList) {
        global $conn;

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM bilik_kemudahan WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        foreach ($aminitiesList as $amenity) {
        $sql = "INSERT INTO bilik_kemudahan (id_bilik, id_kemudahan) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $roomId, $amenity['id']);
        $stmt->execute();
        }

        $stmt->close();
        }
    }