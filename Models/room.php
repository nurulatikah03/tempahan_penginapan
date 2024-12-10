<?php
include_once __DIR__ . '/../database/DBConnec.php';


class Room
{

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

    public function __construct($id, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $imgMain, $imgBanner, $imgList, $aminitiesList)
    {
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

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmenDesc()
    {
        return $this->amenDesc;
    }

    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    public function getLongDesc()
    {
        return $this->longDesc;
    }

    public function getMaxCapacity()
    {
        return $this->maxCapacity;
    }

    public function getImgMain()
    {
        return $this->imgMain;
    }

    public function getImgBanner()
    {
        return $this->imgBanner;
    }

    public function getImgList()
    {
        return $this->imgList;
    }

    public function getAminitiesList()
    {
        return $this->aminitiesList;
    }

    public static function getAllRooms()
    {
        $conn = DBConnection::getConnection();

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

    public static function getRoomById($roomId)
    {
        $conn = DBConnection::getConnection();

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

    public static function getRoomImageByType($room_id, $type)
    {
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT url_gambar FROM url_gambar WHERE id_bilik = ? AND jenis_gambar = ?";
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

    public static function getAmenList($room_id)
    {
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT k.nama, k.icon_url FROM kemudahan k LEFT JOIN bilik_kemudahan b ON k.id_kemudahan = b.id_kemudahan WHERE b.id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $room_id);
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

    public static function getAllAminities(){
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM kemudahan";
        $result = $conn->query($sql);

        $amenities = [];
        while ($row = $result->fetch_assoc()) {
            $amenities[] = [
                'name' => $row['nama'],
                'icon_url' => $row['icon_url']
            ];
        }


        return $amenities;
    }

    public static function getRoomNameById($roomId)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT nama_bilik FROM bilik WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $roomName = $row['nama_bilik'];

        $stmt->close();
        return $roomName;
    }

    //delete a Room

    public static function delImgAddByURL($roomID, $imgType, $imgURL)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM url_gambar WHERE id_bilik = ? AND jenis_gambar = ? AND url_gambar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $roomID, $imgType, $imgURL);
        $stmt->execute();

        $stmt->close();
    }
    
    public static function delImgByRoomId($roomId)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM url_gambar WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        $stmt->close();
    }

    public static function delAmenByRoomId($roomId)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM bilik_kemudahan WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        $stmt->close();
    }

    public static function delRoomById($roomId)
    {
        $conn = DBConnection::getConnection();

        Room::delImgByRoomId($roomId);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM bilik WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        $stmt->close();
    }
    

    //Insert a Room

    public static function addImage($roomId, $imgURL, $imgType)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO url_gambar (id_bilik, url_gambar, jenis_gambar) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $roomId, $imgURL, $imgType);
        $stmt->execute();

        $stmt->close();
    }

    public static function addNewRoom($name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $aminitiesList)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO bilik (nama_bilik, kapasiti, jenis_bilik, harga_semalaman, huraian_kemudahan, huraian_pendek, huraian, max_capacity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisisssi", $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity);
        $stmt->execute();

        $roomId = $conn->insert_id;

        foreach ($aminitiesList as $amenityName) {
            $sql = "SELECT id_kemudahan FROM kemudahan WHERE nama = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $amenityName);
            $stmt->execute();
            $result = $stmt->get_result();
            $amenity = $result->fetch_assoc();

            if ($amenity) {
                $amenityId = $amenity['id_kemudahan'];

                $sql = "INSERT INTO bilik_kemudahan (id_bilik, id_kemudahan) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $roomId, $amenityId);
                $stmt->execute();
            }
        }

        $stmt->close();
        return $roomId;
    }

    //Update a Room

    public static function setRoomById($roomId, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $aminitiesList)
    {
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE bilik SET nama_bilik = ?, kapasiti = ?, jenis_bilik = ?, harga_semalaman = ?, huraian_kemudahan = ?, huraian_pendek = ?, huraian = ?, max_capacity = ? WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisissssi", $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $maxCapacity, $roomId);
        $stmt->execute();

        Room::updateAmenList($roomId, $aminitiesList);

        $stmt->close();
    }

    private static function updateAmenList($roomId, $aminitiesList)
    {
        $conn = DBConnection::getConnection();


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM bilik_kemudahan WHERE id_bilik = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $roomId);
        $stmt->execute();

        foreach ($aminitiesList as $amenityName) {
            $sql = "SELECT id_kemudahan FROM kemudahan WHERE nama = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $amenityName);
            $stmt->execute();
            $result = $stmt->get_result();
            $amenity = $result->fetch_assoc();

            if ($amenity) {
                $amenityId = $amenity['id_kemudahan'];

                $sql = "INSERT INTO bilik_kemudahan (id_bilik, id_kemudahan) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $roomId, $amenityId);
                $stmt->execute();
            }
        }

        $stmt->close();
    }

    public static function updateNewImgUrl($roomId, $oldUrl, $newUrl, $imgType){
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE url_gambar SET url_gambar = ? WHERE id_bilik = ? AND url_gambar = ? AND jenis_gambar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $newUrl, $roomId, $oldUrl, $imgType);
        $stmt->execute();

        $stmt->close();
    }

    public static function updateImageByType($roomId, $imgURL, $imgType)
    {
        $conn = DBConnection::getConnection();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE url_gambar SET url_gambar = ? WHERE id_bilik = ? AND jenis_gambar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $imgURL, $roomId, $imgType);
        $stmt->execute();

        $stmt->close();
    }
}
