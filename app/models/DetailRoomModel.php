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


    public function getRoomBySlug($slug)
    {
        $sql = "SELECT * FROM room WHERE room.slug = :slug";
        $data = db::getOne($sql, [
            'slug' => $slug
        ]);
        return $data ? $data : [];
    }
}
