<?php

namespace app\models;

use app\core\db;

class ListRoomModel
{
    public function __construct()
    {
        db::connect();
    }

    public function getRooms($filters = [])
    {
        $sql = "SELECT room.*, room_type.name_type_room
                FROM room
                INNER JOIN room_type ON room.id_room_type = room_type.id_type_room
                WHERE 1=1";

        $params = [];

        // Lọc theo loại phòng (1 loại)
        if (!empty($filters['room_type'])) {
            $sql .= " AND room_type.name_type_room = :room_type";
            $params['room_type'] = $filters['room_type'];
        }

        // Lọc theo giá
        if (!empty($filters['price_min'])) {
            $sql .= " AND room.price >= :price_min";
            $params['price_min'] = $filters['price_min'];
        }

        if (!empty($filters['price_max'])) {
            $sql .= " AND room.price <= :price_max";
            $params['price_max'] = $filters['price_max'];
        }

        // Phân trang
        $limit = 5;
        $page = max(1, (int)($filters['page'] ?? 1));
        $offset = ($page - 1) * $limit;

        $sql .= " LIMIT $limit OFFSET $offset";

        $rooms = db::getAll($sql, $params);
        return $rooms ?: [];
    }

    public function getAllRoomTypes()
    {
        $sql = "SELECT * FROM room_type";
        $data = db::getAll($sql);
        return $data ?: [];
    }
}
// get,lọc, ngày tháng,trả về view, phân trang
// Lấy danh sách phòng, lọc theo loại phòng,lọc theo giá, phân trang, lọc theo trạng thái đã checkout hay chưa checkout
// Lấy danh sách loại phòng, trả về view






















