<?php

namespace app\models;

use app\core\db;
use \DateTime;

class PaymentModel
{

    public function __construct()
    {
        db::connect();
        // Initialize the model if needed
    }

    function getRoomInfo($slug)
    {
        $sql = "SELECT room.id_room,room.slug, room.price, room.status, room.area, room.capacity, room_type.name_type_room,  room.thumb
                FROM room
                INNER JOIN room_type ON room.id_room_type = room_type.id_type_room
                WHERE room.slug = :slug";
        $data = db::getOne($sql, ['slug' => $slug]);
        return $data ? $data : [];
    }
    //"diamond" : "gold") : "silver";


    function getUserbyId($id)
    {
        $sql = "SELECT user_id, full_name, email, cccd, sdt FROM user WHERE user_id = :id";
        $data = db::getOne($sql, ['id' => $id]);
        return $data ? $data : [];
    }
    function insertGuest($data)
    {
        $idGuest = db::insert('guest', [
            'full_name' => $data['full_name'],
            'cccd' => $data['cccd'],
            'sdt' => $data['sdt'],
            'email' => $data['email']
        ]);
        return $idGuest;
    }

    function insertTransaction($data)
    {
        $idTransaction = db::insert('transaction', [
            "total_amount" => $data['total_amount'],

        ]);
        return $idTransaction;
    }

    function insertBooking($data)
    {
        if (!empty($_SESSION['user_id'])) {
            $data['user_id'] = $data['customer'];

            $data['guest_id'] = null;
        } else {
            $data['guest_id'] = $data['customer'];

            $data['user_id'] = null; // Nếu không có user_id, đặt là null
        }
        $data['check_in'] = new DateTime($data['check_in']);
        $data['check_in'] = $data['check_in']->format('Y-m-d H:i:s');
        $data['check_out'] = new DateTime($data['check_out']);
        $data['check_out'] = $data['check_out']->format('Y-m-d H:i:s');
        $idBooking = db::insert('booking', [
            'id_room' => $data['id_room'],
            'guest_id' => $data['guest_id'] ?? null,
            'user_id' => $data['user_id'] ?? null,
            'transaction_id' => $data['id_transaction'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
        ]);
        return $idBooking;
    }

    function updateMethod($data, $condition)
    {
        $id = db::update('transaction', $data, $condition);
        return $id;
    }


    function checkRoomBooked($idroom, $check_in, $check_out)
    {
        $check_in = new DateTime($check_in);
        $check_in = $check_in->format('Y-m-d H:i:s');
        $check_out = new DateTime($check_out);
        $check_out = $check_out->format('Y-m-d H:i:s');
        $sql = "SELECT * FROM booking WHERE id_room = :id_room AND (check_in <= :check_out AND check_out >= :check_in)";
        $data = db::getOne($sql, [
            'id_room' => $idroom,
            'check_in' => $check_in,
            'check_out' => $check_out
        ]);
        return $data ? true : false;
    }
}
