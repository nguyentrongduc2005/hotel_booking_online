<?php

namespace app\models;

use app\core\db;
use DateTime;

class AuthenModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }



    public function findUserbyEmail($email)
    {
        $sql = "SELECT * from user WHERE user.email = :email;";
        $data = db::getOne($sql, ['email' => $email]);
        return $data ? $data : [];
    }

    public function findUserbyCCCD($cccd)
    {
        $sql = "SELECT * from user WHERE user.cccd = :cccd;";
        $data = db::getOne($sql, ['cccd' => $cccd]);
        return $data ? true : false;
    }

    public function findUserbySDT($sdt)
    {
        $sql = "SELECT * from user WHERE user.sdt = :sdt;";
        $data = db::getOne($sql, ['sdt' => $sdt]);
        return $data ? true : false;
    }

    public function insertUser($user)
    {
        $idUser = db::insert('user', $user);
        return $idUser ? $idUser : [];
    }

    public function findUserByID($id)
    {
        $sql = "SELECT * FROM user WHERE user.user_id = :id;";
        $data = db::getOne($sql, ['id' => $id]);
        return $data ? $data : [];
    }
}
