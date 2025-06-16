<?php

namespace app\models;

use app\core\db;

class HomeModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    public function getDataRooms()
    {
        $data = db::getAll("SELECT room.id_room,room.thumb,room.name, room.slug, room.price FROM room");
        return $data ? $data : [];
    }

    public function getDataServices()
    {

        $data = db::getAll("SELECT services.id_service, services.name, services.Path_img FROM services");
        return $data ? $data : [];
    }
}
