<?php

namespace app\models;

use app\core\db;

class AdminRoomsModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    public function getAllRooms()
    {
        $sql = "SELECT room.slug, room.price, room.status ,room.area ,room.capacity ,room_type.name_type_room FROM room
                INNER JOIN room_type on room.id_room_type = room_type.id_type_room;";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }
}
