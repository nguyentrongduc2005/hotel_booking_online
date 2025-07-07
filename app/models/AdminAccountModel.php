<?php

namespace app\models;

use app\core\db;

class AdminAccountModel
{
    public function getAllAdmins()
    {
        $sql = "SELECT * FROM user WHERE role = 'admin' ORDER BY created_at DESC";
        return db::getAll($sql);
    }

    public function getAdminProfile()
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (!$user_id) return null;

        $sql = "SELECT * FROM user WHERE user_id = :user_id AND role = 'admin'";
        return db::getOne($sql, ['user_id' => $user_id]);
    }
}
