<?php

namespace app\models;

use app\core\db;
use DateTime;

class AdminBookingModel
{
    public function __construct()
    {
        db::connect();
    }

    // tất cả các booking 
    public function getAllBookings()
    {
        $sql = "SELECT * FROM booking ORDER BY check_in DESC";
        $data = db::getAll($sql);

        foreach ($data as $key => $row) {
            $data[$key]['room'] = $this->getRoomById($row['id_room']);
            $data[$key]['guest'] = $this->getGuestById($row['guest_id']);
        }

        return $data ?: [];
    }

    // lịch sử booking
    public function getHistoryBookings()
    {
        $sql = "SELECT * FROM historybooking ORDER BY check_in DESC";
        $data = db::getAll($sql);

        foreach ($data as $key => $row) {
            $data[$key]['room'] = $this->getRoomById($row['id_room']);
            $data[$key]['guest'] = $this->getGuestById($row['guest_id']);
            $data[$key]['total_days'] = $this->calculateDays($row['check_in'], $row['check_out']);
        }

        return $data ?: [];
    }
    

    public function bookingFilter($filter, $isHistory = false)
    {
        $table = $isHistory ? "historybooking" : "booking";

        $conditions = [];
        $params = [];

        if (!empty($filter['guest_name'])) {
            $conditions[] = "guest.full_name LIKE :guest_name";
            $params['guest_name'] = "%" . $filter['guest_name'] . "%";
        }

        if (!empty($filter['room_code'])) {
            $conditions[] = "room.room_code = :room_code";
            $params['room_code'] = $filter['room_code'];
        }

        if (!empty($filter['check_in'])) {
            $dt = new DateTime($filter['check_in']);
            $filter['check_in'] = $dt->format('Y-m-d H:i:s');
            $conditions[] = "$table.check_in >= :check_in";
            $params['check_in'] = $filter['check_in'];
        }

        if (!empty($filter['check_out'])) {
            $dt = new DateTime($filter['check_out']);
            $filter['check_out'] = $dt->format('Y-m-d H:i:s');
            $conditions[] = "$table.check_out <= :check_out";
            $params['check_out'] = $filter['check_out'];
        }

        $whereSQL = "";
        if (!empty($conditions)) {
            $whereSQL = "WHERE " . implode(" AND ", $conditions);
        }

        $sql = "SELECT $table.* 
                FROM $table
                LEFT JOIN room ON room.id_room = $table.id_room
                LEFT JOIN guest ON guest.guest_id = $table.guest_id
                $whereSQL
                ORDER BY $table.check_in DESC";

        $data = db::getAll($sql, $params);

        foreach ($data as $key => $row) {
            $data[$key]['room'] = $this->getRoomById($row['id_room']);
            $data[$key]['guest'] = $this->getGuestById($row['guest_id']);
            if ($isHistory) {
                $data[$key]['total_days'] = $this->calculateDays($row['check_in'], $row['check_out']);
            }
        }

        return $data ?: [];
    }

    private function getRoomById($roomId)
    {
        $sql = "SELECT room_code FROM room WHERE id_room = :id LIMIT 1";
        $room = db::getOne($sql, ['id' => $roomId]);
        return $room ? $room['room_code'] : null;
    }

    private function getGuestById($guestId)
    {
        $sql = "SELECT full_name FROM guest WHERE guest_id = :id LIMIT 1";
        $guest = db::getOne($sql, ['id' => $guestId]);
        return $guest ? $guest['full_name'] : null;
    }

    private function calculateDays($checkIn, $checkOut)
    {
        $in = new DateTime($checkIn);
        $out = new DateTime($checkOut);
        return $in->diff($out)->days;
    }
}
