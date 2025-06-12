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
public function getAll()
    {
        return db::selectAll("SELECT * FROM room");
    }

    public function getById($id)
    {
        return db::selectOne("SELECT * FROM room WHERE id_room = ?", [$id]);
    }

    public function delete($id)
    {
        return db::execute("DELETE FROM room WHERE id_room = ?", [$id]);
    }

    public function update($id, $name, $price)
    {
        return db::execute("UPDATE room SET name = ?, price = ? WHERE id_room = ?", [$name, $price, $id]);
    }

    public function create($name, $price)
    {
        return db::insertAndGetId("INSERT INTO room (name, price) VALUES (?, ?)", [$name, $price]);
    }
}
