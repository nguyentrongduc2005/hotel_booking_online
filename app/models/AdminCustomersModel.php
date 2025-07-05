<?php

namespace app\models;

use app\core\db;

class AdminCustomersModel
{
    public function getGuests()
    {
        $sql = "SELECT * FROM guest ORDER BY created_at DESC";
        return db::getAll($sql);
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM user ORDER BY created_at DESC";
        return db::getAll($sql);
    }
}
