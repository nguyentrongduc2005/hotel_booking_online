<?php

namespace app\models;

use app\core\db;
use PDO;



class DetailRoomModel
{

    private $db;

    public function __construct()
    {

        $this->db = db::connect();
    }

    public function getAllRooms()
    {
        $sql = "SELECT * FROM room";
        $stmt = $this->db->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data ?: [];
    }

    public function getRoomById($id)
    {
        $sql = "SELECT * FROM room WHERE id_room = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
