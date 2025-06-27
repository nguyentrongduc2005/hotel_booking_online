<?php

namespace app\models;

use app\core\db;

class PopUpModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    function getInfoUser($id)
    {
        $sql = "SELECT * FROM `user` WHERE user_id = :id";
        $user = db::getOne($sql, ['id' => $id]);
        return $user ? $user : [];
    }

    function updateUser($data)
    {
        $dataFilter = array_filter($data, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });

        $row = db::update('user', $dataFilter, "user_id = :user_id");
        return $row ? $row : false;
    }

    function checkUpdatePass($payload, $id)
    {

        $user = $this->getInfoUser($id);
        if (!password_verify($payload["pass_old"], $user["pass"])) return false;
        $passNew = password_hash($$payload["pass_new"], PASSWORD_DEFAULT);
        $row =  db::update('user', [
            "pass" => $passNew
        ], "user_id = $id");
        if (!$row) return false;
        return true;
    }


    function getMyReservation($filter, $role)
    {
        $condition = '';
        if ($role == 'user') {
            $condition = 'user.user_id = :user_id';
        } else {
            $condition = 'guest.cccd = :cccd';
        }
        $sql = "SELECT booking.id_booking ,booking.status_checkin,booking.status_checkout,booking.check_in,booking.check_out,booking.status, room.slug, room.name FROM `booking`  
                INNER JOIN $role on $role.{$role}_id = booking.{$role}_id
                INNER JOIN room ON booking.id_room = room.id_room
                WHERE (booking.status = 'pending' OR booking.status = 'confirmed') 
                AND $condition";
        $data =  db::getAll($sql, $filter);
        return  $data ?? [];
    }
}
