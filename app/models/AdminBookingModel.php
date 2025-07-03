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

    // Lấy danh sách các booking chưa hoàn tất (All Bookings)
    public function getAllBookings($filters = [])
    {
        return $this->getDataByFilter($filters, 'booking');
    }

    // Lấy danh sách các booking đã hoàn tất (History Bookings)
    public function getHistoryBookings($filters = [])
    {
        return $this->getDataByFilter($filters, 'historybooking');
    }

    // Hàm chung để query dữ liệu từ bảng booking hoặc historybooking
    private function getDataByFilter($filters, $table)
    {
        $where = [];
        $params = [];

        // Xử lý ngày
        if (!empty($filters['check_in'])) {
            $dt = new DateTime($filters['check_in']);
            $filters['check_in'] = $dt->format('Y-m-d');
        }

        if (!empty($filters['check_out'])) {
            $dt = new DateTime($filters['check_out']);
            $filters['check_out'] = $dt->format('Y-m-d');
        }

        // Các điều kiện lọc
        if (!empty($filters['name'])) {
            $where[] = "guest.name_guest LIKE :name";
            $params['name'] = '%' . $filters['name'] . '%';
        }

        if (!empty($filters['id_room'])) {
            $where[] = "room.id_room = :id_room";
            $params['id_room'] = $filters['id_room'];
        }

        if (!empty($filters['check_in'])) {
            $where[] = "$table.check_in >= :check_in";
            $params['check_in'] = $filters['check_in'];
        }

        if (!empty($filters['check_out'])) {
            $where[] = "$table.check_out <= :check_out";
            $params['check_out'] = $filters['check_out'];
        }

        // Câu SQL với JOIN
        $sql = "SELECT 
                    $table.id_booking,
                    guest.name_guest,
                    room.id_room,
                    room.room_number,
                    $table.check_in,
                    $table.check_out,
                    DATEDIFF($table.check_out, $table.check_in) AS total_days,
                    $table.status
                FROM $table
                INNER JOIN guest ON $table.id_guest = guest.id_guest
                INNER JOIN room ON $table.id_room = room.id_room
        ";

        // Thêm điều kiện WHERE nếu có
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }

        $sql .= " ORDER BY $table.check_in DESC";

        return db::getAll($sql, $params) ?: [];
    }
}
