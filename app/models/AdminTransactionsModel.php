<?php

namespace app\models;

use app\core\db;

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
}
