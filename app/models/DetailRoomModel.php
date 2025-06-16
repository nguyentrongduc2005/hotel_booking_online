<?php

namespace app\models;

use app\core\db;
use PDO;



class DetailRoomModel
{



    public function __construct()
    {

        db::connect();
    }
    public function getAmenities($slug)
    {
        $sql = "SELECT amenity.name, amenity.description  FROM room_amenity 
        INNER JOIN amenity on room_amenity.amenity_id = amenity.amenity_id 
        inner JOIN room on room_amenity.id_room = room.id_room 
        where room.slug =:slug ;";

        $data = db::getAll($sql, [
            'slug' => $slug
        ]);


        return $data ? $data : [];
    }

    public function getImages($slug)
    {

        $sql = "SELECT image_room.path from image_room
            INNER JOIN room on image_room.id_room = room.id_room
            where room.slug = :slug;";
        $tmp = db::getAll($sql, ['slug' => $slug]);

        $data = [];

        foreach ($tmp as $item) {
            array_push($data, $item['path']);
        }

        return $data ? $data : [];
    }


    public function getRoomBySlug($slug)
    {
        $sql = "SELECT room.*, room_type.name_type_room ,room_type.description as description_room_type from room 
        inner JOIN room_type on room.id_room_type = room_type.id_type_room 
        where room.slug = :slug;";
        $data = db::getOne($sql, [
            'slug' => $slug
        ]);
        return $data ? $data : [];
    }
}
