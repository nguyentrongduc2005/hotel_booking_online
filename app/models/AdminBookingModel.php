<?php

namespace app\models;

use app\core\db;
use Exception;

class AdminBookingModel
{
    // Lấy tất cả các booking hiện tại (chưa chuyển qua lịch sử)
    public function getAllBookings()
    {
        $sql = "SELECT 
                    booking.id_booking,
                    booking.check_in,
                    booking.check_out,
                    booking.status,
                    booking.status_checkin,
                    booking.status_checkout,
                    booking.created_at,
                    room.name AS room_name,
                    room.id_room,
                    transaction.total_amount,
                    transaction.payment_status,
                    transaction.payment_method,
                    user.full_name AS user_name,
                    guest.full_name AS guest_name
                FROM booking
                LEFT JOIN room ON booking.id_room = room.id_room
                LEFT JOIN transaction ON booking.transaction_id = transaction.transaction_id
                LEFT JOIN user ON booking.user_id = user.user_id
                LEFT JOIN guest ON booking.guest_id = guest.guest_id
                ORDER BY booking.created_at DESC";

        return db::getAll($sql);
    }

    // Lấy danh sách các booking trong lịch sử
    public function getHistoryBookings()
    {
        $sql = "SELECT 
                    historybooking.id_history,
                    historybooking.check_in,
                    historybooking.check_out,
                    historybooking.status,
                    historybooking.created_at,
                    historybooking.date_booking,
                    room.name AS room_name,
                    room.id_room,
                    transaction.total_amount,
                    transaction.payment_status,
                    transaction.payment_method,
                    user.full_name AS user_name,
                    guest.full_name AS guest_name
                FROM historybooking
                LEFT JOIN room ON historybooking.id_room = room.id_room
                LEFT JOIN transaction ON historybooking.transaction_id = transaction.transaction_id
                LEFT JOIN user ON historybooking.user_id = user.user_id
                LEFT JOIN guest ON historybooking.guest_id = guest.guest_id
                ORDER BY historybooking.created_at DESC";

        return db::getAll($sql);
    }

    // Hàm lọc dùng chung cho cả booking và historybooking
    public function bookingFilter($table, $filters = [])
    {
        if (!in_array($table, ['booking', 'historybooking'])) {
            throw new Exception("Bảng không hợp lệ");
        }

        $sql = "SELECT 
                    {$table}.*,
                    room.name AS room_name,
                    room.id_room,
                    transaction.total_amount,
                    transaction.payment_status,
                    transaction.payment_method,
                    user.full_name AS user_name,
                    guest.full_name AS guest_name
                FROM {$table}
                LEFT JOIN room ON {$table}.id_room = room.id_room
                LEFT JOIN transaction ON {$table}.transaction_id = transaction.transaction_id
                LEFT JOIN user ON {$table}.user_id = user.user_id
                LEFT JOIN guest ON {$table}.guest_id = guest.guest_id
                WHERE 1=1";

        $params = [];

        if (!empty($filters['guest_name'])) {
            $sql .= " AND guest.full_name LIKE :guest_name";
            $params['guest_name'] = '%' . $filters['guest_name'] . '%';
        }

        if (!empty($filters['user_name'])) {
            $sql .= " AND user.full_name LIKE :user_name";
            $params['user_name'] = '%' . $filters['user_name'] . '%';
        }

        if (!empty($filters['id_room'])) {
            $sql .= " AND room.id_room = :id_room";
            $params['id_room'] = $filters['id_room'];
        }

        if (!empty($filters['check_in'])) {
            $sql .= " AND {$table}.check_in >= :check_in";
            $params['check_in'] = $filters['check_in'];
        }

        if (!empty($filters['check_out'])) {
            $sql .= " AND {$table}.check_out <= :check_out";
            $params['check_out'] = $filters['check_out'];
        }

        $sql .= " ORDER BY {$table}.created_at DESC";

        return db::getAll($sql, $params);
    }
}
