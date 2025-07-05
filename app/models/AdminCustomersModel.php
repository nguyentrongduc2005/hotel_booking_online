<?php

namespace app\models;

use app\core\db;

class AdminCustomersModel
{
    public function getAllCustomers()
    {
        $sql = "SELECT * FROM guest ORDER BY created_at DESC";
        return db::getAll($sql);
    }
}
