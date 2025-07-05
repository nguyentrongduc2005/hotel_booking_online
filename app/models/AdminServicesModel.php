<?php

namespace app\models;

use app\core\db;

class AdminServicesModel
{
    public function getAllServices()
    {
        $sql = "SELECT * FROM services ORDER BY created_at DESC";
        return db::getAll($sql);
    }
}
