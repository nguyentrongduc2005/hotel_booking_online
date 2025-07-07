<?php

namespace app\models;

use app\core\db;

class AdminCustomersModel
{
    public function __construct()
    {
        db::connect();
    }

    
    public function getAllUsers($searchName = null)
    {
        $sql = "SELECT user_id, full_name, email, cccd, sdt FROM user";
        $params = [];

        if (!empty($searchName)) {
            $sql .= " WHERE full_name LIKE :name";
            $params['name'] = '%' . $searchName . '%';
        }

        $sql .= " ORDER BY user_id DESC";
        return db::getAll($sql, $params) ?: [];
    }

    
    public function getAllGuests($searchName = null)
    {
        $sql = "SELECT guest_id, full_name, email, sdt, cccd FROM guest";
        $params = [];

        if (!empty($searchName)) {
            $sql .= " WHERE full_name LIKE :name";
            $params['name'] = '%' . $searchName . '%';
        }

        $sql .= " ORDER BY guest_id DESC";
        return db::getAll($sql, $params) ?: [];
    }

   
    public function deleteUser($userId)
    {
        return db::delete("user", "user_id = $userId") ? true : false;
    }

    
    public function deleteGuest($guestId)
    {
        return db::delete("guest", "guest_id = $guestId") ? true : false;
    }
}
