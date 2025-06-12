<?php
namespace app\models;

use app\core\db;
use PDO;

class DetailRoomModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = db::connect();
    }

   public function getAllRooms(): array
{
    $sql = "SELECT * FROM room";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getRoomById(int $id): array|false
{
    $sql = "SELECT * FROM room WHERE id_room = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
