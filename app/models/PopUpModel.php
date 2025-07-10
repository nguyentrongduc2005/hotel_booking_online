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

    function updateUser($data, $id)
    {
        $dataFilter = array_filter($data, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });

        $row = db::update('user', $dataFilter, "user_id = $id");
        return $row ? $row : false;
    }

    function checkUpdatePass($payload, $id)
    {
        $user = $this->getInfoUser($id);

        if (!password_verify($payload["pass_old"], $user["pass"]))
            return false;
        $passNew = password_hash($payload["pass_new"], PASSWORD_DEFAULT);
        $row = db::update('user', [

            "pass" => $passNew
        ], "user_id = $id");
        if (!$row)
            return false;
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
        $data = db::getAll($sql, $filter);
        return $data ?? [];
    }


    function getHistories($filter, $role)
    {
        $condition = '';
        if ($role == 'user') {
            $condition = 'user.user_id = :user_id';
        } else {
            $condition = 'guest.cccd = :cccd';
        }
        $sql = "SELECT historybooking.id_history ,historybooking.check_in,historybooking.check_out,historybooking.status, room.slug, room.name FROM `historybooking`  
                INNER JOIN $role on $role.{$role}_id = historybooking.{$role}_id
                INNER JOIN room ON historybooking.id_room = room.id_room
                WHERE (historybooking.status = 'completed' OR historybooking.status = 'cancelled') 
                AND $condition";

        $data = db::getAll($sql, $filter);
        return $data ?? [];
    }

    function cancelBooking($id_booking)
    {
        $row = db::update('booking', ["status" => "cancelled"], "id_booking = $id_booking");
        if (!$row)
            return false;
        $sql = "SELECT booking.transaction_id, booking.id_room, booking.check_in, booking.check_out,booking.status, booking.user_id, booking.guest_id FROM `booking` Where id_booking = :id";
        $booking = db::getOne($sql, ["id" => $id_booking]);
        if (!$booking)
            return false;

        $rowT = db::update('transaction', ["payment_status" => "refunded"], "transaction_id = {$booking['transaction_id']}");
        if (!$rowT)
            return false;
        $rowD = db::delete("booking", "id_booking = $id_booking");
        if (!$rowD) return false;
        $idH = db::insert('historybooking', $booking);
        if (!isset($idH)) return false;

        return true;
    }

    function getTransaction($filter, $role)
    {
        $condition = '';
        if ($role == 'user') {
            $condition = 'user.user_id = :user_id';
        } else {
            $condition = 'guest.cccd = :cccd';
        }

        $sqlBooking = "SELECT booking.transaction_id FROM `booking`  
                INNER JOIN $role on $role.{$role}_id = booking.{$role}_id
                WHERE 
                 $condition";

        $dataBooking = db::getAll($sqlBooking, $filter);

        $sqlHistory = "SELECT historybooking.transaction_id FROM `historybooking`  
                INNER JOIN $role on $role.{$role}_id = historybooking.{$role}_id
                WHERE $condition";
        $dataHistory = db::getAll($sqlHistory, $filter);
        $result = array_merge($dataBooking, $dataHistory);
        $transactions = [];
        foreach ($result as $transaction) {
            $sql = "SELECT * FROM `transaction` WHERE transaction_id = :transaction_id";
            $tran = db::getAll($sql, ['transaction_id' => $transaction['transaction_id']]);
            $transactions = array_merge($transactions, $tran);
        }


        return $transactions ?? [];
    }
}
