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
                    b.checkin, 
                    b.checkout
                FROM booking b
                JOIN guest g ON b.guest_id = g.guest_id
                JOIN room r ON b.id_room = r.id_room
                ORDER BY b.check_in DESC";

        return db::getAll($sql) ?? [];
    }
    //history bookings
    public function getHistoryBookings()
    {
        $sql = "SELECT 
                    h.id_history AS id_booking,
                    g.full_name AS guest_name,
                    r.id_room,
                    r.slug AS room_number,
                    h.check_in, 
                    h.check_out,
                    DATEDIFF(h.check_out, h.check_in) AS total_days,
                    h.status
                FROM historybooking h
                JOIN guest g ON h.guest_id = g.guest_id
                JOIN room r ON h.id_room = r.id_room
                ORDER BY h.check_out DESC";

        return db::getAll($sql) ?? [];
    }
    //filter bookings and history bookings
    public function getDataByFilter($filter, $type = 'all')
    {
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

        if (!empty($filter['check_in'])) {
            $dt = new \DateTime($filter['check_in']);
            $filter['check_in'] = $dt->format('Y-m-d H:i:s');
            $condition .= $type === 'all' 
                ? " AND b.check_in = :check_in" 
                : " AND h.check_in = :check_in";
            $params['check_in'] = $filter['check_in'];
        }

        if (!empty($filter['check_out'])) {
            $dt = new \DateTime($filter['check_out']);
            $filter['check_out'] = $dt->format('Y-m-d H:i:s');
            $condition .= $type === 'all' 
                ? " AND b.check_out = :check_out" 
                : " AND h.check_out = :check_out";
            $params['check_out'] = $filter['check_out'];
        }

        if ($type === 'all') {
            $sql = "SELECT 
                        b.id_booking, 
                        g.full_name AS guest_name,
                        r.id_room,
                        r.slug AS room_number,
                        b.check_in, 
                        b.check_out,
                        b.status_checkin,
                        b.status_checkout,
                        b.status
                    FROM booking b
                    LEFT JOIN guest g ON b.guest_id = g.guest_id
                    JOIN room r ON b.id_room = r.id_room
                    WHERE $condition
                    ORDER BY b.check_in DESC";
        } else {
            if (!empty($filter['status'])) {
                $condition .= " AND h.status = :status";
                $params['status'] = $filter['status'];
            }

            $sql = "SELECT 
                        h.id_history AS id_booking,
                        g.full_name AS guest_name,
                        r.id_room,
                        r.slug AS room_number,
                        h.check_in, 
                        h.check_out,
                        DATEDIFF(h.check_out, h.check_in) AS total_days,
                        h.status
                    FROM historybooking h
                    JOIN guest g ON h.guest_id = g.guest_id
                    JOIN room r ON h.id_room = r.id_room
                    WHERE $condition
                    ORDER BY h.check_out DESC";
        }

        return db::getAll($sql, $params) ?? [];
    }
}
