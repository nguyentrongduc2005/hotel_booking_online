<?php

namespace app\models;

use app\core\db;

class AdminBookingModel
{
    public function __construct()
    {
        db::connect();
    }
    //all bookings
    public function getAllBookings()
    {
        $sql = "SELECT 
                    b.id_booking, 
                    g.full_name AS guest_name,
                    r.id_room,
                    r.slug AS room_number,
                    b.checkin_date, 
                    b.checkout_date
                FROM booking b
                JOIN guest g ON b.id_guest = g.id_guest
                JOIN room r ON b.id_room = r.id_room
                ORDER BY b.checkin_date DESC";

        return db::getAll($sql) ?? [];
    }
    //history bookings
    public function getHistoryBookings()
    {
        $sql = "SELECT 
                    h.id_historybooking AS id_booking,
                    g.full_name AS guest_name,
                    r.id_room,
                    r.slug AS room_number,
                    h.checkin_date, 
                    h.checkout_date,
                    DATEDIFF(h.checkout_date, h.checkin_date) AS total_days,
                    h.status
                FROM historybooking h
                JOIN guest g ON h.id_guest = g.id_guest
                JOIN room r ON h.id_room = r.id_room
                ORDER BY h.checkout_date DESC";

        return db::getAll($sql) ?? [];
    }
    //filter bookings and history bookings
    public function getDataByFilter($filter, $type = 'all')
    {
        if (!empty($filter['check_in'])) {
        $dt = new \DateTime($filter['check_in']);
        $filter['check_in'] = $dt->format('Y-m-d');
        }

       if (!empty($filter['check_out'])) {
       $dt = new \DateTime($filter['check_out']);
       $filter['check_out'] = $dt->format('Y-m-d');
       }

    $params = [];
    $condition = '1=1';

    if (!empty($filter['guest_name'])) {
        $condition .= " AND g.full_name LIKE CONCAT('%', :guest_name, '%')";
        $params['guest_name'] = $filter['guest_name'];
    }

    if (!empty($filter['room_id'])) {
        $condition .= " AND r.id_room = :room_id";
        $params['room_id'] = $filter['room_id'];
    }

    if (!empty($filter['room_number'])) {
        $condition .= " AND r.slug LIKE CONCAT('%', :room_number, '%')";
        $params['room_number'] = $filter['room_number'];
    }

    if (!empty($filter['checkin_date'])) {
    $condition .= $type === 'all' 
        ? " AND b.checkin_date = :checkin_date" 
        : " AND h.checkin_date = :checkin_date";
    $params['checkin_date'] = $filter['checkin_date'];
}

if (!empty($filter['checkout_date'])) {
    $condition .= $type === 'all' 
        ? " AND b.checkout_date = :checkout_date" 
        : " AND h.checkout_date = :checkout_date";
    $params['checkout_date'] = $filter['checkout_date'];
}
    if ($type === 'all') {
        $sql = "SELECT 
                    b.id_booking, 
                    g.full_name AS guest_name,
                    r.id_room,
                    r.slug AS room_number,
                    b.checkin_date, 
                    b.checkout_date
                FROM booking b
                JOIN guest g ON b.id_guest = g.id_guest
                JOIN room r ON b.id_room = r.id_room
                WHERE $condition
                ORDER BY b.checkin_date DESC";
    } else {
        if (!empty($filter['status'])) {
            $condition .= " AND h.status = :status";
            $params['status'] = $filter['status'];
        }

        $sql = "SELECT 
                    h.id_historybooking AS id_booking,
                    g.full_name AS guest_name,
                    r.id_room,
                    r.slug AS room_number,
                    h.checkin_date, 
                    h.checkout_date,
                    DATEDIFF(h.checkout_date, h.checkin_date) AS total_days,
                    h.status
                FROM historybooking h
                JOIN guest g ON h.id_guest = g.id_guest
                JOIN room r ON h.id_room = r.id_room
                WHERE $condition
                ORDER BY h.checkout_date DESC";
    }

    return db::getAll($sql, $params) ?? [];
   }

}
