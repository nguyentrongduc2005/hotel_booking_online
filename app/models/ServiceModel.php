<?php

namespace app\models;

use app\core\db;

class  ServiceModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }
    public function getOneService($slug)
    {
      $sql = "SELECT * FROM services WHERE slug = :slug";
        $data = db::getOne($sql, [
            'slug' => $slug
        ]);
        return $data ? $data : [];
    }


      
    public function getAllServices()
    {
        $sql = "SELECT * FROM services";
        $data = db::getAll($sql);
        return $data ? $data : [];
    }
    public function getServiceById($id)
    {
        $sql = "SELECT * FROM service WHERE id_service = :id";
        $data = db::getOne($sql, ['id' => $id]);
        return $data ? $data : null;
    }
}
