<?php

namespace app\models;

use app\core\db;
use \DateTime;

class AdminTransactionsModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    function getAllTransactions()
    {
        $sql = "SELECT * FROM transaction;";
        $data = db::getAll($sql);
        foreach ($data as $key => $value) {
            $id = $value['transaction_id'];
            $booking = $this->getBookingByidTransaction($id);
            $data[$key]['id_booking'] = isset($booking['id_booking']) ? $booking['id_booking'] : null;
            $data[$key]['user'] = $this->getUserbyIdBooking($data[$key]['id_booking']);
        }

        return $data ? $data : [];
    }

    function getBookingByidTransaction($id)
    {
        $sql = "SELECT booking.id_booking FROM booking WHERE transaction_id = :id;";
        $data = db::getOne($sql, ['id' => $id]);
        return $data ? $data : [];
    }
    function getUserbyIdBooking($id)
    {
        $sql = "SELECT user.user_id, user.full_name as name_user, user.email as email_user , 
                        guest.guest_id, guest.full_name as name_guest, guest.email as email_guest FROM booking 
        LEft JOIN user ON user.user_id = booking.user_id
        Left JOIN guest ON guest.guest_id = booking.guest_id
        WHERE booking.id_booking = :id;";
        $data = db::getOne($sql, ['id' => $id]);
        $result = [];
        if ($data) {
            if (!empty($data['name_user'])) {
                $result = [
                    'name' => $data['name_user'],
                    'email' => $data['email_user']
                ];
            }
            if (!empty($data['name_guest'])) {
                $result = [
                    'name' => $data['name_guest'],
                    'email' => $data['email_guest']
                ];
            }
            return $result;
        }
        return $result ? $result : [];
    }


    function transactionFilter($filter)
    {
        $filtered = array_filter($filter, function ($value) {
            return !(
                $value === '' ||
                $value === null ||
                (is_array($value) && empty($value))
            );
        });
        $keys = array_keys($filtered);
        if (!empty($filtered["created_at"])) {
            $dt = new DateTime($filtered["created_at"]);
            $filtered["created_at"] = $dt->format('Y-m-d H:i:s');
        }

        $condition = "";
        foreach ($keys as $key) {
            if ($condition != '') {
                $condition .= " AND ";
            }
            $condition .= "$key = :$key";
        }


        $sql = "SELECT * FROM `booking` WHERE " . $condition;

        $data = db::getAll($sql, $filtered);
        if (!$data) return [];
        foreach ($data as $key => $value) {
            $id = $value['transaction_id'];
            $booking = $this->getBookingByidTransaction($id);
            $data[$key]['id_booking'] = isset($booking['id_booking']) ? $booking['id_booking'] : null;
            $data[$key]['user'] = $this->getUserbyIdBooking($data[$key]['id_booking']);
        }
        return $data ? $data : [];
    }
}
