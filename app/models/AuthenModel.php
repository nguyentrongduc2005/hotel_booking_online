<?php

namespace app\models;

use app\core\db;

class AuthenModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    public function findTokenbyId($id)
    {
        $sql = "SELECT * FROM token WHERE token.user_id = :user_id;";
        $data = db::getOne($sql, ['user_id' => $id]);
        return $data ? $data : [];
    }
    public function findTokenByidToken($token)
    {
        $sql = "SELECT * FROM token WHERE token.id_token = :id_token";
        $data = db::getOne($sql, ['id_token' => $token]);
        return  $data ? $data : [];
    }

    public function findTokenByToken($token)
    {
        $sql = "SELECT * FROM token WHERE token.token = :token;";
        $data = db::getOne($sql, ['token' => $token]);
        return  $data ? $data : [];
    }

    public function deleteToken($token)
    {

        $coutrow =  db::delete('token', "token.id_token = $token");
        return $coutrow ? true : false;
    }

    public function generateAndInsertToken($id_user)
    {
        $token = bin2hex(random_bytes(32));
        $id_token = db::insert('token', [
            'token' => $token,
            "user_id" => $id_user
        ]);
        return $id_token ? $id_token : [];
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
